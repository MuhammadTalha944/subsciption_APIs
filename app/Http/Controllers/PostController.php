<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Models\Subscriptions;
use App\Jobs\SendEmailJob;
use Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::all();
            return response()->json([
            "success" => true,
            "message" => "All Posts",
            "data" => $posts
        ]);
    }
    
    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */

    public function store(Request $request)
    {
        $input = $request->all();
        $validator = Validator::make($input, [
            'title' => 'required',
            'description' => 'required' 
        ]);

        if($validator->fails()){
            return response()->json([
                "error" => false,
                "message" => "Validation Errors",
                "data" => $validator->errors()
            ]);
        }

        $post = Post::create($input);

        $subscriber = Subscriptions::all()->pluck('email')->toArray();
        // dd($subscriber);
        $body = 'A new Post is listed on our website, <br> Title : '.$input['title'].'<br>'.
                'Description : '.$input['description'];  
  
        $details = [
            'greeting' => 'Hi there',
            'title' => $input['title'],
            'description' => $input['description'],
            'thanks' => 'Thank you!',
        ];
        $details['email'] = $subscriber;

        dispatch(new \App\Jobs\SendEmailJob($details));

        return response()->json([
            "success" => true,
            "message" => "Post created successfully.",
            "data" => $input
        ]);
    } 

}