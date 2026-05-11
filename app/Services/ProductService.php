<?php

namespace App\Services;

use App\Repositories\ProductRepositoryInterface;

class ProductService implements ProductServiceInterface
{
    public function __construct(
        protected ProductRepositoryInterface $product,
    ) {}

    public function getAllProducts($perPage = 5)
    {
        return $this->product->paginate($perPage);
    }

    public function getProduct($id)
    {
        return $this->product->find($id);
    }

    public function createProduct($data)
    {
        return $this->product->create($data);
    }

    public function updateProduct($id, $data)
    {
        return $this->product->update($id, $data);
    }

    public function deleteProduct($id)
    {
        return $this->product->delete($id);
    }

    public function getSubCategories($categoryId)
    {
        return $this->product->getSubCategoriesByCategory($categoryId);
    }
}