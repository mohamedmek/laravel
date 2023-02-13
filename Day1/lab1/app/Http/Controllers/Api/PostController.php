<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Resources\PostResource;

class PostController extends Controller
{
    public function index(){
        
        $posts= Post::all();
        // $response =[];

        // foreach($posts as $post){
        //     $response []=[
        //         'id' => $post->id,
        //         'title' => $post->title,
        //         'description'=> $post->description,
        //     ];
        // }
        // return $response;
        return PostResource::collection($posts);
    }

    public function show($postId){
        $post = Post::findOrFail($postId);
        return new PostResource($post);
    }

    public function store(StorePostRequest $request)
    {
        //  dd($request->all());
        //$path = Storage::putFile('public', $request->file('image'));
        $data = $request->all();
        $title = $data['title'];
        $description = $data['description'];
        $userId = $data['post_creator'];

        $post = Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $userId,
            //'image' => $path
        ]);
        // return to_route('posts.index');
        return $post;
    }
}
