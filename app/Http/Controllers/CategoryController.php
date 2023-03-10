<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(){
        $categories=Category::latest()->get();

        return $categories;
    }
    public function store(Request $request){
        $request->validate([
            'name'=>['required','unique:categories']
        ]);

       $category=new Category();
       $category->name=$request->input('name');
       

        return $category->save();
    }

    public function show(Category $category){
        return $category;
    }

    public function update(Request $request,Category $category){
        $request->validate([
            'name'=>['required']
        ]);

       $category->name=$request->input('name');
       
       return $category->save();
    }

public function destroy(Category $category){
   return $category->delete();
}
}
