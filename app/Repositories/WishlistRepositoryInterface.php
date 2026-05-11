<?php

namespace App\Repositories;

interface WishlistRepositoryInterface
{
    public function get();
    public function add($product);
    public function remove($id);
    public function clear();
    public function count();
}