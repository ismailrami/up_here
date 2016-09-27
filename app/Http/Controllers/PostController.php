<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use JWTAuth;
use App\User;
use App\Post;

class PostController extends Controller

{
    public function __construct()
    {
        $this->middleware('jwt.auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = new User();
        $user = JWTAuth::parseToken()->authenticate();
        $relation_id =  array();
        $posts = array();
        foreach ($user->relations as $tmp ) 
        {
            $user_tmp = User::find($tmp['fuser_id']);
            
            $posts[] = $user_tmp->posts->last();

            
        }

        return response()->json(['posts' => $posts],201);


        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //get user 
        $user = JWTAuth::parseToken()->authenticate();

        //get the post detail
        $newpost = new Post();
        $newpost = $request->all();
        //test about the type of the post
        if($newpost->toall)
        {
            $status=1;
            $message = ($status == 0) ? "no" : "ok";
            $response = \Httpful\Request::post('https://api.parse.com/1/push')
                ->sendsJson()
                ->addHeaders(array(
                    'X-Parse-Application-Id' => "Mx9fIiCPaSbDGHeXPaQ9O9GzU7mWL5GwjrjBbcxw",
                    'X-Parse-REST-API-Key' => "iYPhCIx9EP8LgZHGQAAPvcFNlpnNMqM9i8I4girw",
                    'Content-Type' => 'application/json',
                   )) 
              ->body('{
                "channels": [
                        "id"
                      ],
               
                "data": {
                       "alert": "hey there !",
                        
                   "status": "'.$status.'"
                      }
              }')->send();

        }
        else
        {
            $newpost->s_user_id = $user->id;
            $status=1;
            $message = ($status == 0) ? "no" : "ok";
            $response = \Httpful\Request::post('https://api.parse.com/1/push')
                ->sendsJson()
                ->addHeaders(array(
                    'X-Parse-Application-Id' => "Mx9fIiCPaSbDGHeXPaQ9O9GzU7mWL5GwjrjBbcxw",
                    'X-Parse-REST-API-Key' => "iYPhCIx9EP8LgZHGQAAPvcFNlpnNMqM9i8I4girw",
                    'Content-Type' => 'application/json',
                   )) 
              ->body('{
                "channels": [
                        "id"
                      ],
               
                "data": {
                       "alert": "hey there !",
                        
                   "status": "'.$status.'"
                      }
              }')->send();

        }
        $newpost->save();
        //save post
        return response()->json([],201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = new Post();
        $posts = $post->where('user_id',$id)->get();
        return response()->json(['posts' => $posts],201);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
    }
}
