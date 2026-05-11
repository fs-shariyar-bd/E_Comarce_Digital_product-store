<?php

namespace App\Services;

use App\Repositories\WishlistRepositoryInterface;
use App\Repositories\ProductRepositoryInterface;

class WishlistService implements WishlistServiceInterface
{
    public function __construct(
        protected WishlistRepositoryInterface $wishlist,
        protected ProductRepositoryInterface $product,
    ) {}

    public function getWishlist()
    {
        return $this->wishlist->get();
    }

    public function getWishlistCount()
    {
        return $this->wishlist->count();
    }

    public function addToWishlist($productId)
    {
        $product = $this->product->find($productId);
        $this->wishlist->add($product);

        return [
            'success' => true,
            'wishlist' => $this->wishlist->get(),
            'count' => $this->wishlist->count(),
        ];
    }

    public function removeFromWishlist($productId)
    {
        $removed = $this->wishlist->remove($productId);

        return [
            'success' => $removed,
            'wishlist' => $this->wishlist->get(),
            'count' => $this->wishlist->count(),
        ];
    }

    public function clearWishlist()
    {
        $this->wishlist->clear();

        return [
            'success' => true,
            'wishlist' => [],
            'count' => 0,
        ];
    }
}