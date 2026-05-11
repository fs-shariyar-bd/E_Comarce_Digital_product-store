<?php

namespace App\Repositories;

use App\Models\Backend\Product;
use Illuminate\Contracts\Session\Session;

class CartRepository implements CartRepositoryInterface
{
    protected $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function get()
    {
        $cart = $this->session->get('cart', []);
        $items = [];

        foreach ($cart as $id => $item) {
            $product = Product::with(['category', 'subCategory', 'images'])->find($id);
            if ($product) {
                $name = $item['name'] ?? '';
                $price = (float)($item['price'] ?? 0);
                $quantity = (int)($item['quantity'] ?? 0);
                $image = $item['image'] ?? null;


                if (isset($item['discount']) && isset($item['discount_price'])) {

                    $discount = (float)($item['discount'] ?? 0);
                    $discount_price = (float)($item['discount_price'] ?? $price);
                } else {
                    $discount = 0;
                    $discount_price = $price;
                }


                $subtotal = $discount_price * $quantity;

                $items[$id] = [
                    'id' => $id,
                    'product' => $product,
                    'name' => $name,
                    'price' => $price,
                    'discount' => $discount,
                    'discount_price' => $discount_price,
                    'quantity' => $quantity,
                    'image' => $image,
                    'subtotal' => $subtotal
                ];
            }
        }

        return $items;
    }

    public function add($product, $quantity)
    {
        $id = $product->id;
        $quantity = (int) $quantity;
        if ($quantity < 1) {
            $quantity = 1;
        }

        $cart = $this->session->get('cart', []);

        $price = $product->price;
        $discount = $product->discount ?? 0;
        $discount_price = $price - ($price * $discount / 100);

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'name' => $product->name,
                'price' => $price,
                'discount' => $discount,
                'discount_price' => $discount_price,
                'quantity' => $quantity,
                'image' => $product->images->first() ? $product->images->first()->path : null,
            ];
        }

        $this->session->put('cart', $cart);
    }

    public function update($id, $quantity)
    {
        $cart = $this->session->get('cart', []);

        if (!isset($cart[$id])) {
            return false;
        }

        $quantity = (int) $quantity;
        if ($quantity < 1) {
            $quantity = 1;
        }

        $cart[$id]['quantity'] = $quantity;
        $this->session->put('cart', $cart);

        return true;
    }

    public function remove($id)
    {
        $cart = $this->session->get('cart', []);

        if (!isset($cart[$id])) {
            return false;
        }

        unset($cart[$id]);
        $this->session->put('cart', $cart);

        return true;
    }

    public function clear()
    {
        $this->session->forget('cart');
    }

    public function count()
    {
        $cart = $this->session->get('cart', []);
        $count = 0;

        foreach ($cart as $item) {
            $count += $item['quantity'];
        }

        return $count;
    }

    public function subtotal()
    {
        $items = $this->get();
        $subtotal = 0;

        foreach ($items as $item) {
            $subtotal += $item['subtotal'];
        }

        return $subtotal;
    }

    public function total()
    {
        return $this->subtotal();
    }
}
