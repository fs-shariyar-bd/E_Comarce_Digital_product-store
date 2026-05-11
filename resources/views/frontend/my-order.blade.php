@extends('frontend.master')

@section('title', 'My Orders')

@section('maincontent')

<!-- Breadcrumb -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li class="active">My Orders</li>
            </ul>
        </div>
    </div>
</div>

<!-- My Orders Area -->
<div class="my-orders-area pt-60 pb-60">
    <div class="container">

        <div class="row">
            <div class="col-12">

                <div class="table-content table-responsive">
                    <table class="table table-bordered text-center">

                        <thead class="bg-light">
                            <tr>
                                <th>Order ID</th>
                                <th>Date</th>
                                <th>Phone</th>
                                <th>Products</th>
                                <th>Qty</th>
                                <th>Total</th>
                                <th>Status</th>
                            </tr>
                        </thead>

                        <tbody>

                        @forelse ($orders as $order)

                            <tr>
                                <td>#{{ $order->id }}</td>

                                <td>
                                    {{ \Carbon\Carbon::parse($order->order_date)->format('d M, Y') }}
                                </td>

                                <td>
                                    {{ $order->user_phone }}
                                </td>

                                <td class="text-left">
                                    @foreach ($order->orderDetails as $detail)
                                        • {{ $detail->product->name }} <br>
                                    @endforeach
                                </td>

                                <td>
                                    @foreach ($order->orderDetails as $detail)
                                        {{ $detail->quantity }} <br>
                                    @endforeach
                                </td>

                                <td>
                                    @php
                                        $total = 0;
                                        foreach ($order->orderDetails as $detail) {
                                            $total += $detail->total_price;
                                        }
                                    @endphp

                                    ${{ number_format($total, 2) }}
                                </td>

                                <td>
                                    @if($order->status == 'pending')
                                        <span class="badge bg-warning text-dark">Pending</span>

                                    @elseif($order->status == 'processing')
                                        <span class="badge bg-info">Processing</span>

                                    @elseif($order->status == 'delivered')
                                        <span class="badge bg-success">Delivered</span>

                                    @else
                                        <span class="badge bg-danger">Cancelled</span>
                                    @endif
                                </td>
                            </tr>

                        @empty

                            <tr>
                                <td colspan="7" class="text-center text-danger">
                                    😢 You have no orders yet
                                </td>
                            </tr>

                        @endforelse

                        </tbody>

                    </table>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection
