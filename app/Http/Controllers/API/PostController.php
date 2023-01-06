<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\PostResource;
use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        $posts = Post::included()
            ->filter()
            ->sort()
            ->getOrPaginate();

        return PostResource::collection($posts);
    }

    public function create(){

    }

    public function store(Request $request){
        $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|max:255|unique:posts',
            'extract' => 'required',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $post = Post::create($request->all());

        return PostResource::make($post);
    }

    public function show(Post $post){
        return PostResource::make($post);
    }

    public function edit(Post $post){

    }

    public function update(Request $request, Post $post){
        $request->validate([
            'name' => 'required|max:255',
            'slug' => 'required|max:255|unique:posts,slug,'.$post->id,
            'extract' => 'required',
            'body' => 'required',
            'category_id' => 'required|exists:categories,id',
            'user_id' => 'required|exists:users,id',
        ]);

        $post->update($request->all());

        return PostResource::make($post);
    }

    public function destroy(Post $post){
        $post->delete();

        return PostResource::make($post);
    }
}
