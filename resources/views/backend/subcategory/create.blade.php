@extends('backend.master')
@section('content')
    @section('title')
    Create SubCategory
    @endsection

                        <div class="container-fluid dashboard-content">
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                      <div class="page-header">
                                          <h2 class="pageheader-title">Create SubCategory</h2>
                                          <p class="pageheader-text">Proin placerat ante duiullam scelerisque a velit ac porta.</p>
                                          <div class="page-breadcrumb">
                                              <nav aria-label="breadcrumb">
                                                  <ol class="breadcrumb">
                                                      <li class="breadcrumb-item"><a href="{{ route('dashboard')}}">Dashboard</a></li>
                                                      <li class="breadcrumb-item"><a href="{{ route('subcategory.index') }}">SubCategory</a></li>
                                                      <li class="breadcrumb-item active">Create</li>
                                                  </ol>
                                              </nav>
                                          </div>
                                      </div>
                                  </div>
                              </div>
                            <div class="row">
                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                                    <div class="card">
                                        <h5 class="card-header">SubCategory Form</h5>
                                        <div class="card-body">
                                            <form action="{{ route('subcategory.store') }}" method="POST">
                                                @csrf
                                                <div class="form-group">
                                                    <label for="category_id">Category</label>
                                                    <select name="category_id" class="form-control" required>
                                                        <option value="">Select Category</option>
                                                        @foreach($categories as $cat)
                                                        <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">SubCategory Name</label>
                                                    <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
                                                    @error('name')
                                                        <small class="text-danger">{{ $message }}</small>
                                                    @enderror
                                                </div>
                                                <div class="form-group">
                                                    <label for="order">Order</label>
                                                    <input type="number" name="order" class="form-control" value="{{ old('order', 0) }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="status">Status</label>
                                                    <select name="status" class="form-control">
                                                        <option value="1" {{ old('status', 1) == 1 ? 'selected' : '' }}>Active</option>
                                                        <option value="0" {{ old('status', 1) == 0 ? 'selected' : '' }}>Inactive</option>
                                                    </select>
                                                </div>
                                                <div class="form-group mb-3">
                                                    <button type="submit" class="btn btn-primary">Create SubCategory</button>
                                                    <a href="{{ route('subcategory.index') }}" class="btn btn-secondary">Cancel</a>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
    @endsection
