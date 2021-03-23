<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\ContainerType;
use App\Models\Container;
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
             if($request->is_save == '1') {
                $container = new Container();
                $container->user_id = $user->id;
                $container->container_number = $request->container_number;
                $container->container_type = $request->container_type;
                $container->weight = $request->container_number;
                $container->reference = $request->reference;
                $prefix = '';
                for($i = 0; $i < 6; $i++){
                    $prefix .= random_int(0,1) ? chr(random_int(65, 90)) : random_int(0, 9);
                }
                $container->pin = $prefix;
                $container->save();
            }
            $data = array('container_number'=>$request->container_number,"container_type"=>$request->container_type,'weight'=>$request->container_number,'name'=>$username);
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
            'container_number'   => 'required',
            'container_type'     => 'required',
            'weight'             => 'required',
            'is_save'            => 'required',   
            'reference'          => 'required',
        ];
    }

    private static function containerStoreValidationRules(): array
    {
        return [
            'container_number'   => 'required',
            'container_type'     => 'required',
            'weight'             => 'required',
<<<<<<< HEAD
=======
            'stack'              => 'required',
            'locatie'            => 'required',
            'leeg'               => 'required',
            'reference'          => 'required',
>>>>>>> 04c2c85aafb93bdb05360daa5759f683e5e667e1
        ];
    }

    private static function containerSearchValidationRules(): array
    {
        return [
            'container_number'   => 'required_if:pin,==,""',
            'pin' => 'required_if:container_number,==,""'
        ];
    }

    public function containerDetail(Request $request)
    {
        try {
             ParcelHelper::validateRequest($request->all(), self::containerSearchValidationRules($request->all()));     
            $containerData = [];
            if(isset($request->container_number)) {
                $container_number = $request->container_number;    
                $containerData = Container::where('container_number',$container_number)->get();
            } else {
                $pin = $request->pin;   
                $containerData = Container::where('pin',$pin)->get();
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
<<<<<<< HEAD
                $container = new Container();
                $container->user_id = $user->id;
                $container->container_number = $request->container_number;
                $container->container_type = $request->container_type;
                $container->weight = $request->weight;
                $container->stack = $request->stack;
                $container->locatie = $request->locatie;
                $container->Leeg = $request->Leeg;

                $prefix = '';
                for($i = 0; $i < 6; $i++){
                    $prefix .= random_int(0,1) ? chr(random_int(65, 90)) : random_int(0, 9);
                }
                $container->pin = $prefix;
                $container->save();
=======

            $container = new Container();
            $container->user_id = $user->id;
            $container->container_number = $request->container_number;
            $container->container_type = $request->container_type;
            $container->weight = $request->weight;
            $container->stack = $request->stack;
            $container->locatie = $request->locatie;
            $container->leeg = $request->leeg;
            $container->reference = $request->reference;

            $prefix = '';
            for($i = 0; $i < 6; $i++){
                $prefix .= random_int(0,1) ? chr(random_int(65, 90)) : random_int(0, 9);
            }
            $container->pin = $prefix;
            $container->save();
>>>>>>> 04c2c85aafb93bdb05360daa5759f683e5e667e1
            $data = array("container_number"=>$request->container_number,
                            "container_type"=>$request->container_type,
                            "weight"=>$request->container_number,
                            "name"=>$username,
                            "stack"=>$request->stack,
                            'locatie'=>$request->locatie,
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
}
