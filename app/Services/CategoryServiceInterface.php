<?php

namespace App\Services;

interface CategoryServiceInterface
{
    public function getCategoriesForProduct();
    public function getAllCategories();
    public function getCategoriesWithSubcategories();
    public function getAllPaginated($perPage = 5);
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}