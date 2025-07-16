<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(){
        
        $categories = Category::all();
        return view('admin.categories.index',compact('categories'));
    }

    public function store(Request $req){
        $req->validate([
            'name' => 'required|string|max:20'
        ]);

        Category::create(['name' => $req->input('name')]);

        return redirect()->back();
    }

    public function update(Request $req, Category $category)
    {
        $req->validate([
            'name' => 'required|string|max:20'
        ]);

        $category->name = $req->name;
        $category->save();

        return redirect()->back();
    }

    public function destroy(Category $category){
        $category->is_deleted = true;
        $category->save();

        return redirect()->back();
    }
}
