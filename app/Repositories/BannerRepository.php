<?php

namespace App\Repositories;

use App\Models\Backend\Banner;

class BannerRepository extends BaseRepository implements BannerRepositoryInterface
{
    public function __construct(Banner $model)
    {
        parent::__construct($model);
    }

    public function getByType($type)
    {
        return $this->model->where('type', $type)->where('status', 1)->orderBy('position')->get();
    }
}