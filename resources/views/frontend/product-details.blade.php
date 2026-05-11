@extends('frontend.master')
@section('title', $product->name)
@section('maincontent')
<!-- Header Area End Here -->
<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area">
    <div class="container">
        <div class="breadcrumb-content">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                @if($product->category)
                    <li><a href="#">{{ $product->category->name }}</a></li>
                @endif
                <li class="active">Single Product</li>
            </ul>
        </div>
    </div>
</div>
<!-- Li's Breadcrumb Area End Here -->
<!-- content-wraper start -->
<div class="content-wraper">
    <div class="container">
        <div class="row single-product-area">
            <div class="col-lg-5 col-md-6">
               <!-- Product Details Left -->
                <div class="product-details-left">
                    <div class="product-details-images slider-navigation-1">
                        @if($product->images->count() > 0)
                            @foreach($product->images as $image)
                                <div class="lg-image">
                                    <a class="popup-img venobox vbox-item" href="{{ asset($image->path) }}" data-gall="myGallery">
                                        <img src="{{ asset($image->path) }}" alt="product image">
                                    </a>
                                </div>
                            @endforeach
                        @else
                            <div class="lg-image">
                                <a class="popup-img venobox vbox-item" href="{{asset('frontend')}}/images/product/large-size/1.jpg" data-gall="myGallery">
                                    <img src="{{asset('frontend')}}/images/product/large-size/1.jpg" alt="product image">
                                </a>
                            </div>
                        @endif
                    </div>
                    <div class="product-details-thumbs slider-thumbs-1">
                        @if($product->images->count() > 0)
                            @foreach($product->images as $image)
                                <div class="sm-image">
                                    <img src="{{ asset($image->path) }}" alt="product image thumb">
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <!--// Product Details Left -->
            </div>

            <div class="col-lg-7 col-md-6">
                <div class="product-details-view-content pt-60">
                    <div class="product-info">
                        <h2>{{ $product->name }}</h2>
                        <span class="product-details-ref">Reference: {{ $product->id }}</span>
                        <div class="rating-box pt-20">
                            <ul class="rating rating-with-review-item">
                                @for($i=0; $i<5; $i++)
                                    <li><i class="fa fa-star{{ $i < 2 ? '-o' : '' }}"></i></li>
                                @endfor
                                <li class="review-item"><a href="#">Read Review</a></li>
                                <li class="review-item"><a href="#">Write Review</a></li>
                            </ul>
                        </div>
                        <div class="price-box pt-20">
                            @php
                                $discountPrice = $product->price - ($product->price * $product->discount / 100);
                            @endphp
                            <span class="new-price new-price-2">${{ number_format($discountPrice, 2) }}</span>
                            @if($product->discount > 0)
                                <del><small>${{ number_format($product->price, 2) }}</small></del>
                            @endif
                        </div>
                        <div class="product-desc">
                            <p><span>{{ $product->short_description }}</span></p>
                        </div>
                        <div class="product-variants">
                            <div class="produt-variants-size">
                                <label>Dimension</label>
                                <select class="nice-select">
                                    <option value="1" title="S" selected="selected">40x60cm</option>
                                    <option value="2" title="M">60x90cm</option>
                                    <option value="3" title="L">80x120cm</option>
                                </select>
                            </div>
                        </div>
<div class="single-add-to-cart">
                            @auth
                            <form action="{{ route('product.add.to.cart') }}" method="POST" class="cart-quantity">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div class="quantity">
                                    <label>Quantity</label>
                                    <div class="cart-plus-minus">
                                        <input class="cart-plus-minus-box" name="quantity" value="1" type="text">
                                        <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>
                                        <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>
                                    </div>
                                </div>
                                <button class="add-to-cart" type="submit">Add to cart</button>
                            </form>
                            @else
                            <a href="{{ route('user.login') }}" class="add-to-cart" style="display:block;text-align:center;padding:12px;background:#ddd;color:#666;">Login to Add to Cart</a>
                            @endauth
                        </div>
<div class="product-additional-info pt-25">
                                                         @auth
                                                         <a class="wishlist-btn add-to-wishlist-link" href="{{ route('wishlist.add') }}" data-product-id="{{ $product->id }}"><i class="fa fa-heart-o"></i>Add to wishlist</a>
                                                         @else
                                                         <a class="wishlist-btn add-to-wishlist-link" href="{{ route('user.login') }}" style="color:#999;"><i class="fa fa-heart-o"></i>Login to Add to Wishlist</a>
                                                         @endauth
                                                         <div class="product-social-sharing pt-25">
                                <ul>
                                    <li class="facebook"><a href="#"><i class="fa fa-facebook"></i>Facebook</a></li>
                                    <li class="twitter"><a href="#"><i class="fa fa-twitter"></i>Twitter</a></li>
                                    <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i>Google +</a></li>
                                    <li class="instagram"><a href="#"><i class="fa fa-instagram"></i>Instagram</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="block-reassurance">
                            <ul>
                                <li>
                                    <div class="reassurance-item">
                                        <div class="reassurance-icon">
                                            <i class="fa fa-check-square-o"></i>
                                        </div>
                                        <p>Security policy (edit with Customer reassurance module)</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="reassurance-item">
                                        <div class="reassurance-icon">
                                            <i class="fa fa-truck"></i>
                                        </div>
                                        <p>Delivery policy (edit with Customer reassurance module)</p>
                                    </div>
                                </li>
                                <li>
                                    <div class="reassurance-item">
                                        <div class="reassurance-icon">
                                            <i class="fa fa-exchange"></i>
                                        </div>
                                        <p>Return policy (edit with Customer reassurance module)</p>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- content-wraper end -->
