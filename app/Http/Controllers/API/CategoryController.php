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
