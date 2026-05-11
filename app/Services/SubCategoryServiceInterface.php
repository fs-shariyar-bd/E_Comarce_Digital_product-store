<?php

namespace App\Services;

interface SubCategoryServiceInterface
{
    public function getByCategory($categoryId);
    public function getAllPaginated($perPage = 5);
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}