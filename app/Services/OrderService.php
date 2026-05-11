<?php

namespace App\Services;

use App\Models\OrderDetail;
use App\Repositories\OrderRepositoryInterface;
use App\Repositories\CartRepositoryInterface;

class OrderService implements OrderServiceInterface
{
    public function __construct(
        protected OrderRepositoryInterface $orderRepo,
        protected CartRepositoryInterface $cart,
    ) {}

    public function placeOrder($user, $cartItems, $validatedData)
    {
        if (empty($cartItems)) {
            return ['success' => false, 'message' => 'Your cart is empty'];
        }

        $totalAmount = 0;
        foreach ($cartItems as $id => $item) {
            $totalAmount += $item['discount_price'] * $item['quantity'];
        }

        $order = $this->orderRepo->create([
            'user_id' => $user->id,
            'user_phone' => $validatedData['phone'],
            'total_amount' => $totalAmount,
            'order_date' => now(),
            'status' => 'pending',
        ]);

        foreach ($cartItems as $id => $item) {
            OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $id,
                'quantity' => $item['quantity'],
                'unit_price' => $item['discount_price'],
                'total_price' => $item['discount_price'] * $item['quantity'],
            ]);
        }

        $this->cart->clear();

        return [
            'success' => true,
            'message' => 'Order placed successfully!',
            'order_id' => $order->id,
        ];
    }

    public function getUserOrders($userId)
    {
        return $this->orderRepo->getByUser($userId);
    }

    public function getAllOrders()
    {
        return $this->orderRepo->getAll();
    }

    public function updateOrderStatus($id, $status)
    {
        return $this->orderRepo->updateStatus($id, $status);
    }
}