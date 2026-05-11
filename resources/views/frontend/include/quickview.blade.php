            <div class="modal fade modal-wrapper" id="exampleModalCenter">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <div class="modal-inner-area row">
                                <div class="col-lg-5 col-md-6 col-sm-6">
                                    <!-- Product Details Left -->
                                    <div class="product-details-left">
                                        <div class="product-details-images slider-navigation-1">
                                            @if(isset($product) && $product->images->count() > 0)
                                                @foreach($product->images as $image)
                                                    <div class="lg-image">
                                                        <img src="{{ asset($image->path) }}" alt="product image">
                                                    </div>
                                                @endforeach
                                            @else
                                                <div class="lg-image">
                                                    <img src="{{asset('frontend')}}/images/product/large-size/1.jpg" alt="product image">
                                                </div>
                                            @endif
                                        </div>
                                        <div class="product-details-thumbs slider-thumbs-1">
                                            @if(isset($product))
                                                @foreach($product->images as $image)
                                                    <div class="sm-image"><img src="{{ asset($image->path) }}" alt="product image thumb"></div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <!--// Product Details Left -->
                                </div>

                                <div class="col-lg-7 col-md-6 col-sm-6">
                                    <div class="product-details-view-content pt-60">
                                        <div class="product-info">
                                            @if(isset($product))
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
                                                    <span class="new-price new-price-2">${{ number_format($product->price - ($product->price * $product->discount / 100), 2) }}</span>
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
                                                     <form action="{{ route('cart.add') }}" method="POST" class="cart-quantity" id="quickviewAddToCartForm">
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
                                                 </div>
                                                <div class="product-additional-info pt-25">
                                                    <a class="wishlist-btn" href="wishlist.html"><i class="fa fa-heart-o"></i>Add to wishlist</a>
                                                    <div class="product-social-sharing pt-25">
                                                        <ul>
                                                            <li class="facebook"><a href="#"><i class="fa fa-facebook"></i>Facebook</a></li>
                                                            <li class="twitter"><a href="#"><i class="fa fa-twitter"></i>Twitter</a></li>
                                                            <li class="google-plus"><a href="#"><i class="fa fa-google-plus"></i>Google +</a></li>
                                                            <li class="instagram"><a href="#"><i class="fa fa-instagram"></i>Instagram</a></li>
                                                        </ul>
                                                        </div>
                                                    </div>
                                                    @if($product->delivery_policy || $product->return_policy)
                                                    <div class="block-reassurance">
                                                        <ul>
                                                            @if($product->delivery_policy)
                                                            <li>
                                                                <div class="reassurance-item">
                                                                    <div class="reassurance-icon"><i class="fa fa-truck"></i></div>
                                                                    <p><strong>Delivery Policy</strong><br>{{ $product->delivery_policy }}</p>
                                                                </div>
                                                            </li>
                                                            @endif
                                                            @if($product->return_policy)
                                                            <li>
                                                                <div class="reassurance-item">
                                                                    <div class="reassurance-icon"><i class="fa fa-exchange"></i></div>
                                                                    <p><strong>Return Policy</strong><br>{{ $product->return_policy }}</p>
                                                                </div>
                                                            </li>
                                                            @endif
                                                        </ul>
                                                    </div>
                                                    @endif
                                                @endif
            </div>
        </div>
    </div>
</div>
            </div>
        </div>
    </div>
</div>
