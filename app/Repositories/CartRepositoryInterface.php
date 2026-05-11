<?php

namespace App\Repositories;

interface CartRepositoryInterface
{
    public function get();
    public function add($product, $quantity);
    public function update($id, $quantity);
    public function remove($id);
    public function clear();
    public function count();
    public function subtotal();
    public function total();
}
