<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\CommentRequest;
use App\Http\Controllers\Controller;
use App\Http\Resources\Comment\CommentResource;
use App\Http\Resources\Comment\CommentCollection;
use Symfony\Component\HttpFoundation\Response;
use App\Helpers\ParcelHelper;

class ClientlistController extends Controller
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
    public function getClientList(User $userList)
    {
        try {
            $userListData = User::all('id','name','email','created_at','updated_at','roles')->toArray();
            $data = [];
            if(!empty($userListData)) {
                $data = $userListData;     
            }   
            $response = [
                config('api.CODE')    => config('HttpCodes.success'),
                config('api.RESULT')  => $data
            ];
            ParcelHelper::sendResponse($response, config('HttpCodes.success')); 
        } catch (Exception $e) {
            //show exception response
            ParcelHelper::showException($e, $e->getCode());
        }  
    }
    
}

