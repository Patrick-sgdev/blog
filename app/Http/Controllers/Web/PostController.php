<?php

namespace App\Http\Controllers\Web;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
           'content' => 'required|max:100000000' 
        ]);

        if($validator->fails()) {

        }

        $post = Post::create(attributes: [
            'user_id' => auth()->user()->id,
            'title' => fake()->text(),
            'content' => $request->content
        ]);

        return response()->json(data: [
            'status' => 'success',
            'data' => $post->id,
            'message' => trans('Post successfully created.'),
        ]);
    }

    public function post(Post $post)
    {
        return view(view: 'post')->with([
            'post' => $post
        ]);
    }

    public function update(Post $post, Request $request)
    {
        $validator = Validator::make($request->all(), [
            'content' => 'required|max:100000000' 
         ]);
 
         if($validator->fails()) {
 
         }
 
         $post->content = $request->content;
         $post->save();
 
         return response()->json(data: [
             'status' => 'success',
             'data' => $post->id,
             'message' => trans('Post successfully created.'),
         ]);
    }
}
