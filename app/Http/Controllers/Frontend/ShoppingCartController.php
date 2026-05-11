<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrderRequest;
use App\Services\BannerServiceInterface;
use App\Services\CategoryServiceInterface;
use App\Services\ProductServiceInterface;
use App\Services\CartServiceInterface;
use App\Services\WishlistServiceInterface;
use App\Services\OrderServiceInterface;
use Illuminate\Http\Request;

class ShoppingCartController extends FrontendController
{
    public function __construct(
        BannerServiceInterface $bannerService,
        CategoryServiceInterface $categoryService,
        ProductServiceInterface $productService,
        CartServiceInterface $cartService,
        WishlistServiceInterface $wishlistService,
        OrderServiceInterface $orderService,
    ) {
        parent::__construct($bannerService, $categoryService, $productService);
        $this->cartService = $cartService;
        $this->wishlistService = $wishlistService;
        $this->orderService = $orderService;
    }

    public function shoppingCart()
    {
        $summary = $this->cartService->getCartSummary();
        $totals = $this->cartService->calculateTotals($summary['items']);

        return view('frontend.shopping-cart', array_merge($summary, $totals));
    }

    public function add(Request $request)
    {
        $id = $request->input('product_id');

        if (!$id) {
            $response = ['success' => false, 'message' => 'Product ID is required'];
            return $request->ajax() ? response()->json($response) : back()->withErrors(['error' => 'Product ID is required']);
        }

        $summary = $this->cartService->addToCart($id, $request->input('quantity', 1));

        $response = [
            'success' => true,
            'message' => 'Product added to cart successfully!',
            'subtotal' => $summary['subtotal'],
            'count' => $summary['count'],
            'wishlistCount' => $summary['wishlistCount'],
            'items' => $this->formatCartItems($summary['items']),
        ];

        return $request->ajax() ? response()->json($response) : back()->with('success', 'Product added to cart successfully!');
    }

    public function update(Request $request, $id)
    {
        $summary = $this->cartService->updateCartItem($id, $request->input('quantity', 1));

        if (empty($summary['items'])) {
            $response = ['success' => false, 'message' => 'Product not found in cart'];
            return $request->ajax() ? response()->json($response) : back()->withErrors(['error' => 'Product not found in cart']);
        }

        $response = [
            'success' => true,
            'message' => 'Cart updated successfully!',
            'count' => $summary['count'],
            'subtotal' => $summary['subtotal'],
            'wishlistCount' => $summary['wishlistCount'],
        ];

        return $request->ajax() ? response()->json($response) : back()->with('success', 'Cart updated successfully!');
    }

    public function bulkUpdate(Request $request)
    {
        $quantities = $request->input('qty', []);

        if (!is_array($quantities)) {
            $response = ['success' => false, 'message' => 'Invalid quantity data'];
            return $request->ajax() ? response()->json($response) : back()->withErrors(['error' => 'Invalid quantity data']);
        }

        foreach ($quantities as $id => $quantity) {
            if ((int) $quantity > 0) {
                $this->cartService->updateCartItem($id, $quantity);
            }
        }

        $summary = $this->cartService->getCartSummary();

        $response = [
            'success' => true,
            'message' => 'Cart updated successfully!',
            'count' => $summary['count'],
            'subtotal' => $summary['subtotal'],
            'wishlistCount' => $summary['wishlistCount'],
        ];

        return $request->ajax() ? response()->json($response) : back()->with('success', 'Cart updated successfully!');
    }

    public function remove(Request $request, $id)
    {
        $summary = $this->cartService->removeFromCart($id);

        $response = [
            'success' => true,
            'message' => 'Product removed from cart successfully!',
            'count' => $summary['count'],
            'subtotal' => $summary['subtotal'],
            'wishlistCount' => $summary['wishlistCount'],
        ];

        return $request->ajax() ? response()->json($response) : back()->with('success', 'Product removed from cart successfully!');
    }

    public function clear(Request $request)
    {
        $summary = $this->cartService->clearCart();

        $response = [
            'success' => true,
            'message' => 'Cart cleared successfully!',
            'count' => $summary['count'],
            'subtotal' => $summary['subtotal'],
            'wishlistCount' => $summary['wishlistCount'],
        ];

        return $request->ajax() ? response()->json($response) : back()->with('success', 'Cart cleared successfully!');
    }

    public function orderStore(StoreOrderRequest $request)
    {
        $cartSummary = $this->cartService->getCartSummary();

        $result = $this->orderService->placeOrder(
            auth()->user(),
            $cartSummary['items'],
            $request->validated()
        );

        if (!$result['success']) {
            return $request->ajax()
                ? response()->json($result)
                : back()->withErrors(['error' => $result['message']]);
        }

        $response = [
            'success' => true,
            'message' => 'Order placed successfully!',
            'order_id' => $result['order_id'],
        ];

        return $request->ajax() ? response()->json($response) : back()->with('success', 'Order placed successfully!');
    }

    protected function formatCartItems($items)
    {
        $cartItems = [];
        foreach ($items as $item) {
            $cartItems[] = [
                'id' => $item['id'],
                'name' => $item['name'],
                'price' => $item['discount_price'],
                'original_price' => $item['price'],
                'quantity' => $item['quantity'],
                'image' => $item['image'],
            ];
        }
        return $cartItems;
    }
}