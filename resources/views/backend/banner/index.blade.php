@extends('backend.master')
@section('content')
@section('title')
Banner List
@endsection


<div class="container-fluid dashboard-content">
    <!-- ============================================================== -->
    <!-- pageheader -->
    <!-- ============================================================== -->
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Banner Tables</h2>
                <p class="pageheader-text">Manage your banner advertisements</p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard')}}" class="breadcrumb-link">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Banner</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Banner Tables</li>
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
                        <h5 class="card-header"><i class="fas fa-clipboard-list" style="margin-right:8px;"></i><span>Banner list</span></h5>
                    </div>
                    <div class="col-6 text-right">
                        <a href="{{ route('banner.create')}}" class="btn btn-primary float-right mt-2 mr-2"><i class="fas fa-cart-plus" style="margin-right:8px"></i>Add Banner</a>
                    </div>
                </div>

                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Image</th>
                                <th scope="col">Link</th>
                                <th scope="col">Position</th>
                                <th scope="col">Type</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($banners->isNotEmpty())
                                @foreach($banners as $banner)
                                    <tr>
                                        <th scope="row">{{ $loop->iteration }}</th>
                                        <td>
                                            @if($banner->image)
                                                <img src="{{ asset($banner->image) }}" alt="Banner Image" style="width: 60px; height: 40px; object-fit: cover;">
                                            @else
                                                No Image
                                            @endif
                                        </td>
                                        <td>{{ $banner->link ?? 'N/A' }}</td>
                                        <td>{{ $banner->position }}</td>
                                        <td>{{ ucfirst($banner->type) }}</td>
                                        <td>
                                            @if($banner->status == 1)
                                                <span class="badge badge-Active">Active</span>
                                            @else
                                                <span class="badge badge-Inactive">Inactive</span>
                                            @endif
                                        </td>

                                        <td class="action-btns">
                                            <a href="{{ route('banner.edit', $banner->id) }}" class="btn btn-info"><i class="fas fa-edit" style="margin-right: 8px"></i><span>Edit</span></a>
                                            <form action="{{ route('banner.delete', $banner->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-warning" onclick="return confirm('Are you sure you want to delete this banner?')"><i class="far fa-trash-alt" style="margin-right: 8px"></i><span>Delete</span></button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="7" class="text-center">No banners found</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                    {{ $banners->links() }}
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end bordered table -->
        <!-- ============================================================== -->
    </div>
</div>
@endsection