<!-- Begin Product Area -->
<div class="product-area pt-35">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="li-product-tab">
                    <ul class="nav li-product-menu">
                        <li><a class="active" data-toggle="tab" href="#description"><span>Description</span></a></li>
                        <li><a data-toggle="tab" href="#product-details"><span>Product Details</span></a></li>
                        <li><a data-toggle="tab" href="#reviews"><span>Reviews</span></a></li>
                    </ul>
                </div>
                <!-- Begin Li's Tab Menu Content Area -->
            </div>
        </div>
        <div class="tab-content">
            <div id="description" class="tab-pane active show" role="tabpanel">
                <div class="product-description">
                    <span>{{ $product->description ?: 'No description available for this product.' }}</span>
                </div>
            </div>
            <div id="product-details" class="tab-pane" role="tabpanel">
                <div class="product-details-manufacturer">
                    <a href="#">
                        @if($product->images->count() > 0)
                            <img src="{{ asset($product->images->first()->path) }}" alt="Product Manufacturer Image">
                        @endif
                    </a>
                    <p><span>Reference</span> {{ $product->id }}</p>
                    <p><span>Category</span> {{ $product->category->name ?? 'N/A' }}</p>
                </div>
            </div>
            <div id="reviews" class="tab-pane" role="tabpanel">
                <div class="product-reviews">
                    <div class="product-details-comment-block">
                        <div class="comment-review">
                            <span>Grade</span>
                            <ul class="rating">
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li><i class="fa fa-star-o"></i></li>
                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                                <li class="no-star"><i class="fa fa-star-o"></i></li>
                            </ul>
                        </div>
                        <div class="comment-author-infos pt-25">
                            <span>Review</span>
                            <em>Now</em>
                        </div>
                        <div class="comment-details">
                            <h4 class="title-block">Customer</h4>
                            <p>Be the first to review this product!</p>
                        </div>
                        <div class="review-btn">
                            <a class="review-links" href="#" data-toggle="modal" data-target="#mymodal">Write Your Review!</a>
                        </div>
                        <!-- Begin Quick View | Modal Area -->
                        <div class="modal fade modal-wrapper" id="mymodal" >
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <h3 class="review-page-title">Write Your Review</h3>
                                        <div class="modal-inner-area row">
                                            <div class="col-lg-6">
                                                <div class="li-review-product">
                                                    @if($product->images->count() > 0)
                                                        <img src="{{ asset($product->images->first()->path) }}" alt="Li's Product">
                                                    @endif
                                                    <div class="li-review-product-desc">
                                                        <p class="li-product-name">{{ $product->name }}</p>
                                                        <p><span>{{ $product->short_description }}</span></p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="li-review-content">
                                                    <!-- Begin Feedback Area -->
                                                    <div class="feedback-area">
                                                        <div class="feedback">
                                                            <h3 class="feedback-title">Our Feedback</h3>
                                                            <form action="#">
                                                                <p class="your-opinion">
                                                                    <label>Your Rating</label>
                                                                    <span>
                                                                        <select class="star-rating">
                                                                          <option value="1">1</option>
                                                                          <option value="2">2</option>
                                                                          <option value="3">3</option>
                                                                          <option value="4">4</option>
                                                                          <option value="5">5</option>
                                                                        </select>
                                                                    </span>
                                                                </p>
                                                                <p class="feedback-form">
                                                                    <label for="feedback">Your Review</label>
                                                                    <textarea id="feedback" name="comment" cols="45" rows="8" aria-required="true"></textarea>
                                                                </p>
                                                                <div class="feedback-input">
                                                                    <p class="feedback-form-author">
                                                                        <label for="author">Name<span class="required">*</span></label>
                                                                        <input id="author" name="author" value="" size="30" aria-required="true" type="text">
                                                                    </p>
                                                                    <p class="feedback-form-author feedback-form-email">
                                                                        <label for="email">Email<span class="required">*</span></label>
                                                                        <input id="email" name="email" value="" size="30" aria-required="true" type="text">
                                                                        <span class="required"><sub>*</sub> Required fields</span>
                                                                    </p>
                                                                    <div class="feedback-btn pb-15">
                                                                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">Close</a>
                                                                        <a href="#">Submit</a>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <!-- Feedback Area End Here -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
        </div>
    </div>
</div>
<!-- Policy Area End Here -->

@endsection
