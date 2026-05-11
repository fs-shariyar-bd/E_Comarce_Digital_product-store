<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Services\OrderServiceInterface;
use Illuminate\Http\Request;

class OrderController extends FrontendController
{
    public function myOrders(OrderServiceInterface $orderService)
    {
        $orders = $orderService->getUserOrders(auth()->id());

        return view('frontend.my-order', compact('orders'));
    }
}