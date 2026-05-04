<?php

namespace App\Repositories;

interface SubCategoryRepositoryInterface
{
    public function all();
    public function paginate($perPage = 5);
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function withCategory(); // For eager loading category
}
