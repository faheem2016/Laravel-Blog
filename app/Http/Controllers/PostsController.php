<?php

namespace App\Http\Controllers;

use  App\Post;
use Illuminate\Http\Request;
use  App\Repositories\Posts;

class PostsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function Index(Posts $posts)
    {
        //$posts = $posts->all();
        $posts = Post::latest()
            ->filter(request(['month', 'year']))
            ->get();


        return view('posts.index', compact('posts'));
    }

    public function Show(Post $post){

        return view('posts.show', compact('post'));
    }

    public function Create(){
        return view('posts.create');
    }

    public function Store(){

        $post = request()->validate(
            [
                'title' => 'required',
                'body'  => 'required',
                'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'video' => 'mimes:mp4,ogx,oga,ogv,ogg,webm',
            ]);

        if(request()->hasFile('image')) {
            $imageName = time() . '.' . request()->image->getClientOriginalExtension();
            request()->image->move(public_path('images'), $imageName);
            $post['image'] = $imageName;
        }

        if(request()->hasFile('video')) {
            $videoName = time().'.'.request()->video->getClientOriginalExtension();
            request()->video->move(public_path('videos'), $videoName);
            $post['video'] = $videoName;
        }


        auth()->user()->publish(
            new Post($post)
        );

        session()->flash('message', 'Your post has now been published.');

        return redirect('/');


    }
}
