<?php

namespace App\Repositories;

interface BannerRepositoryInterface extends BaseRepositoryInterface
{
    public function getByType($type);
}
