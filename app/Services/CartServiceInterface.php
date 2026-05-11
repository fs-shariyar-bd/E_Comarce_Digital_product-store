<?php

namespace App\Services;

interface CartServiceInterface
{
    public function getCartItems();
    public function getCartCount();
    public function getCartSubtotal();
    public function getCartSummary();
    public function addToCart($productId, $quantity = 1);
    public function updateCartItem($productId, $quantity);
    public function removeFromCart($productId);
    public function clearCart();
    public function calculateTotals($items);
}