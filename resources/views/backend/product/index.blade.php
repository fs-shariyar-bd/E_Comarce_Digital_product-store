@extends('backend.master')
@section('content')
@section('title')
Product List
@endsection


<div class="container-fluid dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Product Tables</h2>
                <p class="pageheader-text">Manage your product inventory</p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard')}}" class="breadcrumb-link">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Products</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Product Tables</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- end pageheader -->
    <!-- ============================================================== -->


    <div class="row">
        <!-- ============================================================== -->
        <!-- bordered table -->
        <!-- ============================================================== -->
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
                <div class="row">
                    <div class="col-6">
                        <h5 class="card-header"><i class="fas fa-clipboard-list" style="margin-right:8px;"></i><span>Product list</span></h5>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('product.create')}}" class="btn btn-primary float-right mt-2 mr-2"><i class="fas fa-cart-plus" style="margin-right:8px"></i>Add Product</a>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
<thead>
                             <tr>
                                 <th scope="col">#</th>
                                 <th scope="col">Image</th>
                                 <th scope="col">Name</th>
                                 <th scope="col">Category</th>
                                 <th scope="col">Price</th>
                                 <th scope="col">Status</th>
                                 <th scope="col">Action</th>
                             </tr>
                         </thead>
                        <tbody>
                            @if($products->isNotEmpty())
                                @foreach($products as $product)
<tr>
                                         <th scope="row">{{ $loop->iteration }}</th>
                                         <td>
                                             @if($product->firstimage)
                                                 <img src="{{ asset($product->firstimage->path) }}" alt="Product Image" style="width: 50px; height: 50px; object-fit: cover;">
                                             @else
                                                 <span class="text-muted">No Image</span>
                                             @endif
                                         </td>
                                         <td>{{ $product->name }}</td>
                                         <td>{{ $product->category->name ?? 'N/A' }}</td>
                                         <td>${{ number_format($product->price, 2) }}</td>
                                         <td>
                                             @if($product->status == 1)
                                                 <span class="badge badge-Active">Active</span>
                                             @else
                                                 <span class="badge badge-Inactive">Inactive</span>
                                             @endif
                                         </td>

                                        <td class="action-btns">
                                            <a href="{{ route('product.edit', $product->id) }}" class="btn btn-info"><i class="fas fa-edit" style="margin-right: 8px"></i><span>Edit</span></a>
                                            <form action="{{ route('product.delete', $product->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-warning" onclick="return confirm('Are you sure you want to delete this product?')"><i class="far fa-trash-alt" style="margin-right: 8px"></i><span>Delete</span></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">No products found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $products->links() }}
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end bordered table -->
        <!-- ============================================================== -->
    </div>
</div>
@endsection