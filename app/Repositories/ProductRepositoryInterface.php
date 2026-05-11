<?php

namespace App\Repositories;

interface ProductRepositoryInterface extends BaseRepositoryInterface
{
    public function getSubCategoriesByCategory($categoryId);
}
