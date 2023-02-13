<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    public function index(){
        
        return Post::all();
    }

    public function show($postId){
        return Post::findOrFail($postId);
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
