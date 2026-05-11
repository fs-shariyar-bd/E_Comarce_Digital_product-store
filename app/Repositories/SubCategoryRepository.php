<?php

namespace App\Repositories;

use App\Models\Backend\SubCategory;

class SubCategoryRepository extends BaseRepository implements SubCategoryRepositoryInterface
{
    public function __construct(SubCategory $model)
    {
        parent::__construct($model);
    }

    public function getByCategory($categoryId)
    {
        return $this->model->where('category_id', $categoryId)
            ->where('status', 1)
            ->orderBy('name')
            ->get();
    }
}