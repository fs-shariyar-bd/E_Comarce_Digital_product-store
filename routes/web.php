<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\Frontend\FrontendAuthController;
use App\Http\Controllers\Frontend\ShoppingCartController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Frontend\CheckoutController;
use App\Http\Controllers\Frontend\OrderController;
use App\Http\Controllers\Backend\OrderController as BackendOrderController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public routes
Route::get('/' , [FrontendController::class, 'index'])->name('home');
Route::get('/product-details/{id}', [FrontendController::class, 'productDetails'])->name('product.details');
Route::get('/quick-view/{id}', [FrontendController::class, 'quickView'])->name('include.quick.view');

// Auth routes
Route::get('/user-login', [FrontendAuthController::class, 'showLoginRegister'])->name('user.login');
Route::post('/user-login', [FrontendAuthController::class, 'login'])->name('frontend.login');
Route::post('/user-register', [FrontendAuthController::class, 'register'])->name('frontend.register');
Route::post('/user-logout', [FrontendAuthController::class, 'logout'])->name('frontend.logout');
Route::get('/user-forgot-password', [FrontendAuthController::class, 'forgotpassword'])->name('frontend.forgot.password');

// Protected frontend routes — guest কে /user-login এ নিয়ে যাবে + message দেখাবে
Route::middleware('frontend.auth')->group(function () {

  Route::get('/shopping-cart', [ShoppingCartController::class, 'shoppingCart'])->name('shopping.cart');
  Route::post('/cart/add', [ShoppingCartController::class, 'add'])->name('cart.add');
  Route::any('/product/add-to-cart', [ShoppingCartController::class, 'add'])->name('product.add.to.cart');
  Route::post('/cart/update/{id}', [ShoppingCartController::class, 'update'])->name('cart.update');
  Route::post('/cart/bulk-update', [ShoppingCartController::class, 'bulkUpdate'])->name('bulk-update.cart');
  Route::post('/cart/remove/{id}', [ShoppingCartController::class, 'remove'])->name('cart.remove');
  Route::get('/cart/clear', [ShoppingCartController::class, 'clear'])->name('cart.clear');
  Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');

  Route::post('/wishlist/add', [FrontendController::class, 'addToWishlist'])->name('wishlist.add');
  Route::post('/wishlist/remove', [FrontendController::class, 'removeFromWishlist'])->name('wishlist.remove');
  Route::get('/wishlist', [FrontendController::class, 'wishlist'])->name('wishlist.index');

  Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('myorders');
  Route::post('/order-store', [ShoppingCartController::class, 'orderStore'])->name('order.store');

  Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
  Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
  Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Protected backend routes — admin panel
Route::middleware('auth')->group(function () {

  Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

  Route::get('/category', [CategoryController::class, 'index'])->name('category.index');
  Route::get('/category/create', [CategoryController::class, 'create'])->name('category.create');
  Route::post('/category/store', [CategoryController::class, 'store'])->name('category.store');
  Route::get('/category/edit/{id}', [CategoryController::class, 'edit'])->name('category.edit');
  Route::put('/category/update/{id}', [CategoryController::class, 'update'])->name('category.update');
  Route::delete('/category/delete/{id}', [CategoryController::class, 'delete'])->name('category.delete');

  Route::get('/subcategory', [SubCategoryController::class, 'index'])->name('subcategory.index');
  Route::get('/subcategory/create', [SubCategoryController::class, 'create'])->name('subcategory.create');
  Route::post('/subcategory/store', [SubCategoryController::class, 'store'])->name('subcategory.store');
  Route::get('/subcategory/edit/{id}', [SubCategoryController::class, 'edit'])->name('subcategory.edit');
  Route::put('/subcategory/update/{id}', [SubCategoryController::class, 'update'])->name('subcategory.update');
  Route::delete('/subcategory/delete/{id}', [SubCategoryController::class, 'delete'])->name('subcategory.delete');

  Route::get('/product', [ProductController::class, 'index'])->name('product.index');
  Route::get('/product/create', [ProductController::class, 'create'])->name('product.create');
  Route::post('/product/store', [ProductController::class, 'store'])->name('product.store');
  Route::get('/product/edit/{id}', [ProductController::class, 'edit'])->name('product.edit');
  Route::put('/product/update/{id}', [ProductController::class, 'update'])->name('product.update');
  Route::delete('/product/delete/{id}', [ProductController::class, 'delete'])->name('product.delete');

  Route::post('/product/get-subcategories', [ProductController::class, 'getSubCategories'])->name('product.sub-category');

  Route::get('/banner', [BannerController::class, 'index'])->name('banner.index');
  Route::get('/banner/create', [BannerController::class, 'create'])->name('banner.create');
  Route::post('/banner/store', [BannerController::class, 'store'])->name('banner.store');
  Route::get('/banner/edit/{id}', [BannerController::class, 'edit'])->name('banner.edit');
  Route::put('/banner/update/{id}', [BannerController::class, 'update'])->name('banner.update');
  Route::delete('/banner/delete/{id}', [BannerController::class, 'delete'])->name('banner.delete');

  Route::get('/orders', [BackendOrderController::class, 'index'])->name('order.index');
  Route::post('/order/status/{id}', [BackendOrderController::class, 'updateStatus'])->name('order.status');
});
require __DIR__.'/auth.php';