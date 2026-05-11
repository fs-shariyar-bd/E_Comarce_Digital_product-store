<?php

namespace App\Services;

interface OrderServiceInterface
{
    public function placeOrder($user, $cartItems, $validatedData);
    public function getUserOrders($userId);
    public function getAllOrders();
    public function updateOrderStatus($id, $status);
}