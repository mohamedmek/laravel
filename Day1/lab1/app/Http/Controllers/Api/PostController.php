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


        return PostResource::collection(Post::with('user')->get()->paginate(2));

    }

    public function show($postId){
        $post = Post::findOrFail($postId);
        return new PostResource($post);
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->all();
        $title = $data['title'];
        $description = $data['description'];
        $userId = $data['post_creator'];

        $post = Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $userId,
        ]);
        return $post;
    }
}
