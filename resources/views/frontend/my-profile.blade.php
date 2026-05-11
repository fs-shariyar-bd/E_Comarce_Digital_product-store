@extends('frontend.master')
@section('title', 'Profile')
@section('maincontent')
  <!-- Begin Li's Breadcrumb Area -->
  <div class="breadcrumb-area">
      <div class="container">
          <div class="breadcrumb-content">
              <ul>
                  <li><a href="{{ route('home') }}">Home</a></li>
                  <li class="active">Profile</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!-- My Profile Area -->
    <div class="my-profile-area pt-60 pb-60">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
                    @if(Session::has('success'))
                        <div class="alert alert-success">{{ Session::get('success') }}</div>
                    @endif
                    @if(Session::has('error'))
                        <div class="alert alert-danger">{{ Session::get('error') }}</div>
                    @endif
                    @if($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <!-- My Profile Form -->
                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="login-form">
                            <h4 class="login-title">My Profile</h4>
                            <div class="row">
                                <div class="col-md-12 col-12 mb-20">
                                    <label>Name</label>
                                    <input class="mb-0" type="text" name="name" value="{{ auth()->user()->name }}" placeholder="Enter your name" required>
                                </div>
                                <div class="col-md-12 col-12 mb-20">
                                    <label>Email Address</label>
                                    <input class="mb-0" type="email" name="email" value="{{ auth()->user()->email }}" placeholder="Enter your email address" required>
                                </div>
                                <div class="col-md-12 col-12 mb-20">
                                    <label>Phone Number</label>
                                    <input class="mb-0" type="text" name="phone" value="{{ auth()->user()->phone }}" placeholder="Enter your phone number">
                                </div>
                                <div class="col-md-12 col-12 mb-20">
                                    <label>Profile Image</label>
                                    <input class="mb-0" type="file" name="profile_image">
                                </div>
                                <div class="col-md-12">
                                    <button class="register-button mt-0">Update Profile</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- My Profile Area End Here -->
@endsection
