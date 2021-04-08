<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\ContainerType;
use App\Models\Container;
use App\Models\License;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Resources\Comment\CommentCollection;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\ParcelHelper;
use Illuminate\Support\Facades\Auth;

class ContainerController extends Controller
{
    /**
     * Display a listing of the comments for post.
     * @param Post $post
     *
     * @return CommentCollection
     */

    /*public function index(Post $post)
    {
        return new CommentCollection($post->comments);
    }*/

    public function getContainerType(ContainerType $ContainerType)
    {
        try {
            $containerTypeData = ContainerType::orderBy('order_number')->get()->toArray();
            $data = array();
            if(!empty($containerTypeData)) {
                $data = $containerTypeData;
            }   
            $response = [
                config('api.CODE')    => config('HttpCodes.success'),
                config('api.RESULT')  => $data
            ];
            ParcelHelper::sendResponse($response, config('HttpCodes.success')); 
        } catch (Exception $e) {
            ParcelHelper::showException($e, $e->getCode());
        }  
    }
    
    public function storeWegen(Request $request)
    {
        try {
             ParcelHelper::validateRequest($request->all(), self::weganValidationRules($request->all()));     
             $container = [];
             $user = Auth::user();
             $username = $user->name;
             
            $container = new Container();
            $container->user_id = $user->id;
            $container->action_type = $request->action_type;
            $container->container_number = $request->container_number;
            $container->container_type = $request->container_type;
            $weight = '';
            $reference = '';        
            if(isset($request->weight)) {    
                $weight = $request->weight;
                $container->weight = $weight;    
            }
            if(isset($request->reference)) {
                $reference = $request->reference;
                $container->reference = $reference;
            }            
            $container->license_plate = $request->license_plate;
            $container->transporter_id = $request->transporter_id;
            $container->client_id = $request->client_id;
            $prefix = '';
            for($i = 0; $i < 6; $i++) {    
                $prefix .= random_int(0,1) ? chr(random_int(65, 90)) : random_int(0, 9);
            }
            $container->pin = $prefix;
            $container->save();

            $data = array('container_number'=>$request->container_number,"container_type"=>$request->container_type,'weight'=>$weight,'name'=>$username);
            \Mail::send('container_mail', $data, function($message) {
                $user = Auth::user();
                $username = $user->name;
                $usermail = $user->email;
                $message->to($usermail, $username)->subject
                ('Container Info');
                $message->from(env("MAIL_USERNAME"),'Rick');
            });
            $response = [
                config('api.CODE')    => config('HttpCodes.success'),
                config('api.RESULT')  => $container
            ];
            ParcelHelper::sendResponse($response, config('HttpCodes.success'));
        } catch (Exception $e) {   
            echo $e->getMessage(); die;
            ParcelHelper::showException($e, $e->getCode());
        }
    }


    private static function weganValidationRules(): array
    {
        return [
            'container_number'   => 'required|unique:containers',
            'container_type'     => 'required',
            'weight'             => 'required',
            'is_save'            => 'required',   
            //'reference'          => 'required',
            'license_plate'      => 'required',   
            'transporter_id'     => 'required_without:client_id',
            'client_id'          => 'required_without:transporter_id',
        ];
    }

    private static function containerStoreValidationRules(): array
    {
        return [
            'container_number'   => 'required|unique:containers',
            'container_type'     => 'required',
            'weight'             => 'required',
            //'stack'              => 'required',
            //'locatie'            => 'required',
            'leeg'               => 'required',
            //'reference'          => 'required',
            'license_plate'      => 'required',   
            'transporter_id'     => 'required_without:client_id',
            'client_id'          => 'required_without:transporter_id',
        ];
    }

    private static function containerSearchValidationRules(): array
    {
        return [
            'container_number'   => 'required_if:pin,==,""',
            'pin' => 'required_if:container_number,==,""'
        ];
    }

    private static function containerHandlingValidationRules(): array
    {
        return [
            //'container_number'   => 'required_if:container_type,==,""',
            //'container_type' => 'required_if:container_number,==,""',
            //'reference'   => 'required_if:container_number,==,""',
            'container_number'   => 'required_if:reference,==,""',
            'reference'   => 'required_if:container_number,==,""',
        ];   
    }

    public function containerDetail(Request $request)
    {
        try {
             ParcelHelper::validateRequest($request->all(), self::containerSearchValidationRules($request->all()));     
            $containerData = [];
            if(isset($request->container_number)) {
                $container_number = $request->container_number;    
                $containerData = Container::where('container_number',$container_number)->with('containerTypeData','usersData')->get()->toArray();
            } else {
                $pin = $request->pin;   
                $containerData = Container::where('pin',$pin)->with('containerTypeData','usersData')->get()->toArray();
            }
            $response = [
                config('api.CODE')    => config('HttpCodes.success'),
                config('api.RESULT')  => $containerData
            ];
            ParcelHelper::sendResponse($response, config('HttpCodes.success'));
        } catch (Exception $e) {   
            echo $e->getMessage(); die;
            ParcelHelper::showException($e, $e->getCode());
        }
    }

