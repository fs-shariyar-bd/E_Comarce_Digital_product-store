@extends('frontend.master')

@section('title')
    Login Register
@endsection

@section('maincontent')
  <!-- Begin Li's Breadcrumb Area -->
  <div class="breadcrumb-area">
      <div class="container">
          <div class="breadcrumb-content">
              <ul>
                  <li><a href="{{ route('home') }}">Home</a></li>
                  <li class="active">Login Register</li>
              </ul>
          </div>
      </div>
  </div>
  <!-- Li's Breadcrumb Area End Here -->
  <!-- Begin Login Content Area -->
  <div class="page-section mb-60">
      <div class="container">
          <div class="row">
              <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
                  @if(request()->has('redirect') && request()->redirect === 'cart')
                      <div class="alert alert-info">Please login to add product to cart</div>
                  @endif
                  @if(request()->has('redirect') && request()->redirect === 'wishlist')
                      <div class="alert alert-info">Please login to add product to wishlist</div>
                  @endif
@if(Session::has('login_message'))
                       <div class="alert alert-warning mt-20">
                           {{ Session::get('login_message') }}
                       </div>
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
                  @if(Session::has('success'))
                      <div class="alert alert-success">{{ Session::get('success') }}</div>
                  @endif
                  <!-- Login Form s-->
                  <form action="{{ route('frontend.login') }}" method="POST">
                      @csrf
                      @if(request()->has('redirect'))
                          <input type="hidden" name="redirect" value="{{ request()->redirect }}">
                          <input type="hidden" name="product_id" value="{{ request()->product_id }}">
                          @if(request()->has('qty'))
                              <input type="hidden" name="qty" value="{{ request()->qty }}">
                          @endif
                      @endif
                      <div class="login-form">
                          <h4 class="login-title">Login</h4>
                          <div class="row">
                              <div class="col-md-12 col-12 mb-20">
                                  <label>Email Address*</label>
                                  <input class="mb-0" type="email" name="email" value="{{ old('email') }}" placeholder="Email Address">
                                  @error('email')
                                      <div class="text-danger mt-1" style="font-size:13px;">{{ $message }}</div>
                                  @enderror
                              </div>
                              <div class="col-12 mb-20">
                                  <label>Password</label>
                                  <input class="mb-0" type="password" name="password" placeholder="Password">
                                  @error('password')
                                      <div class="text-danger mt-1" style="font-size:13px;">{{ $message }}</div>
                                  @enderror
                              </div>
                              <div class="col-md-8">
                                  <div class="check-box d-inline-block ml-0 ml-md-2 mt-10">
                                      <input type="checkbox" name="remember_me" id="remember_me">
                                      <label for="remember_me">Remember me</label>
                                  </div>
                              </div>
                              <div class="col-md-4 mt-10 mb-20 text-left text-md-right">
                                  <a href="{{ route('frontend.forgot.password') }}"> Forgot password?</a>
                              </div>
                              <div class="col-md-12">
                                  <button class="register-button mt-0">Login</button>
                              </div>
                          </div>
                      </div>
                  </form>
                  <div class="mt-20">
                      <p>Don't have an account? <a href="#" data-toggle="collapse" data-target="#registerForm">Register here</a></p>
                  </div>
              </div>
              <div class="col-sm-12 col-md-12 col-lg-6 col-xs-12">
                  <div id="registerForm" class="collapse">
                      <form action="{{ route('frontend.register') }}" method="POST">
                          @csrf
                          @if(request()->has('redirect'))
                              <input type="hidden" name="redirect" value="{{ request()->redirect }}">
                              <input type="hidden" name="product_id" value="{{ request()->product_id }}">
                              @if(request()->has('qty'))
                                  <input type="hidden" name="qty" value="{{ request()->qty }}">
                              @endif
                          @endif
                          <div class="login-form">
                              <h4 class="login-title">Register</h4>
                              <div class="row">
                                  <div class="col-md-6 col-12 mb-20">
                                      <label>First Name</label>
                                      <input class="mb-0" type="text" name="first_name" value="{{ old('first_name') }}" placeholder="First Name">
                                      @error('first_name')
                                          <div class="text-danger mt-1" style="font-size:13px;">{{ $message }}</div>
                                      @enderror
                                  </div>
                                  <div class="col-md-6 col-12 mb-20">
                                      <label>Last Name</label>
                                      <input class="mb-0" type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Last Name">
                                      @error('last_name')
                                          <div class="text-danger mt-1" style="font-size:13px;">{{ $message }}</div>
                                      @enderror
                                  </div>
                                  <div class="col-md-12 mb-20">
                                      <label>Phone Number</label>
                                      <input class="mb-0" type="tel" name="mobile" value="{{ old('mobile') }}" placeholder="Phone Number">
                                      @error('mobile')
                                          <div class="text-danger mt-1" style="font-size:13px;">{{ $message }}</div>
                                      @enderror
                                  </div>
                                  <div class="col-md-12 mb-20">
                                      <label>Email Address*</label>
                                      <input class="mb-0" type="email" name="email" value="{{ old('email') }}" placeholder="Email Address">
                                      @error('email')
                                          <div class="text-danger mt-1" style="font-size:13px;">{{ $message }}</div>
                                      @enderror
                                  </div>
                                  <div class="col-md-6 mb-20">
                                      <label>Password</label>
                                      <input class="mb-0" type="password" name="password" placeholder="Password">
                                      @error('password')
                                          <div class="text-danger mt-1" style="font-size:13px;">{{ $message }}</div>
                                      @enderror
                                  </div>
                                  <div class="col-md-6 mb-20">
                                      <label>Confirm Password</label>
                                      <input class="mb-0" type="password" name="password_confirmation" placeholder="Confirm Password">
                                      @error('password_confirmation')
                                          <div class="text-danger mt-1" style="font-size:13px;">{{ $message }}</div>
                                      @enderror
                                  </div>
                                  <div class="col-12">
                                      <button class="register-button mt-0">Register</button>
                                  </div>
                              </div>
                          </div>
                      </form>
                  </div>
              </div>
          </div>
      </div>
  </div>

@endsection
