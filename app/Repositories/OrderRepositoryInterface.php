<?php

namespace App\Repositories;

interface OrderRepositoryInterface
{
    public function create(array $data);
    public function find($id);
    public function getByUser($userId);
    public function getAll();
    public function updateStatus($id, $status);
}