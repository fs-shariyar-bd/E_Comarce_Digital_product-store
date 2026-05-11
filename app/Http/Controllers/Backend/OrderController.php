<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Services\OrderServiceInterface;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index(OrderServiceInterface $orderService)
    {
        $orders = $orderService->getAllOrders();

        return view('backend.order.index', compact('orders'));
    }

    public function updateStatus(Request $request, OrderServiceInterface $orderService, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,delivered,cancelled',
        ]);

        $orderService->updateOrderStatus($id, $request->input('status'));

        return back()->with('success', 'Order status updated successfully!');
    }
}