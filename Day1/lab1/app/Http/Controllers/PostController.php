<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;
use Symfony\Contracts\Service\Attribute\Required;
use App\Http\Requests\StorePostRequest;
class PostController extends Controller
{
    
    public function index(){

        $postsFromDB = Post::all();
        return view(view:'posts.index', data:['posts'=>$postsFromDB]);
        
    }

    public function create(){
        $users = User::all();
        return view(view: 'posts.create',data:['users'=>$users]);
    }

    public function store(StorePostRequest $request){

        // $data = request();

        // request() ->validate([
        //     'title' => ['required','min:5'],
        //     'desc'  => ['required','max:255'],
        // ],
        // ['desc.max'=>'description maximum is 255']
        // );
        // $title = request()->title;
        // $description = request()->desc;
        // $posted_by = request()->user_id;

        // $post = Post::create([
        //     'title' => $title,
        //     'description' => $description,
        //     'user_id' => $posted_by
        // ]);
        
        // return redirect('/posts');


        $data = $request->all();

        $title = $data['title'];
        $description = $data['description'];
        $userId = $data['user_id'];

        //store the form data inside the database
        Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' => $userId,
        ]);

        return to_route('posts.index');
    }

    public function show($postId){

        $singlePost = Post::findOrFail($postId);
        return view(view:'posts.show',data:['show'=>$singlePost]);


    }
    public function edit($postId){
        $singlePost = Post::findOrFail($postId);
        $users = User::all();
        return view(view:'posts.edit',data:['edit'=>$singlePost, 'users'=>$users]);


    }
    public function update($post,Request $request){


        $request->validate([
            'title' => ['Required','min:5'],
            'desc'  => ['required','max:255'],
        ]);

        $singlePost = Post::findOrFail($post);
        $singlePost->update([
            'title' => $request->title,
            'description' => $request->desc,
            'user_id' => $request->user_id
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


