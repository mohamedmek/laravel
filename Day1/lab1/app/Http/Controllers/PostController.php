<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Symfony\Contracts\Service\Attribute\Required;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use Illuminate\Support\Facades\Storage;
use  Illuminate\Support\Facades\File;
class PostController extends Controller
{
    
    public function index(){

        $postsFromDB = Post::Paginate(10);
        
        return view(view:'posts.index', data:['posts'=>$postsFromDB ]);
        
    }

    public function create(){
        $users = User::all();
        
        return view(view: 'posts.create',data:['users'=>$users]);
    }

    public function store( StorePostRequest $request)
    {
        //  dd($request->all());
        $path = Storage::putFile('public', $request->file('image'));
        $data = $request->all();
        $title = $data['title'];
        $description = $data['description'];
        $userId = $data['post_creator'];

        Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $userId,
            'image' => $path
        ]);
        return to_route('posts.index');
    }


    public function show($postId){

        $singlePost = Post::findOrFail($postId);
        return view(view:'posts.show',data:['post'=>$singlePost]);


    }
    public function edit($postId){
        $singlePost = Post::findOrFail($postId);
        $users = User::all();
        return view(view:'posts.edit',data:['edit'=>$singlePost, 'users'=>$users]);


    }


    public function update($post,UpdatePostRequest $request){

        $singlePost = Post::findOrFail($post);

        if ($request->exists('image')) {
            $path = Storage::putFile('public', $request->file('image'));
            if($singlePost->image){
                Storage::delete($post->image);
        }}
        else{
            $path=null;
        }

        $singlePost->update([
            'title' => $request->title,
            $singlePost->slug = null,
            'description' => $request->description,
            'user_id' => $request->user_id,
            $singlePost->image = $path,
        ]);
        return redirect()->route('posts.index');
    }

    public function destroy($post){
        $singlePost = Post::findOrFail($post);
        $singlePost->delete();
        return redirect()->route('posts.index');
    }


        public function restore()
        {
            $allPosts = Post::onlyTrashed()->get();
            return view('posts.restore', ['posts' => $allPosts,]);
        }


        public function reback($postId)
        {
            Post::whereId($postId)->restore();
            return back();
        }
}


