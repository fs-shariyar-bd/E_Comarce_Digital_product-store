<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\StoreProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Services\ProductServiceInterface;
use App\Services\CategoryServiceInterface;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;
    protected $categoryService;

    public function __construct(
        ProductServiceInterface $productService,
        CategoryServiceInterface $categoryService
    ) {
        $this->productService = $productService;
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        $products = $this->productService->getAllProducts(5);
        return view('backend.product.index', compact('products'));
    }

    public function create()
    {
        $categories = $this->categoryService->getAllPaginated(100);
        return view('backend.product.create', compact('categories'));
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('images')) {
            $data['images'] = $request->file('images');
        }

        $this->productService->createProduct($data);

        return redirect()->route('product.index')->with('success', 'Product created successfully!');
    }

    public function edit($id)
    {
        $product = $this->productService->getProduct($id);
        $categories = $this->categoryService->getAllPaginated(100);
        return view('backend.product.edit', compact('product', 'categories'));
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $data = $request->validated();

        if ($request->hasFile('images')) {
            $data['images'] = $request->file('images');
        }

        $this->productService->updateProduct($id, $data);

        return redirect()->route('product.index')->with('success', 'Product updated successfully!');
    }

    public function delete($id)
    {
        $this->productService->deleteProduct($id);

        return redirect()->route('product.index')->with('success', 'Product deleted successfully!');
    }

    public function getSubCategories(Request $request)
    {
        if (!$request->category_id) {
            return response()->json(['sub_categories' => []]);
        }

        $subCategories = $this->productService->getSubCategories($request->category_id);

        return response()->json(['sub_categories' => $subCategories]);
    }
}