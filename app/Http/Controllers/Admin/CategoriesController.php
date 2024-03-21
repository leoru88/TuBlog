<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Models\Category;

class CategoriesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }   

    public function index()
    { 
        $categories = Category::all();
        return view('admin.categories.index', ['categories'=>$categories]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $newCategory = new Category();

        $newCategory->name = $request->name;
        $newCategory->save();
 
        return redirect()->back();
    }

    public function update(Request $request, $categoryId)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $category = category::find($categoryId);

        $category->name = $request->name;
        $category->save();

        return redirect()->back();
    }

    public function delete(Request $request, $categoryId)
    {
        $category = category::find($categoryId);
        $category->delete();

        return redirect()->back();
    }
}