<?php

namespace App\Providers;

use App\Repositories\BannerRepository;
use App\Repositories\BannerRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\CategoryRepositoryInterface;
use App\Repositories\ProductRepository;
use App\Repositories\ProductRepositoryInterface;
use App\Repositories\SubCategoryRepository;
use App\Repositories\SubCategoryRepositoryInterface;
use App\Repositories\CartRepository;
use App\Repositories\CartRepositoryInterface;
use App\Repositories\WishlistRepository;
use App\Repositories\WishlistRepositoryInterface;
use App\Repositories\OrderRepository;
use App\Repositories\OrderRepositoryInterface;
use App\Services\BannerService;
use App\Services\BannerServiceInterface;
use App\Services\CartService;
use App\Services\CartServiceInterface;
use App\Services\CategoryService;
use App\Services\CategoryServiceInterface;
use App\Services\OrderService;
use App\Services\OrderServiceInterface;
use App\Services\ProductService;
use App\Services\ProductServiceInterface;
use App\Services\SubCategoryService;
use App\Services\SubCategoryServiceInterface;
use App\Services\WishlistService;
use App\Services\WishlistServiceInterface;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        // Repository Bindings
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
        $this->app->bind(SubCategoryRepositoryInterface::class, SubCategoryRepository::class);
        $this->app->bind(ProductRepositoryInterface::class, ProductRepository::class);
        $this->app->bind(BannerRepositoryInterface::class, BannerRepository::class);
        $this->app->bind(CartRepositoryInterface::class, CartRepository::class);
        $this->app->bind(WishlistRepositoryInterface::class, WishlistRepository::class);
        $this->app->bind(OrderRepositoryInterface::class, OrderRepository::class);

        // Service Bindings
        $this->app->bind(CategoryServiceInterface::class, CategoryService::class);
        $this->app->bind(SubCategoryServiceInterface::class, SubCategoryService::class);
        $this->app->bind(ProductServiceInterface::class, ProductService::class);
        $this->app->bind(BannerServiceInterface::class, BannerService::class);
        $this->app->bind(CartServiceInterface::class, CartService::class);
        $this->app->bind(WishlistServiceInterface::class, WishlistService::class);
        $this->app->bind(OrderServiceInterface::class, OrderService::class);
    }

    public function boot(): void
    {
        Paginator::useBootstrap();

        // Share common data across all frontend views
        View::composer('frontend.*', function ($view) {
            $categories = app(CategoryRepositoryInterface::class)->getCategoriesForProduct();
            $cartItems = app(CartRepositoryInterface::class)->get();
            $count = app(CartRepositoryInterface::class)->count();
            $subtotal = app(CartRepositoryInterface::class)->subtotal();
            $wishlistItems = app(WishlistRepositoryInterface::class)->get();
            $wishlistCount = app(WishlistRepositoryInterface::class)->count();

            $view->with([
                'categories' => $categories,
                'minicartItems' => $cartItems,
                'count' => $count,
                'subtotal' => $subtotal,
                'wishlistItems' => $wishlistItems,
                'wishlistCount' => $wishlistCount,
            ]);
        });
    }
}