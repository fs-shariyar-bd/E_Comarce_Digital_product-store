@extends('frontend.master')
@section('title', 'Home')
@section('maincontent')
     <!-- Begin Slider With Banner Area -->
            <div class="slider-with-banner">
                <div class="container">
                    <div class="row">
                        <!-- Begin Slider Area -->
                        <div class="col-lg-8 col-md-8">
                            <div class="slider-area">
                                <div class="slider-active owl-carousel">
                                    @foreach($sliderBanners as $banner)
                                    <div class="single-slide align-center-left animation-style-01" @if($banner->image) style="background-image: url('{{ asset($banner->image) }}'); background-size: cover; background-position: center; height: 468px;" @endif>
                                        <div class="slider-progress"></div>
                                        @if($banner->link)
                                        <div class="slider-content">
                                            <div class="default-btn slide-btn">
                                                <a class="links" href="{{ $banner->link }}">Shop Now</a>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <!-- Slider Area End Here -->
                        <!-- Begin Li Banner Area -->
                        <div class="col-lg-4 col-md-4 text-center pt-xs-30">
                            @foreach($sideBanners as $banner)
                            <div class="li-banner @if(!$loop->first) mt-15 mt-sm-30 mt-xs-30 @endif">
                                @if($banner->link)
                                <a href="{{ $banner->link }}">
                                    @endif
                                    <img src="{{ asset($banner->image) }}" alt="Banner Image" style="width: 100%; height: 100%; object-fit: contain;">
                                    @if($banner->link)
                                </a>
                                @endif
                            </div>
                            @endforeach
                        </div>
                        <!-- Li Banner Area End Here -->
                    </div>
                </div>
            </div>
            <!-- Slider With Banner Area End Here -->
            <!-- Begin Product Area -->

            <section class="product-area li-laptop-product pt-60 pb-45">
                <div class="container">
                    <div class="row">
                        <!-- Begin Li's Section Area -->
                        <div class="col-lg-12">
                          @foreach ($categories as $category)
                          @if ($category->products->count() > 0)


                            <hr>
                            <div class="li-section-title">
                                <h2>
                                    <span>{{ $category->name }}</span>
                                </h2>


                            </div>

                    <div class="row no-gutters">
                                <div class="product-active owl-carousel">
                                    @foreach ($category->products as $product)

                                    <div class="col-lg-12">
                                        <!-- single-product-wrap start -->
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                <a href="{{ route('product.details', $product->id) }}">


                                                    <img src="@if($product->firstimage){{asset($product->firstimage->path)}}@else{{asset('frontend')}}/images/product/default.jpg @endif" alt="Li's Product Image">

                                                </a>

                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                  <h4><a class="product_name" href="{{ route('product.details', $product->id) }}">{{ $product->name }}</a></h4>
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                            <a href="{{ route('product.details', $product->id) }}">{{ $product->short_description }}</a>
                                                        </h5>

                                                        <div class="rating-box">
                                                            <ul class="rating">
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                            </ul>
                                                        </div>
                                                  <div class="price-box">
                                                            @php
                                                             $discount_price = $product->price - ($product->price / 100 * $product->discount);
                                                                @endphp
                                                                    <del><small>${{ number_format($product->price, 2) }}</small></del>
                                                        <span class="new-price">${{ $discount_price }}</span>
                                                    </div>
                                                </div>
                                                    </div>

<div class="add-actions">
                                                      <ul class="add-actions-link">
                                                          <li class="add-cart active">
                                                              <a href="{{ route('cart.add') }}" data-product-id="{{ $product->id }}" class="add-to-cart-link" title="Add to Cart">
                                                                  <i class="fa fa-shopping-cart"></i>Add to cart
                                                              </a>
                                                          </li>
                                                          <li>
                                                              <a href="{{ route('wishlist.add') }}" data-product-id="{{ $product->id }}" class="add-to-wishlist-link" title="Wishlist">
                                                                  <i class="fa fa-heart-o"></i>
                                                              </a>
                                                          </li>
                                                          <li>
                                                              <a href="{{ route('include.quick.view', $product->id) }}" class="quick-view-btn" data-id="{{ $product->id }}" title="quick view">
                                                                  <i class="fa fa-eye"></i>
                                                              </a>
                                                          </li>
                                                      </ul>
                                                  </div>
                                            </div>
                                        </div>
                                        <!-- single-product-wrap end -->
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                        <!-- Li's Section Area End Here -->
                    </div>
                </div>
            </section>
            <!-- Li's Laptop Product Area End Here -->

@endsection

