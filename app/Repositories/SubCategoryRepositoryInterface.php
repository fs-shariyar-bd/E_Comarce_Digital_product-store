<?php

namespace App\Repositories;

interface SubCategoryRepositoryInterface extends BaseRepositoryInterface
{
    public function getByCategory($categoryId);
}
