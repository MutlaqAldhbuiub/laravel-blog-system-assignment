<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cocur\Slugify\Slugify;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $slugify = new Slugify();
        $post = new Post();
        $post->title=$request->input('title');
        $post->body=$request->input('body');
        $post->slug=$slugify->slugify($request->input('title'));
        $post->user_id = $user->id;
        $post->image_url = $request->input("image_url");
        if(!$post->save()){
            return back()->withErrors(['title' => ['Make sure that your title is correct, because the url slug based on it!']]);
        }

        return redirect()->route('showPost',$post->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @param  String  $slug
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post,$slug)
    {
        $post = Post::where('slug', '=', $slug)->firstOrFail();
        if($post){
            return view("posts.show",["post" => $post,"GenderPrefer" => $post->user->hasPrefer("Prefer gender")]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
