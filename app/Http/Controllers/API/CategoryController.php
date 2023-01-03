<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        $categories = Category::all();

        return json_decode($categories, 200);
    }

    public function indexScopeFilter(){
        $categories = Category::included()->filter()->get();

        return $categories;
    }
    public function indexScopeSort(){
        $categories = Category::included()
            ->filter()
            ->sort()
            ->get();

        return $categories;
    }

    public function create(){

    }

    public function store(Request $request){
        $request->validate([
            'name'=> 'required|max:255',
            'slug' => 'required|max:255|unique:categories'
        ]);

        $category = Category::create($request->all());

        return json_decode($category, 200);
    }

    public function show(Category $category){
        return json_decode($category, 200);
    }

    public function showPosts($id){
        $category_with_posts = Category::with('posts')->findOrFail($id);
        //$category_with_posts = Category::with(['posts', 'relacion_2'])->findOrFail($id);
        return json_decode($category_with_posts, '200');
    }

    public function showPostsUser($id){
        $category_with_posts = Category::with('posts.user')->findOrFail($id);
        return json_decode($category_with_posts, '200');
    }

    public function showScopes($id){
        $category = Category::included()->findOrFail($id);
        return $category;
    }

    public function edit(Category $category){

    }

    public function update(Request $request, Category $category){
        $request->validate([
            'name'=> 'required|max:255',
            'slug' => 'required|max:255|unique:categories'
        ]);

        $category->update($request->all());

        return json_decode($category, 200);
    }

    public function destroy(Category $category){
        $category->delete();

        return $category;
    }
}
