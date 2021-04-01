<?php

namespace App\Http\Controllers\Frontend;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class HandlingstatusController extends Controller
{
    public function index() {
    	return view('container/handling_status');
    }

    public function gethandlingstatus(Request $request){
        $data = array();
        $handlingstatus = $request->all();
        $getDatasql = DB::table('containers');
		$getDatasql->select('containers.*', 'container_type.container_type as container_type')
				   ->leftjoin("container_type", "container_type.id", "=", "containers.container_type");

        if(isset($handlingstatus['search']['value']) && $handlingstatus['search']['value'] != ''){
            $search = $handlingstatus['search']['value'];
            $getDatasql->where('container_type.container_type','like','%'.$search.'%')
                       ->orWhere('containers.id','like','%'.$search.'%')
			           ->orWhere('containers.container_number','like','%'.$search.'%')
			           ->orWhere('containers.pin','like','%'.$search.'%')
			           ->orWhere('containers.license_plate','like','%'.$search.'%')
			           ->orWhere('containers.reference','like','%'.$search.'%')
			           ->orWhere('containers.handling_status','like','%'.$search.'%')
			           ->orWhere('containers.created_at','like','%'.$search.'%');
        }	
        $columns = array(
			0 => 'containers.id',
			1 => 'containers.pin',
			2 => 'containers.created_at',
			3 => 'containers.pin',
			4 => 'containers.license_plate',
			5 => 'containers.container_number',
			6 => 'containers.container_type',
			7 => 'containers.handling_status',
			8 => 'containers.adr',
			9 => 'containers.genset'
		);
        if(isset($handlingstatus['order'][0]['column']) && $handlingstatus['order'][0]['column'] != '') {
            $order_by = '';
                if (isset($handlingstatus['order'][0]['dir']) && $handlingstatus['order'][0]['dir'] != '') {
                    $order_by = $columns[$handlingstatus['order'][0]['column']];
                    $getDatasql->orderBy($order_by, $handlingstatus['order'][0]['dir']);
                }else{
                    $getDatasql->orderBy($order_by, "DESC");
                }
		}else{
			$getDatasql->orderBy('containers.id', "DESC");
		}

        $count=$getDatasql->count();
		$totalData = 0;
		$totalFiltered = 0;
		if ($count > 0){
			$totalData =$count;
			$totalFiltered =$count;
		}
		if (isset($handlingstatus['start']) && $handlingstatus['start'] != '' && isset($handlingstatus['length']) && $handlingstatus['length'] != '') {
			$getDatasql->limit($handlingstatus['length'])->offset($handlingstatus['start']);
		}
        $listall=$getDatasql->get();
        foreach ($listall as $key => $row) {
			$temp['ticker_number'] = $key+1;
			$temp['kind_of_action'] = $row->pin;
			$temp['date_time'] = $row->created_at != '' ? date('d-m-Y h:i', strtotime($row->created_at)) : '';
			$temp['Pincode'] = $row->pin;
			$temp['lisence_plate'] = $row->license_plate;
			$temp['container_number'] = $row->container_number;
			$temp['container_type'] = $row->container_type;
			$temp['number_of_handling'] = $row->handling_status;
			$adrstatus = '';
			if($row->adr == 1){
				$adrstatus = 'checked';
			}else{
				$adrstatus = 'disabled';
            }
			$temp['adr'] = '<input type="checkbox"  '.$adrstatus.'>';
			$gensetstatus = '';
			if($row->genset != ''){
				$gensetstatus = 'checked';
			}else{
				$gensetstatus = 'disabled';
            }
			$temp['genset'] = '<input type="checkbox"  '.$gensetstatus.'>';
			$data[] = $temp;
		}
        $json_data = array(
			"draw" => intval($handlingstatus['draw']),
			"recordsTotal" => intval($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data" => $data,
		);
		echo json_encode($json_data);
		exit(0);
    }
}