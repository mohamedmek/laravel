<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $allPosts = [
            [
                'id' => 1,
                'title' => 'laravel',
                'description' => 'this is a post',
                'posted_by' => 'mohamed',
                'created_at' => '2022-01-28 19:10:22'
            ],
            [
                'id' => 2,
                'title' => 'nodejs',
                'description' => 'this is a post',
                'posted_by' => 'mohamed',
                'created_at' => '2022-01-28 19:10:22'
            ],
            [
                'id' => 3,
                'title' => 'Django',
                'description' => 'this is a post',
                'posted_by' => 'mohamed',
                'created_at' => '2022-01-28 19:10:22'
            ]
        ];
        // dd($allPosts);
        return view(view: 'index',data: [
            'posts'=>$allPosts,
        ]);
    }
}
