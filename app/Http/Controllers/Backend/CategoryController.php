<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StorePostRequest;
use App\Services\CategoryServiceInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryServiceInterface $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $categories = $this->categoryService->getAllPaginated(5);
        return view('backend.category.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.category.create');
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        $this->categoryService->create($data);

        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = $this->categoryService->find($id);
        return view('backend.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $id,
            'order' => 'required|integer|unique:categories,order,' . $id,
        ], [
            'name.unique' => 'This category name already exists.',
            'order.unique' => 'This order number is already taken.',
        ]);

        $data = $request->only(['name', 'order', 'status']);

        $this->categoryService->update($id, $data);

        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    public function delete($id)
    {
        $this->categoryService->delete($id);

        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }
}