<?php

namespace App\Http\Controllers\Api\v1;
namespace App\Http\Controllers;

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
use DB;

class ContainerlistController extends Controller
{
    public function index(){
    	return view('container\container_list');
    }

    public function getListContainer(Request $request){
        // $containerData  = Container::all()->toArray();
        $data = array();
        $containerData = $request->all();
        $getDatasql = DB::table('containers');
      
        if(isset($containerData['search']['value']) && $containerData['search']['value'] != '')
        {
            $search = $containerData['search']['value'];
            $getDatasql->where('containers.container_type','like','%'.$search.'%')
                       ->orWhere('containers.id','like','%'.$search.'%')
			           ->orWhere('containers.container_number','like','%'.$search.'%')
			           ->orWhere('containers.weight','like','%'.$search.'%')
			           ->orWhere('containers.pin','like','%'.$search.'%')
			           ->orWhere('containers.reference','like','%'.$search.'%')
			           ->orWhere('containers.leeg','like','%'.$search.'%')
			           ->orWhere('containers.created_at','like','%'.$search.'%');
        }
        $columns = array(
			0 => 'containers.id',
			1 => 'containers.reference',
			2 => 'containers.created_at',
			3 => 'containers.pin',
			4 => 'containers.id',
			5 => 'containers.container_number',
			6 => 'containers.container_type',
			7 => 'containers.leeg',
			8 => 'containers.id',
			9 => 'containers.id'
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
			$getDatasql->orderBy('bord.id', "DESC");
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
        $listall=$getDatasql->get();
        foreach ($listall as $key => $row) {
			$temp['ticker_number'] = $row->id;
			$temp['reference'] = $row->reference;
			$temp['date_time'] = $row->created_at;
			$temp['Pincode'] = $row->pin;
			$temp['lisence_plate'] = $row->id;
			$temp['container_number'] = $row->container_number;
			$temp['container_type'] = $row->container_type;
			$temp['vol_leeg'] = $row->leeg;
			$temp['adr'] = '<input type="checkbox" class="form-check-input">';
			$temp['genset'] = '<input type="checkbox" class="form-check-input">';
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
}