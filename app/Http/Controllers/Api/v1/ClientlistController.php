<?php

namespace App\Http\Controllers\Api\v1;

use App\Models\UserloginList;
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
    public function getclientlist(UserloginList $UserloginList)
    {
        try {
            $UserloginListData = UserloginList::all('id','name','email','created_at','updated_at','roles')->toArray();
            if(!empty($UserloginListData)){
                $response = [
                    config('api.CODE')    => config('HttpCodes.success'),
                    config('api.RESULT')  => $UserloginListData
                ];
                //send response
                ParcelHelper::sendResponse($response, config('HttpCodes.success'));
            }    
        } catch (Exception $e) {
            //show exception response
            ParcelHelper::showException($e, $e->getCode());
        }  
    }
    /*public function store(CommentRequest $request, Post $post)
    {
        $comment = new Comment( $request->all() );
        $post->comments()->save( $comment );
        return response([
            'data' => new CommentResource($comment)
        ], Response::HTTP_CREATED);
    }
    
    public function show(Post $post, Comment $comment)
    {
        return new CommentResource($post->comments()->find($comment->id));
    }

    public function update(Request $request, Post $post, Comment $comment)
    {
        $comment->update( $request->all() );
        return response([
            'data' => new CommentResource($comment)
        ], Response::HTTP_CREATED);
    }

    public function destroy(Post $post, Comment $comment)
    {
        $comment->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }*/
    
}

