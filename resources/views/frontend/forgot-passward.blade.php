@extends('frontend.master')
@section('title', 'Forgot Password')
@section('maincontent')
  <!-- Begin Li's Breadcrumb Area -->
  <div class="breadcrumb-area">
      <div class="container">
          <div class="breadcrumb-content">
              <ul>
                  <li><a href="{{ route('home') }}">Home</a></li>
                  <li class="active">Forgot Password</li>
              </ul>
          </div>
      </div>
  </div>
  <!-- Li's Breadcrumb Area End Here -->
  <!-- Begin Forgot Password Content Area -->
  <div class="page-section mb-60">
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
                  <!-- Forgot Password Form -->
                  <form action="{{ route('password.email') }}" method="POST">
                      @csrf
                      <div class="login-form">
                          <h4 class="login-title">Forgot Password</h4>
                          <div class="row">
                              <div class="col-md-12 col-12 mb-20">
                                  <label>Email Address*</label>
                                  <input class="mb-0" type="email" name="email" placeholder="Enter your email address" required>
                              </div>
                              <div class="col-md-12 col-12 mb-20">
                                  <button type="submit" class="register-button mt-0">Send Password Reset Link</button>
                              </div>
                          </div>
                      </div>
                  </form>
              </div>
          </div>
      </div>
  </div>
  <!-- Forgot Password Content Area End Here -->
@endsection
