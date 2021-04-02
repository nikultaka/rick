<?php

namespace App\Http\Controllers\Api\v1;
namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App\Helpers\ParcelHelper;
use App\Models\CorporateInformation;


class CorporateInformationController extends Controller
{
    public function index(){
    	// return view('container/corporate_information');
        $userId = Auth::id();
        $editdatasql = CorporateInformation::where('userId',$userId)->first();
        $result['data']=$editdatasql;
        
        return view('container/corporate_info')->with($result);
    }

    private static function CorporateInformationValidationRules(): array
    {
        return [
            'address1'              => 'required',
            'address2'              => 'required',
            'state'                 => 'required',
            'city'                  => 'required',
            'vatnumber'             => 'required',
            // 'clientid'           => 'required',
            'weighingslipsemail'    => 'required',
            'storageemail'          => 'required',
            'invoiceemail'          => 'required',   
        ];
    }
    public function insertCorporateInformation(Request $request){
    try{
        $userId = Auth::id();
        ParcelHelper::validateRequest($request->all(), self::CorporateInformationValidationRules($request->all()));
        $corporateData =$request->all();
        $getDatasql = CorporateInformation::where('userId',$userId)->first();
        $data = array();
        $data['status'] = 0;
        $data['msg'] = "Error Your Data insert Unsuccessful !";
        if($getDatasql == ''){
        $corporateDataInsert = new CorporateInformation();
            $corporateDataInsert->address1      = $corporateData['address1'];
            $corporateDataInsert->address2      = $corporateData['address2'];
            $corporateDataInsert->state         = $corporateData['state'];
            $corporateDataInsert->city          = $corporateData['city'];
            $corporateDataInsert->vatnumber     = $corporateData['vatnumber'];
            $corporateDataInsert->clientid      = '';
            $corporateDataInsert->weighingslipsemail  = $corporateData['weighingslipsemail'];
            $corporateDataInsert->storageemail  = $corporateData['storageemail'];
            $corporateDataInsert->invoiceemail  = $corporateData['invoiceemail'];
            $corporateDataInsert->userid  = $userId;
            $corporateDataInsert->save();
            $insert_id = $corporateDataInsert->id;

            if($insert_id > 0){
                $data['status'] = 1;
                $data['msg'] = "Data insert Successfully !";
            }
        }else{
            $UpdateDetails = corporateInformation::where('userId',$userId)->first();
                $UpdateDetails->address1          = $corporateData['address1'];
                $UpdateDetails->address2          = $corporateData['address2'];
                $UpdateDetails->state             = $corporateData['state'];
                $UpdateDetails->city              = $corporateData['city'];
                $UpdateDetails->vatnumber         = $corporateData['vatnumber'];
                $UpdateDetails->clientid          = '';
                $UpdateDetails->weighingslipsemail  = $corporateData['weighingslipsemail'];
                $UpdateDetails->storageemail      = $corporateData['storageemail'];
                $UpdateDetails->invoiceemail      = $corporateData['invoiceemail'];
                $UpdateDetails->save();
                $data['status'] = 1;
                $data['msg'] = "Data Update Successfully!";
        }
        echo json_encode($data);
        exit();
    }catch (Exception $e) {   
        echo $e->getMessage(); die;
        ParcelHelper::showException($e, $e->getCode());
    }

}

}