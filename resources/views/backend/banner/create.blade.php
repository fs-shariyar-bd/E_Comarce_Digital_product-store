@extends('backend.master')

@section('title', 'Create Banner')

@section('content')

<div class="container-fluid dashboard-content">

    <!-- Page Header -->
    <div class="row">
        <div class="col-12">
            <div class="page-header">
                <h2 class="pageheader-title">Create Banner</h2>

                <p class="pageheader-text">
                    Add a new banner for the home page slider.
                </p>

                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('dashboard') }}" class="breadcrumb-link">
                                    Dashboard
                                </a>
                            </li>

                            <li class="breadcrumb-item">
                                <a href="{{ route('banner.index') }}" class="breadcrumb-link">
                                    Banner
                                </a>
                            </li>

                            <li class="breadcrumb-item active" aria-current="page">
                                Create Banner
                            </li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Validation Errors -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Form -->
    <div class="row">
        <div class="col-12">
            <div class="card">

                <div class="card-header">
                    <h4 class="mb-0">Banner Information</h4>
                </div>

                <div class="card-body">

                    <form action="{{ route('banner.store') }}"
                          method="POST"
                          enctype="multipart/form-data">

                        @csrf

                        <!-- Link -->
                        <div class="form-group">
                            <label for="link">Link URL</label>

                            <input type="url"
                                   class="form-control @error('link') is-invalid @enderror"
                                   id="link"
                                   name="link"
                                   placeholder="Enter link URL"
                                   value="{{ old('link') }}">

                            @error('link')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <!-- Image -->
                        <div class="form-group">
                            <label for="image">Banner Image</label>

                            <input type="file"
                                   class="form-control-file @error('image') is-invalid @enderror"
                                   id="image"
                                   name="image"
                                   accept="image/*">

                            @error('image')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <!-- Position -->
                        <div class="form-group">
                            <label for="position">Position</label>

                            <input type="number"
                                   class="form-control @error('position') is-invalid @enderror"
                                   id="position"
                                   name="position"
                                   placeholder="Enter position number"
                                   value="{{ old('position', 1) }}"
                                   min="1">

                            @error('position')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <!-- Type -->
                        <div class="form-group">
                            <label for="type">Type</label>

                            <select class="form-control @error('type') is-invalid @enderror"
                                    id="type"
                                    name="type">

                                <option value="slider"
                                    {{ old('type') == 'slider' ? 'selected' : '' }}>
                                    Slider Banner
                                </option>

                                <option value="side"
                                    {{ old('type') == 'side' ? 'selected' : '' }}>
                                    Side Banner
                                </option>

                            </select>

                            @error('type')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <!-- Status -->
                        <div class="form-group">
                            <label for="status">Status</label>

                            <select class="form-control @error('status') is-invalid @enderror"
                                    id="status"
                                    name="status">

                                <option value="1"
                                    {{ old('status', 1) == 1 ? 'selected' : '' }}>
                                    Active
                                </option>

                                <option value="0"
                                    {{ old('status') == 0 ? 'selected' : '' }}>
                                    Inactive
                                </option>

                            </select>

                            @error('status')
                                <small class="text-danger">
                                    {{ $message }}
                                </small>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="mt-4">

                            <button type="submit" class="btn btn-primary">
                                Create Banner
                            </button>

                            <a href="{{ route('banner.index') }}"
                               class="btn btn-secondary">
                                Cancel
                            </a>

                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

</div>

@endsection
