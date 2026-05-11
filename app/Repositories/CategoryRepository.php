<?php

namespace App\Repositories;

use App\Models\Backend\Category;

class CategoryRepository extends BaseRepository implements CategoryRepositoryInterface
{
    public function __construct(Category $model)
    {
        parent::__construct($model);
    }

    public function withCategory()
    {
        return $this->model->newQuery();
    }

    public function getCategoriesWithSubcategories()
    {
        return $this->model->with('subcategories')->where('status', 1)->get();
    }

    public function getCategoriesForProduct()
    {
        return $this->model->with('products')->withCount('subcategories')->where('status', 1)->orderBy('order')->get();
    }
}