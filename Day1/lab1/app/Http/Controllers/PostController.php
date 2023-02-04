<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
class PostController extends Controller
{
    
    public function index(){

        $postsFromDB = Post::all();
        return view(view:'posts.index', data:['posts'=>$postsFromDB]);
        
    }

    public function create(){

        return view(view: 'posts.create');
    }

    public function store(){

        $data = request();
        $title = request()->title;
        $description = request()->desc;
        $posted_by = request()->creator;

        $post = Post::create([
            'title' => $title,
            'description' => $description,
            'author' => $posted_by
        ]);
        return redirect('/posts');
    }

    public function show($postId){

        $postsFromDB = Post::all();
        foreach ($postsFromDB as $key => $value) {
            if($value['id'] == $postId){

                return view(view:'posts.show',data:['show'=>$value]);
            } 
            
        }
    }
    public function edit($postId){
        $singlePost = Post::findOrFail($postId);
        return view(view:'posts.edit',data:['edit'=>$singlePost]);


    }
    public function update($post,Request $request){

        $singlePost = Post::findOrFail($post);
        $singlePost->update([
            'title' => $request->title,
            'description' => $request->desc,
            'author' => $request->creator
        ]);
        return redirect()->route('posts.index');
    }
    public function destroy($post){
        // Post::where('id',$post)->delete(); // delete in single line
        $singlePost = Post::findOrFail($post);
        $singlePost->delete();
        return redirect()->route('posts.index');
    }
}


