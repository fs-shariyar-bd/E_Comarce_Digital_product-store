<?php

namespace App\Services;

use App\Repositories\CategoryRepositoryInterface;

class CategoryService implements CategoryServiceInterface
{
    public function __construct(
        protected CategoryRepositoryInterface $category,
    ) {}

    public function getCategoriesForProduct()
    {
        return $this->category->getCategoriesForProduct();
    }

    public function getAllCategories()
    {
        return $this->category->getCategoriesForProduct();
    }

    public function getCategoriesWithSubcategories()
    {
        return $this->category->getCategoriesWithSubcategories();
    }

    public function getAllPaginated($perPage = 5)
    {
        return $this->category->paginate($perPage);
    }

    public function find($id)
    {
        return $this->category->find($id);
    }

    public function create($data)
    {
        return $this->category->create($data);
    }

    public function update($id, $data)
    {
        return $this->category->update($id, $data);
    }

    public function delete($id)
    {
        return $this->category->delete($id);
    }
}