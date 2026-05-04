<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StorePostRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->paginate(5);
        return view('backend.category.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.category.create');
    }

    public function store(StorePostRequest $request)
    {


        $Category = new Category ();
        $Category->name = $request->name;
        $Category->order = $request->order;
        $Category->status = $request->status;
        if ($Category->save()) {
            return redirect()->route('category.index')->with('success', 'Category created successfully.');
        }

        return redirect()->back()->with('error', 'Failed to create category.');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('backend.category.edit', compact('category'));
    }



    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'order' => 'nullable|numeric',
            'status' => 'required|in:0,1',
        ]);

        $row = Category::find($id);
        $row->name = $request->name;
        $row->order = $request->order;
        $row->status = $request->status;
        if($row->save()){
            return redirect()->route('category.index')->with('success', 'Category updated successfully.');
        }
        return redirect()->back()->with('error', 'Category not found.');
    }

    public function delete($id)
    {
        $category = Category::destroy($id);

     if($category) {
       return redirect('category/index')->with("success", "Deleted successfully");
     }
     return redirect()->back()->with("danger", "Delete unsuccessful");

    }
    }

