<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index(){
        $posts = DB::table('posts')
            ->select(['title','slug','body','user_id','created_at'])
            ->where('published','=',1)
            ->where('deleted', '=', 0)
            ->orderBy('created_at', 'desc')
            ->get()
            ->toJson();
        return $posts;
    }
}
