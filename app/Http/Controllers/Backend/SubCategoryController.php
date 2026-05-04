<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategory\StoreSubCategoryRequest;
use App\Repositories\SubCategoryRepositoryInterface;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    protected $subCategoryRepository;

    public function __construct(SubCategoryRepositoryInterface $subCategoryRepository)
    {
        $this->subCategoryRepository = $subCategoryRepository;
    }

    public function index()
    {
        $subCategories = $this->subCategoryRepository->paginate(5);
        return view('backend.subcategory.index', compact('subCategories'));
    }

    public function create()
    {
        $categories = \App\Models\Category::all();
        return view('backend.subcategory.create', compact('categories'));
    }

    public function store(StoreSubCategoryRequest $request)
    {
        $data = $request->validated();

        $this->subCategoryRepository->create($data);

        return redirect()->route('subcategory.index')->with('success', 'SubCategory created successfully.');
    }

    public function edit($id)
    {
        $subCategory = $this->subCategoryRepository->find($id);
        $categories = \App\Models\Category::all();
        return view('backend.subcategory.edit', compact('subCategory', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:catagories,id',
            'order' => 'nullable|numeric',
            'status' => 'required|boolean',
        ]);

        $data = $request->only(['name', 'category_id', 'order', 'status']);

        $this->subCategoryRepository->update($id, $data);

        return redirect()->route('subcategory.index')->with('success', 'SubCategory updated successfully.');
    }

    public function delete($id)
    {
        $this->subCategoryRepository->delete($id);

        return redirect()->route('subcategory.index')->with('success', 'SubCategory deleted successfully.');
    }
}
