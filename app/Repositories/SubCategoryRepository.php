<?php

namespace App\Repositories;

use App\Models\Backend\SubCategory;

class SubCategoryRepository implements SubCategoryRepositoryInterface
{
    protected $model;

    public function __construct(SubCategory $subCategory)
    {
        $this->model = $subCategory;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function paginate($perPage = 5)
    {
        return $this->model->with('category')->latest()->paginate($perPage);
    }

    public function find($id)
    {
        return $this->model->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $model = $this->find($id);
        $model->update($data);
        return $model;
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function withCategory()
    {
        return $this->model->with('category');
    }
}

