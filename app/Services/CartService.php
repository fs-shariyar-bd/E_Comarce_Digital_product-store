<?php

namespace App\Services;

use App\Repositories\CartRepositoryInterface;
use App\Repositories\WishlistRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;

class CartService implements CartServiceInterface
{
    public function __construct(
        protected CartRepositoryInterface $cart,
        protected WishlistRepositoryInterface $wishlist,
        protected ProductRepositoryInterface $product,
    ) {}

    public function getCartItems()
    {
        return $this->cart->get();
    }

    public function getCartCount()
    {
        return $this->cart->count();
    }

    public function getCartSubtotal()
    {
        return $this->cart->subtotal();
    }

    public function getCartSummary()
    {
        $items = $this->cart->get();
        $count = $this->cart->count();
        $subtotal = $this->cart->subtotal();
        $wishlistCount = $this->wishlist->count();

        return [
            'items' => $items,
            'count' => $count,
            'subtotal' => $subtotal,
            'wishlistCount' => $wishlistCount,
        ];
    }

    public function addToCart($productId, $quantity = 1)
    {
        $product = $this->product->find($productId);
        $quantity = (int) $quantity;
        if ($quantity < 1) {
            $quantity = 1;
        }

        $this->cart->add($product, $quantity);

        return $this->getCartSummary();
    }

    public function updateCartItem($productId, $quantity)
    {
        $quantity = (int) $quantity;
        if ($quantity < 1) {
            $quantity = 1;
        }

        $this->cart->update($productId, $quantity);

        return $this->getCartSummary();
    }

    public function removeFromCart($productId)
    {
        $this->cart->remove($productId);

        return $this->getCartSummary();
    }

    public function clearCart()
    {
        $this->cart->clear();

        return $this->getCartSummary();
    }

    public function calculateTotals($items)
    {
        $originalTotal = 0;
        $discountTotal = 0;
        $total = 0;

        foreach ($items as $item) {
            $originalPrice = $item['product']->price;
            $quantity = $item['quantity'];
            $discountPercentage = $item['product']->discount ?? 0;

            $itemOriginalTotal = $originalPrice * $quantity;
            $itemDiscountAmount = $itemOriginalTotal * ($discountPercentage / 100);
            $itemFinalTotal = $itemOriginalTotal - $itemDiscountAmount;

            $originalTotal += $itemOriginalTotal;
            $discountTotal += $itemDiscountAmount;
            $total += $itemFinalTotal;
        }

        return [
            'original_total' => $originalTotal,
            'discount_total' => $discountTotal,
            'total' => $total,
        ];
    }
}