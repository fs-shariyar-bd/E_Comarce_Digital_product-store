<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\BannerServiceInterface;
use App\Services\CategoryServiceInterface;
use App\Services\ProductServiceInterface;
use App\Services\CartServiceInterface;
use App\Services\WishlistServiceInterface;
use Illuminate\Http\Request;

class CheckoutController extends FrontendController
{
    protected $cartService;
    protected $wishlistService;

    public function __construct(
        BannerServiceInterface $bannerService,
        CategoryServiceInterface $categoryService,
        ProductServiceInterface $productService,
        CartServiceInterface $cartService,
        WishlistServiceInterface $wishlistService
    ) {
        parent::__construct($bannerService, $categoryService, $productService);
        $this->cartService = $cartService;
        $this->wishlistService = $wishlistService;
    }

    public function checkout()
    {
        $summary = $this->cartService->getCartSummary();

        return view('frontend.checkout', [
            'items' => $summary['items'],
            'count' => $summary['count'],
            'subtotal' => $summary['subtotal'],
        ]);
    }
}