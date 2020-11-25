<?php

namespace App\Http\Controllers\API;

use App\Comment;
use App\Http\Controllers\Controller;
use App\Post;
use App\User;
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


    /**
     * Display the specified resource.
     *
     * @param  String  $slug
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $post = Post::where('slug', '=', $slug)->firstOrFail();
        if($post){
            return $post;
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request,$slug)
    {
        $post = Post::where('slug', '=', $slug)->first();
        if(!$post){
            return response()->json(['message' => "💔💔💔 NOT FOUND 💔💔💔", 'status' => 404]);
        }
        $post->title = $request->input("title");
        $post->body = $request->input("body");
        $post->published = (int) $request->input("published");
        $post->image_url = $request->input("image_url");
        if($post->save()){
            return response()->json(["message" => "🚀🚀🚀 Updated!! 🚀🚀🚀","status" => 200]);
        }
        return response()->json(["message" => "FAILED 😶😶😶","status" => 502]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $slug
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($slug)
    {
        $post = Post::where('slug', '=', $slug)->first();
        if($post) {
            if ($post->delete()) {
                return response()->json(["message" => '🚀🚀🚀 Post deleted! 🚀🚀🚀',"status" => 200]);
            }
        }
        return response()->json(['message' => "💔💔💔 NOT FOUND 💔💔💔", 'status' => 404]);
    }


    ///////// COMMENTS /////////

    public function comments($slug){
        $post = Post::where('slug', '=', $slug)->first();
        if(!$post){
            return response()->json(['message' => "💔💔💔 NOT FOUND 💔💔💔", 'status' => 404]);
        }
        foreach ($post->comments as $comment){
            $user = User::find($comment->user_id);
            $user->password = null;
            $user->email = null;
            $user->social = null;
            $comment->user = $user;

        }
        return $post->comments;
    }




    public function comment($slug,$id){
        $post = Post::where('slug', '=', $slug);
        $comment = Comment::find($id);
        if(!$post){
            return response()->json(['message' => "💔💔💔 NOT FOUND 💔💔💔", 'status' => 404]);
        }
        if(!$comment){
            return response()->json(['message' => "💔💔💔 NOT FOUND 💔💔💔", 'status' => 404]);
        }
        return $comment;
    }

    public function add_comment(Request $request,$slug){
        $post = Post::where('slug', '=', $slug)->first();
        if(!$post){
            return response()->json(['message' => "💔💔💔 POST NOT FOUND 💔💔💔", 'status' => 404]);
        }

        if(!is_numeric($request->user_id)){
            return response()->json(["message" => '⚠️⚠️⚠️⚠️⚠️ user_id NOT A NUMBER!',"status" => 500]);
        }
        $comment = new Comment();
        $comment->comment = $request->input("comment");
        $comment->user_id = $request->input("user_id");
        $comment->post_id = $post->id;
        if($comment->save()){
            return response()->json(["message" => '🚀🚀🚀 Comment created! 🚀🚀🚀',"status" => 200]);
        }

        return response()->json(["message" => "FAILED 😶😶😶","status" => 502]);
    }


}
