<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StorePostRequest;
use App\Repositories\CategoryRepositoryInterface;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function index()
    {
        $categories = $this->categoryRepository->paginate(5);
        return view('backend.category.index', compact('categories'));
    }

    public function create()
    {
        return view('backend.category.create');
    }

    public function store(StorePostRequest $request)
    {
        $data = $request->validated();

        $this->categoryRepository->create($data);

        return redirect()->route('category.index')->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);
        return view('backend.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'order' => 'nullable|numeric',
            'status' => 'required|in:0,1',
        ]);

        $data = $request->only(['name', 'order', 'status']);

        $this->categoryRepository->update($id, $data);

        return redirect()->route('category.index')->with('success', 'Category updated successfully.');
    }

    public function delete($id)
    {
        $this->categoryRepository->delete($id);

        return redirect()->route('category.index')->with('success', 'Category deleted successfully.');
    }
}

