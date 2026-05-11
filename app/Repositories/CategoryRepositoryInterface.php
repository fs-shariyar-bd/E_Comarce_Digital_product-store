<?php

namespace App\Repositories;

interface CategoryRepositoryInterface extends BaseRepositoryInterface
{
    public function withCategory();
    public function getCategoriesWithSubcategories();
    public function getCategoriesForProduct();
}
