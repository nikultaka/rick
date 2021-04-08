<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use PDF; 

class ContainerlistController extends Controller
{
    public function index() {
    	return view('container/containerlist_contant');
    }
	public function weighTicketsview(){
    	return view('container/weigh_content');
	}

    public function getListContainer(Request $request){
        $data = array();
        $containerData = $request->all();
        $getDatasql = DB::table('containers')
				   ->where('stack','!=','')
				   ->select('containers.*', 'container_type.container_type as container_type')
				   ->leftjoin("container_type", "container_type.id", "=", "containers.container_type");

        if(isset($containerData['search']['value']) && $containerData['search']['value'] != ''){

            $search = $containerData['search']['value'];
            $getDatasql->where('containers.reference','like','%'.$search.'%')
			           ->orWhere('containers.container_number','like','%'.$search.'%')
			           ->orWhere('containers.pin','like','%'.$search.'%')
			           ->orWhere('containers.license_plate','like','%'.$search.'%')
			           ->orWhere('container_type.container_type','like','%'.$search.'%')
			           ->orWhere('containers.leeg','like','%'.$search.'%')
			           ->orWhere('containers.created_at','like','%'.$search.'%');
        }	
        $columns = array(
			0 => 'containers.id',
			1 => 'containers.reference',
			2 => 'containers.created_at',
			3 => 'containers.pin',
			4 => 'containers.license_plate',
			5 => 'containers.container_number',
			6 => 'containers.container_type',
			7 => 'containers.leeg',
			8 => 'containers.adr',
			9 => 'containers.genset'
		);
        if(isset($containerData['order'][0]['column']) && $containerData['order'][0]['column'] != '') {
            $order_by = '';
                if (isset($containerData['order'][0]['dir']) && $containerData['order'][0]['dir'] != '') {
                    $order_by = $columns[$containerData['order'][0]['column']];
                    $getDatasql->orderBy($order_by, $containerData['order'][0]['dir']);
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
		if (isset($containerData['start']) && $containerData['start'] != '' && isset($containerData['length']) && $containerData['length'] != '') {
			$getDatasql->limit($containerData['length'])->offset($containerData['start']);
		}
		// $getDatasql -> orWhereNotNull('stack');
        $listall=$getDatasql->get();
        foreach ($listall as $key => $row) {
			$temp['ticker_number'] = $key+1;
			$temp['reference'] = $row->reference;
			$temp['date_time'] = $row->created_at != '' ? date('d-m-Y h:i', strtotime($row->created_at)) : '';
			$temp['Pincode'] = $row->pin;
			$temp['lisence_plate'] = $row->license_plate;
			$temp['container_number'] = $row->container_number;
			$temp['container_type'] = $row->container_type;
			$temp['vol_leeg'] = $row->leeg;
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
			"draw" => intval($containerData['draw']),
			"recordsTotal" => intval($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data" => $data,
		);
		echo json_encode($json_data);
		exit(0);
    }

	public function getListWeighTickets(Request $request){
		$weighTicketData = $request->all();
		$data = array();
		$weighTicketSql = DB::table('containers')
						->where('stack','')					
						->select('containers.*','container_type.container_type as container_type')
					    ->leftjoin("container_type", "container_type.id", "=", "containers.container_type");

		if(isset($weighTicketData['search']['value']) && $weighTicketData['search']['value'] != '')
		{
			$search = $weighTicketData['search']['value'];
			$weighTicketSql->where('containers.reference','like','%'.$search.'%')
						   ->orWhere('containers.created_at','like','%'.$search.'%')
						   ->orWhere('container_type.container_type','like','%'.$search.'%')
				           ->orWhere('containers.container_number','like','%'.$search.'%')
				           ->orWhere('containers.weight','like','%'.$search.'%')
				           ->orWhere('containers.license_plate','like','%'.$search.'%');
		}	
		$columns = array(
			0 => 'containers.id',
			1 => 'containers.reference',
			2 => 'containers.created_at',
			3 => 'containers.weight',
			4 => 'containers.license_plate',
			5 => 'containers.container_number',
			6 => 'containers.container_type',
		);	
		if(isset($weighTicketData['order'][0]['column']) && $weighTicketData['order'][0]['column'] != '') {
            $order_by = '';
                if (isset($weighTicketData['order'][0]['dir']) && $weighTicketData['order'][0]['dir'] != '') {
                    $order_by = $columns[$weighTicketData['order'][0]['column']];
                    $weighTicketSql->orderBy($order_by, $weighTicketData['order'][0]['dir']);
                }else{
                    $weighTicketSql->orderBy($order_by, "DESC");
                }
		}else{
			$weighTicketSql->orderBy('containers.id', "DESC");
		}
		$count=$weighTicketSql->count();
		$totalData = 0;
		$totalFiltered = 0;
		if ($count > 0){
			$totalData =$count;
			$totalFiltered =$count;
		}
		if (isset($weighTicketData['start']) && $weighTicketData['start'] != '' && isset($weighTicketData['length']) && $weighTicketData['length'] != '') {
			$weighTicketSql->limit($weighTicketData['length'])->offset($weighTicketData['start']);
		}
		$weighTicketSql->orWhereNull('stack');
		$listall=$weighTicketSql->get();

        foreach ($listall as $key => $row) {
			$temp['ticker_number'] = $key+1;
			$temp['reference'] = $row->reference;
			$temp['date_time'] = $row->created_at != '' ? date('d-m-Y h:i', strtotime($row->created_at)) : '';
			$temp['weight'] = $row->weight;
			$temp['lisence_plate'] = $row->license_plate;
			$temp['container_number'] = $row->container_number;
			$temp['container_type'] = $row->container_type;
			$getPDFurl = url('/getPdf' , $row->id);
			$temp['weighing_slip'] = '<div class="sub-menu"><a href="'.$getPDFurl.'" class="link">
									 <i class="fa fa-file-text" style="font-size:13px; mar">
									 <span class="badge badge-pill menu-title" style="font-size:8px;">Download</i></span></a>';
			$data[] = $temp;
		}
        $json_data = array(
			"draw" => intval($weighTicketData['draw']),
			"recordsTotal" => intval($totalData),
			"recordsFiltered" => intval($totalFiltered),
			"data" => $data,
		);
		echo json_encode($json_data);
		exit(0);
	}

	public function getPDF($id){
		$WeighTicketsDetails = DB::table('containers')
						->select('containers.*', 'container_type.container_type as container_type')
						->leftjoin("container_type", "container_type.id","=","containers.container_type")
						->where('containers.id',$id)
						->first();
						
		$pdf = PDF::loadView('container/DownloadPDF',['WeighTicketsDetails' => $WeighTicketsDetails]);
		return $pdf->download('WeightTicketsDetails.pdf');	
		return view('DownloadPDF');
	}
}