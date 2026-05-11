<?php

namespace App\Services;

interface BannerServiceInterface
{
    public function getAllBanners();
    public function getByType($type);
    public function getAllPaginated($perPage = 10);
    public function find($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
}