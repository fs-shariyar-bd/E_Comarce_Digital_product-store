<?php

namespace App\Repositories;

use App\Models\Backend\Product;
use Illuminate\Contracts\Session\Session;

class WishlistRepository implements WishlistRepositoryInterface
{
    protected $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function get()
    {
        $wishlist = $this->session->get('wishlist', []);
        $items = [];

        foreach ($wishlist as $id => $item) {
            $product = Product::with(['category', 'subCategory', 'images'])->find($id);
            if ($product) {
                $items[$id] = [
                    'id' => $id,
                    'product' => $product,
                    'name' => $item['name'],
                    'price' => $item['price'],
                    'image' => $item['image'],
                ];
            }
        }

        return $items;
    }

    public function add($product)
    {
        $id = $product->id;

        $wishlist = $this->session->get('wishlist', []);

        if (!isset($wishlist[$id])) {
            $image = $product->images->first();
            $wishlist[$id] = [
                'name' => $product->name,
                'price' => $product->price,
                'image' => $image ? $image->path : null,
            ];

            $this->session->put('wishlist', $wishlist);
        }

        return true;
    }

    public function remove($id)
    {
        $wishlist = $this->session->get('wishlist', []);

        if (isset($wishlist[$id])) {
            unset($wishlist[$id]);
            $this->session->put('wishlist', $wishlist);
            return true;
        }

        return false;
    }

    public function clear()
    {
        $this->session->forget('wishlist');
    }

    public function count()
    {
        $wishlist = $this->session->get('wishlist', []);
        return count($wishlist);
    }
}
