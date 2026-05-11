<?php

namespace App\Services;

interface ProductServiceInterface
{
    public function getAllProducts($perPage = 5);
    public function getProduct($id);
    public function createProduct(array $data);
    public function updateProduct($id, array $data);
    public function deleteProduct($id);
    public function getSubCategories($categoryId);
}