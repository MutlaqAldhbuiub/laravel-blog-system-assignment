<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Cocur\Slugify\Slugify;
use Carbon\Carbon;


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
    public function store(Request $request){
        $user = Auth::user();
        $slugify = new Slugify();
        $post = new Post();
        $post->title=$request->input('title');
        $post->body= urldecode($request->input('body'));
        $post->slug=$slugify->slugify($request->input('title'));
        $post->user_id = $user->id;
        if($request->image_url == null || $request->image_url == ""){
            $post->image_url = "https://i.stack.imgur.com/GNhxO.png";
        }else{
            $post->image_url = $request->input("image_url");
        }
        if(!$post->save()){
            return back()->withErrors(['title' => ['Make sure that your title is correct, because the url slug based on it!']]);
        }

        return redirect()->route('showPost',$post->slug);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Post  $post
     * @param  String  $slug 24 نوفمبر، 2020
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post,$slug){
        Carbon::setLocale('ar');
        $post = Post::where('slug', '=', $slug)->firstOrFail();
        $post->updated = false;
        if($post->created_at != $post->updated_at){
            $post->updated = true;
            $post->updated_at = Carbon::parse($post->updated_at);
        }
        $post->created_at = Carbon::parse($post->created_at);



        foreach ($post->comments as $comment){
            $user = User::find($comment->user_id);
            $comment->user = $user;
            $comment->created_at = Carbon::parse($comment->created_at);
        }
        // get random post to show as suggestion
        $randomPosts = array();
        $random = Post::inRandomOrder()->where('published', true);
        $randomPosts[0]=$random->first();
        $randomPosts[0]->created_at =Carbon::parse($randomPosts[0]->created_at);
        $randomPosts[1]=$random->skip(1)->first();
        $randomPosts[1]->created_at =Carbon::parse($randomPosts[1]->created_at);
        if($post){
            return view("posts.show",["post" => $post,"GenderPrefer" => $post->user->hasPrefer("Prefer gender"),"comments" => $post->comments,'randomPosts'=>$randomPosts]);
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

    public function myPosts(){
        $posts = auth()->user()->posts;
        return view("users.posts",['posts'=>$posts]);
    }


}
