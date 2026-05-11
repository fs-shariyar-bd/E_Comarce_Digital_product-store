<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\SubCategory\StoreSubCategoryRequest;
use App\Http\Requests\SubCategory\UpdateSubCategoryRequest;
use App\Services\SubCategoryServiceInterface;
use App\Services\CategoryServiceInterface;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    protected $subCategoryService;
    protected $categoryService;

    public function __construct(
        SubCategoryServiceInterface $subCategoryService,
        CategoryServiceInterface $categoryService
    ) {
        $this->subCategoryService = $subCategoryService;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $subCategories = $this->subCategoryService->getAllPaginated(5);
        return view('backend.subcategory.index', compact('subCategories'));
    }

    public function create()
    {
        $categories = $this->categoryService->getAllPaginated(100);
        return view('backend.subcategory.create', compact('categories'));
    }

    public function store(StoreSubCategoryRequest $request)
    {
        $data = $request->validated();

        $this->subCategoryService->create($data);

        return redirect()->route('subcategory.index')->with('success', 'SubCategory created successfully.');
    }

    public function edit($id)
    {
        $subCategory = $this->subCategoryService->find($id);
        $categories = $this->categoryService->getAllPaginated(100);
        return view('backend.subcategory.edit', compact('subCategory', 'categories'));
    }

    public function update(UpdateSubCategoryRequest $request, $id)
    {
        $data = $request->validated();

        $this->subCategoryService->update($id, $data);

        return redirect()->route('subcategory.index')->with('success', 'SubCategory updated successfully.');
    }

    public function delete($id)
    {
        $this->subCategoryService->delete($id);

        return redirect()->route('subcategory.index')->with('success', 'SubCategory deleted successfully.');
    }
}