<?php

namespace App\Services;

use App\Repositories\BannerRepositoryInterface;

class BannerService implements BannerServiceInterface
{
    public function __construct(
        protected BannerRepositoryInterface $banner,
    ) {}

    public function getAllBanners()
    {
        return $this->banner->all();
    }

    public function getByType($type)
    {
        return $this->banner->getByType($type);
    }

    public function getAllPaginated($perPage = 10)
    {
        return $this->banner->paginate($perPage);
    }

    public function find($id)
    {
        return $this->banner->find($id);
    }

    public function create(array $data)
    {
        return $this->banner->create($data);
    }

    public function update($id, array $data)
    {
        return $this->banner->update($id, $data);
    }

    public function delete($id)
    {
        return $this->banner->delete($id);
    }
}