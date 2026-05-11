@extends('backend.master')
@section('content')
@section('title', 'Edit Banner')

<div class="container-fluid  dashboard-content">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Edit Banner</h2>
                <p class="pageheader-text">Update banner information.</p>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard')}}" class="breadcrumb-link">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('banner.index')}}" class="breadcrumb-link">Banner</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Edit Banner</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
</div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('banner.update', $banner->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="form-group">
                            <label for="link">Link URL</label>
                            <input type="text" class="form-control" id="link" name="link" placeholder="Enter link URL" value="{{ $banner->link }}">
                        </div>

                        <div class="form-group">
                            <label for="image">Banner Image</label>
                            @if($banner->image)
                                <div class="mb-2">
                                    <img src="{{ asset($banner->image) }}" alt="Banner" style="width: 200px; height: auto;">
                                </div>
                            @endif
                            <input type="file" class="form-control-file" id="image" name="image" accept="image/*">
                        </div>

                        <div class="form-group">
                            <label for="position">Position</label>
                            <input type="number" class="form-control" id="position" name="position" placeholder="Enter position number" value="{{ $banner->position }}" min="1">
                        </div>

                        <div class="form-group">
                            <label for="type">Type</label>
                            <select class="form-control" id="type" name="type">
                                <option value="slider" {{ $banner->type == 'slider' ? 'selected' : '' }}>Slider Banner</option>
                                <option value="side" {{ $banner->type == 'side' ? 'selected' : '' }}>Side Banner</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="status">Status</label>
                            <select class="form-control" id="status" name="status">
                                <option value="1" {{ $banner->status == 1 ? 'selected' : '' }}>Active</option>
                                <option value="0" {{ $banner->status == 0 ? 'selected' : '' }}>Inactive</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">Update Banner</button>
                        <a href="{{ route('banner.index') }}" class="btn btn-secondary">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
