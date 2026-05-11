<?php

namespace App\Repositories;

use App\Models\Order;

class OrderRepository implements OrderRepositoryInterface
{
    protected $model;

    public function __construct(Order $model)
    {
        $this->model = $model;
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function find($id)
    {
        return $this->model->with('orderDetails.product', 'user')->findOrFail($id);
    }

    public function getByUser($userId)
    {
        return $this->model->with('orderDetails.product')
            ->where('user_id', $userId)
            ->latest()
            ->get();
    }

    public function getAll()
    {
        return $this->model->with('orderDetails.product', 'user')
            ->latest()
            ->paginate(20);
    }

    public function updateStatus($id, $status)
    {
        $order = $this->model->find($id);
        if ($order) {
            $order->status = $status;
            $order->save();
            return $order;
        }
        return null;
    }
}