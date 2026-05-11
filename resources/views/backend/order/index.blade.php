@extends('backend.master')

@section('title')
Order List
@endsection

@section('content')

<div class="container-fluid dashboard-content">

    <div class="row">
        <div class="col-xl-12">
            <div class="page-header">

                <h2 class="pageheader-title">Order Tables</h2>
                <p class="pageheader-text">Manage all customer orders</p>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}" class="breadcrumb-link">Dashboard</a>
                            </li>
                            <li class="breadcrumb-item active">Orders</li>
                        </ol>
                    </nav>
                </div>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">

            <div class="card table-card">

                @if(Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif

                @if(Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                @endif

                <!-- Header -->
                <div class="row">
                    <div class="col-6">
                        <h5 class="card-header">
                            <i class="fas fa-shopping-cart" style="margin-right:8px;"></i>
                            Order List
                        </h5>
                    </div>
                </div>

                <!-- Table -->
                <div class="card-body">

                    <table class="table table-bordered">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Order ID</th>
                                <th>User</th>
                                <th>Phone</th>
                                <th>Products</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>

                        @forelse($orders as $order)

                            <tr>

                                <th>{{ $loop->iteration }}</th>

                                <td>#{{ $order->id }}</td>

                                <td>
                                    {{ $order->user->name ?? 'Guest' }}
                                </td>

                                <td>
                                    {{ $order->user_phone }}
                                </td>

                                <td>
                                    @foreach($order->orderDetails as $detail)
                                        {{ $detail->product->name }} <br>
                                    @endforeach
                                </td>

                                <td>
                                    @php
                                        $total = 0;
                                        foreach($order->orderDetails as $detail){
                                            $total += $detail->total_price;
                                        }
                                    @endphp

                                    ${{ number_format($total, 2) }}
                                </td>

                                <td>
                                    @if($order->status == 'pending')
                                        <span class="badge badge-warning">Pending</span>
                                    @elseif($order->status == 'processing')
                                        <span class="badge badge-info">Processing</span>
                                    @elseif($order->status == 'delivered')
                                        <span class="badge badge-success">Delivered</span>
                                    @else
                                        <span class="badge badge-danger">Cancelled</span>
                                    @endif
                                </td>

                                <td>

                                    <form action="{{ route('order.status', $order->id) }}"
                                          method="POST"
                                          class="d-inline">
                                        @csrf

                                        <select name="status" class="form-control form-control-sm d-inline" style="width:120px;">
                                            <option value="pending">Pending</option>
                                            <option value="processing">Processing</option>
                                            <option value="delivered">Delivered</option>
                                            <option value="cancelled">Cancelled</option>
                                        </select>

                                        <button class="btn btn-success btn-sm">
                                            Update
                                        </button>
                                    </form>

                                </td>

                            </tr>

                        @empty

                            <tr>
                                <td colspan="8" class="text-center text-danger">
                                    No orders found
                                </td>
                            </tr>

                        @endforelse

                        </tbody>

                    </table>

                    {{ $orders->links() }}

                </div>

            </div>

        </div>
    </div>

</div>

@endsection
