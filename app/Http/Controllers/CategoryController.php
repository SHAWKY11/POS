<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function __construct()
    {
        
        $this->middleware('can:read_category' )->only('index');
        $this->middleware('can:create_category')->only('create');
        $this->middleware('can:update_category')->only(['update','edit']);
        $this->middleware('can:delete_category')->only('destroy');
    }
   
    public function index()
    {
        $categories=Category::all();
        return view('dashboard.categories.index',compact('categories'));
    }

   
    public function create()
    {
        return view('dashboard.categories.create');   
    }

    public function store(Request $request)
    {
    $request->validate([
        'name'=>'required|unique:categories,name',
    ]);
            Category::create($request->all());
            return redirect('categories');
    }


    
    public function edit(Category $category)
    {
        return view('dashboard.categories.edit',compact('category'));
    }

   
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name'=>'required|unique:categories,name,'.$category->id,
        ]);

        $category->update($request->all());
        return redirect('categories');
    }

   
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect('categories');
    }
}