    public function storeContainer(Request $request){
        try{
             ParcelHelper::validateRequest($request->all(), self::containerStoreValidationRules($request->all()));

             $container = [];
             $user = Auth::user();
             $username = $user->name;       

            $container = new Container();
            $container->user_id = $user->id;
            $container->action_type = $request->action_type;
            $container->container_number = $request->container_number;
            $container->container_type = $request->container_type;
            $container->weight = $request->weight;

            $stack = '';
            if(isset($request->stack)) {
                $stack = $request->stack;
                $container->stack = $stack;    
            } 
            

            $locatie = '';
            if(isset($request->locatie)) {
                $locatie = $request->locatie;
                $container->locatie = $locatie;    
            }
            
            $container->leeg = $request->leeg;
            $container->reference = $request->reference;
            $container->license_plate = $request->license_plate;
            $container->transporter_id = $request->transporter_id;
            $container->client_id = $request->client_id;

            if(isset($request->temprature)) {
                $container->temprature = $request->temprature;    
            }
            if(isset($request->adr)) {
                $container->adr = $request->adr;    
            }
            if(isset($request->genset)) {
                $container->genset = $request->genset;    
            }
            if(isset($request->comment)) {
                $container->comment = $request->comment;    
            }
            if(isset($request->doorge)) {
                $container->doorge = $request->doorge;    
            }

            $prefix = '';
            for($i = 0; $i < 6; $i++){
                $prefix .= random_int(0,1) ? chr(random_int(65, 90)) : random_int(0, 9);
            }
            $container->pin = $prefix;
            $container->save();
            $data = array("container_number"=>$request->container_number,
                            "container_type"=>$request->container_type,
                            "weight"=>$request->weight,
                            "name"=>$username,
                            "stack"=>$stack,
                            'locatie'=>$locatie,   
                            "leeg"=>$request->leeg);
         
            \Mail::send('container_detail', $data, function($message) {
                $user = Auth::user();
                $username = $user->name;
                $usermail = $user->email;
                $message->to($usermail, $username)->subject
                ('Container Info');
                $message->from(env("MAIL_USERNAME"),'Rick');
            });
            $response = [
                config('api.CODE')    => config('HttpCodes.success'),
                config('api.RESULT')  => $container
            ];
            ParcelHelper::sendResponse($response, config('HttpCodes.success'));
        } catch (Exception $e) {   
            echo $e->getMessage(); die;
            ParcelHelper::showException($e, $e->getCode());
        }
    }

    public function getLicence(Request $request) {
        try {
            $user = Auth::user();
            $userID = $user->id;
            $licenseData = Container::where('user_id',$userID)->orderBy('id', 'DESC')->get()->toArray();

            $data = array();
            if(!empty($licenseData)) {
                $data['license_plate'] = $licenseData[0]['license_plate'];
                $data['transporter_id'] = $licenseData[0]['transporter_id'];
                $data['client_id'] = $licenseData[0]['client_id']; 
            }   
            $response = [
                config('api.CODE')    => config('HttpCodes.success'),
                config('api.RESULT')  => $data
            ];
            ParcelHelper::sendResponse($response, config('HttpCodes.success')); 
        } catch (Exception $e) {
            ParcelHelper::showException($e, $e->getCode());
        }  
    }

    public function containerHandling(Request $request) {
        try {
            ParcelHelper::validateRequest($request->all(), self::containerHandlingValidationRules($request->all()));

            $handlingStatus = 1;
            if(isset($request->is_checked) && $request->is_checked!='') {
                $handlingStatus = 2;
            }


            $container = [];
            $user = Auth::user();
            $username = $user->name;    

            $container = new Container();
            $container->user_id = $user->id;
            $container->action_type = 'handeling';
            $container->container_number = $request->container_number;
            $container->container_type = $request->container_type;
            $container->weight = '';
            if(isset($request->weight) && $request->weight!='') {
                $container->weight = $request->weight;    
            }
            if(isset($request->reference) && $request->reference!='') {
                $container->reference = $request->reference;        
            }  

            $prefix = '';
            for($i = 0; $i < 6; $i++){
                $prefix .= random_int(0,1) ? chr(random_int(65, 90)) : random_int(0, 9);
            }
            $container->pin = $prefix;
            $container->save();


            if(isset($request->container_number) && $request->container_number!='') {
                $container_number = $request->container_number;    
                $containerData = Container::where('container_number',$container_number)->orderBy('id', 'DESC')->get()->toArray();    
            } else if(isset($request->reference) && $request->reference!='') {
                $reference = $request->reference;    
                $containerData = Container::where('reference',$reference)->orderBy('id', 'DESC')->get()->toArray();      
            }
            if(!empty($containerData)) {
                $id = $containerData[0]['id'];    
                $containerData[0]['handling_status'] = $handlingStatus;
                Container::where('id', $id)->update(array('handling_status' => $handlingStatus));
                $response = [    
                    config('api.CODE')    => config('HttpCodes.success'),
                    config('api.RESULT')  => $containerData
                ];
                ParcelHelper::sendResponse($response, config('HttpCodes.success')); 
            } else {
                $response = [
                    config('api.CODE')    => config('HttpCodes.accessDenied'),
                    config('api.MESSAGE') => config('Messages.invalidContainer'),
                    config('api.RESULT')  => []
                ];
                ParcelHelper::sendResponse($response,config('HttpCodes.success'));
                exit;
            }
            
        } catch (Exception $e) {
            ParcelHelper::showException($e, $e->getCode());
        }  
    }
}
