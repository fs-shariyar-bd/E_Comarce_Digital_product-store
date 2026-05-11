<?php

namespace App\Services;

use App\Repositories\SubCategoryRepositoryInterface;

class SubCategoryService implements SubCategoryServiceInterface
{
    public function __construct(
        protected SubCategoryRepositoryInterface $subCategory,
    ) {}

    public function getByCategory($categoryId)
    {
        return $this->subCategory->getByCategory($categoryId);
    }

    public function getAllPaginated($perPage = 5)
    {
        return $this->subCategory->paginate($perPage);
    }

    public function find($id)
    {
        return $this->subCategory->find($id);
    }

    public function create(array $data)
    {
        return $this->subCategory->create($data);
    }

    public function update($id, array $data)
    {
        return $this->subCategory->update($id, $data);
    }

    public function delete($id)
    {
        return $this->subCategory->delete($id);
    }
}