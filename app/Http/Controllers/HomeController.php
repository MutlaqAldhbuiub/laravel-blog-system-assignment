<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
//        return view('home');
        $posts = DB::table('posts')
            ->select(['title','slug','body','user_id','created_at'])
            ->where('published','=',1)
            ->where('deleted', '=', 0)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('home.home',['posts' => $posts]);
    }
}
