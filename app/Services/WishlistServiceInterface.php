<?php

namespace App\Services;

interface WishlistServiceInterface
{
    public function getWishlist();
    public function getWishlistCount();
    public function addToWishlist($productId);
    public function removeFromWishlist($productId);
    public function clearWishlist();
}