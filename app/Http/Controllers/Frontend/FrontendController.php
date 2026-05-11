<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\BannerServiceInterface;
use App\Services\CategoryServiceInterface;
use App\Services\WishlistServiceInterface;
use App\Services\CartServiceInterface;
use App\Services\ProductServiceInterface;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    protected $bannerService;
    protected $categoryService;
    protected $productService;

    public function __construct(
        BannerServiceInterface $bannerService,
        CategoryServiceInterface $categoryService,
        ProductServiceInterface $productService
    ) {
        $this->bannerService = $bannerService;
        $this->categoryService = $categoryService;
        $this->productService = $productService;
    }

    public function index()
    {
        $sliderBanners = $this->bannerService->getByType('slider');
        $sideBanners = $this->bannerService->getByType('side');

        $categories = $this->categoryService->getCategoriesForProduct();

        return view('frontend.home', compact('sliderBanners', 'sideBanners', 'categories'));
    }

    public function productDetails($id)
    {
        $categories = $this->categoryService->getCategoriesForProduct();
        $product = $this->productService->getProduct($id);

        return view('frontend.product-details', compact('product', 'categories'));
    }

    public function quickView($id)
    {
        $product = $this->productService->getProduct($id);
        return view('frontend.include.quickview', compact('product'));
    }

    public function addToWishlist(Request $request, WishlistServiceInterface $wishlistService)
    {
        $id = $request->input('product_id');

        if (!$id) {
            $response = ['success' => false, 'message' => 'Product ID is required'];
            return $request->ajax() ? response()->json($response) : back()->withErrors(['error' => 'Product ID is required']);
        }

        $result = $wishlistService->addToWishlist($id);

        return $request->ajax() ? response()->json($result) : back()->with('success', 'Product added to wishlist successfully!');
    }

    public function removeFromWishlist(Request $request, WishlistServiceInterface $wishlistService)
    {
        $id = $request->input('product_id');

        if (!$id) {
            $response = ['success' => false, 'message' => 'Product ID is required'];
            return $request->ajax() ? response()->json($response) : back()->withErrors(['error' => 'Product ID is required']);
        }

        $result = $wishlistService->removeFromWishlist($id);

        return $request->ajax() ? response()->json($result) : back()->with('success', 'Product removed from wishlist successfully!');
    }

    public function wishlist(WishlistServiceInterface $wishlistService)
    {
        $wishlistItems = $wishlistService->getWishlist();
        $wishlistCount = $wishlistService->getWishlistCount();

        return view('frontend.wishlist', compact('wishlistItems', 'wishlistCount'));
    }
}