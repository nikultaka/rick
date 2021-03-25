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

class ContainerlistController extends Controller
{
    public function index(){
    	return view('container\container_list');
    }

    public function getListContainer(Request $request){

    }
}