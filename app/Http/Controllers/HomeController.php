<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Support\Collection|\Illuminate\View\View
     */
    public function index()
    {
        $allPosts = DB::table('posts')
            ->select('*')
            ->where('published','=',1)
            ->where('deleted', '=', 0)
            ->orderBy('created_at', 'desc')
            ->get();


        $posts = array();

        foreach ($allPosts as $post){
            $post_user = User::where('id', $post->user_id)->first();
            $myuser = Auth::user();
            if(strcmp("$myuser->gender","$post_user->gender") == 0){
                $post->user = $post_user;
                $post->user->password = null;
                $post->user->social = null;
                array_push($posts,$post);
            }
        }

        return view('home.home',['posts' => $posts]);
    }


}
