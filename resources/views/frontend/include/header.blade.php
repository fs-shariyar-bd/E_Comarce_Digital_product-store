            <header>
                <!-- Begin Header Top Area -->
                <div class="header-top">
                    <div class="container">
                        <div class="row">
                            <!-- Begin Header Top Left Area -->
                            <div class="col-lg-3 col-md-4">
                                <div class="header-top-left">
                                    <ul class="phone-wrap">
                                        <li><span>Telephone Enquiry:</span><a href="#">(+123) 123 321 345</a></li>
                                    </ul>
                                </div>
                            </div>
                            <!-- Header Top Left Area End Here -->
                            <!-- Begin Header Top Right Area -->
                            <div class="col-lg-9 col-md-8">
                                <div class="header-top-right">
                                    <ul class="ht-menu">
                                        <!-- Begin Setting Area -->
                                        <li>
                                            <div class="ht-setting-trigger"><span>Setting</span></div>
                                            <div class="setting ht-setting">
      <ul class="ht-setting-list">
                                                    @auth
                                                        <li><a href="#">My Account</a></li>
                                                          <li><a href="{{ route('myorders') }}">My Orders</a></li>

                                                        <li>
                                                            <form action="{{ route('frontend.logout') }}" method="POST">
                                                                @csrf
                                                                <button type="submit" style="background:none;border:none;cursor:pointer;">Logout</button>
                                                            </form>
                                                        </li>
                                                    @else
                                                        <li><a href="{{ route('user.login') }}">Login</a></li>
                                                        <li><a href="{{ route('user.login') }}">Register</a></li>
                                                    @endauth
                                                </ul>
                                            </div>
                                        </li>
                                        <!-- Setting Area End Here -->
                                        <!-- Begin Currency Area -->
                                        <li>
                                            <span class="currency-selector-wrapper">Currency :</span>
                                            <div class="ht-currency-trigger"><span>USD $</span></div>
                                            <div class="currency ht-currency">
                                                <ul class="ht-setting-list">
                                                    <li><a href="#">EUR €</a></li>
                                                    <li class="active"><a href="#">USD $</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <!-- Currency Area End Here -->
                                        <!-- Begin Language Area -->
                                        <li>
                                            <span class="language-selector-wrapper">Language :</span>
                                            <div class="ht-language-trigger"><span>English</span></div>
                                            <div class="language ht-language">
                                                <ul class="ht-setting-list">
                                                    <li class="active"><a href="#"><img src="images/menu/flag-icon/1.jpg" alt="">English</a></li>
                                                    <li><a href="#"><img src="images/menu/flag-icon/2.jpg" alt="">Français</a></li>
                                                </ul>
                                            </div>
                                        </li>
                                        <!-- Language Area End Here -->
                                    </ul>
                                </div>
                            </div>
                            <!-- Header Top Right Area End Here -->
                        </div>
                    </div>
                </div>
                <!-- Header Top Area End Here -->
                <!-- Begin Header Middle Area -->
                <div class="header-middle pl-sm-0 pr-sm-0 pl-xs-0 pr-xs-0">
                    <div class="container">
                        <div class="row">
                            <!-- Begin Header Logo Area -->
                            <div class="col-lg-3">
                                <div class="logo pb-sm-30 pb-xs-30">
                                    <a href="{{ route('home') }}">
                                        <img src="{{asset('frontend')}}/images/menu/logo/1.jpg" alt="">
                                    </a>
                                </div>
                            </div>
                            <!-- Header Logo Area End Here -->
                            <!-- Begin Header Middle Right Area -->
                            <div class="col-lg-9 pl-0 ml-sm-15 ml-xs-15">
                                <!-- Begin Header Middle Searchbox Area -->
                                <form action="#" class="hm-searchbox">
                                    <select class="nice-select select-search-category">
                                        <option value="0">All</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @if($category->subcategories->count() > 0)
                                                @foreach($category->subcategories as $subcategory)
                                                    <option value="{{ $subcategory->id }}">- - {{ $subcategory->name }}</option>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                    <input type="text" placeholder="Enter your search key ...">
                                    <button class="li-btn" type="submit"><i class="fa fa-search"></i></button>
                                </form>
                                <!-- Header Middle Searchbox Area End Here -->
<!-- Begin Header Middle Right Area -->
                                <div class="header-middle-right">
                                    <ul class="hm-menu">
                                        <!-- Begin Header Middle Wishlist Area -->
                                        <li class="hm-wishlist">
                                            @auth
                                            <a href="{{ route('wishlist.index') }}">
                                                <i class="fa fa-heart-o"></i>
                                                <span class="wishlist-item-count" id="wishlist-count">{{ isset($wishlistCount) ? $wishlistCount : 0 }}</span>
                                            </a>
                                            @else
                                            <a href="{{ route('user.login') }}" title="Please login to access wishlist">
                                                <i class="fa fa-heart-o"></i>
                                                <span class="wishlist-item-count" id="wishlist-count">{{ isset($wishlistCount) ? $wishlistCount : 0 }}</span>
                                            </a>
                                            @endauth
                                        </li>
                                        <!-- Header Middle Wishlist Area End Here -->
                                        <!-- Begin Header Mini Cart Area -->
                                        <li class="hm-minicart">
                                            <div class="hm-minicart-trigger">
                                                <span class="item-icon"> </span>
                                                <span class="cart-item-count" id="cart-count">{{ isset($count) ? $count : 0 }}</span>
                                            </div>
                                            <span>

                                            </span>
                                            <div class="minicart">
                                                <ul class="minicart-product-list">
                                                    @if(isset($minicartItems) && count($minicartItems) > 0)
                                                        @foreach($minicartItems as $item)
                                                            <li>
                                                                <a href="{{ route('product.details', $item['id']) }}" class="minicart-product-image">
                                                                    <img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}">
                                                                </a>
                                                                <div class="minicart-product-details">
                                                                    <h6><a href="{{ route('product.details', $item['id']) }}">{{ $item['name'] }}</a></h6>
                                                                    <span>${{ number_format($item['price'], 2) }} x {{ $item['quantity'] }}</span>
                                                                </div>
<form action="{{ route('cart.remove', $item['id']) }}" method="POST" style="display:inline;" class="mini-cart-remove-form">
                                                                      @csrf
                                                                      <button class="close" title="Remove" type="submit">
                                                                          <i class="fa fa-close"></i>
                                                                      </button>
                                                                  </form>
                                                            </li>
                                                        @endforeach
                                                    @else
                                                        <li>
                                                            <div class="minicart-product-details">
                                                                <h6><a href="#">Your cart is empty</a></h6>
                                                            </div>
                                                        </li>
                                                    @endif
                                                </ul>
                                                <p class="minicart-total">SUBTOTAL: <span id="minicart-subtotal">${{ number_format($subtotal ?? 0, 2) }}</span></p>
                                                <div class="minicart-button">
                                                @auth
                                                    <a href="{{ route('shopping.cart') }}" class="li-button li-button-fullwidth li-button-dark">
                                                        <span>View Full Cart</span>
                                                    </a>
                                                    <a href="{{ route('checkout') }}" class="li-button li-button-fullwidth">
                                                        <span>Checkout</span>
                                                    </a>
                                                @else
                                                    <a href="{{ route('user.login') }}" class="li-button li-button-fullwidth li-button-dark">
                                                        <span>Login to Cart</span>
                                                    </a>
                                                @endauth
                                            </div>
                                            </div>
                                        </li>
                                        <!-- Header Mini Cart Area End Here -->
                                    </ul>
                                </div>
                                <!-- Header Middle Right Area End Here -->
                            </div>
                            <!-- Header Middle Right Area End Here -->
                        </div>
                    </div>
                </div>
                <!-- Header Middle Area End Here -->
                <!-- Begin Header Bottom Area -->
                <div class="header-bottom header-sticky d-none d-lg-block d-xl-block">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <!-- Begin Header Bottom Menu Area -->
                                <div class="hb-menu">
<nav>
                                            <ul>
                                                <li><a href="{{ route('home') }}">Home</a>
                                                </li>

                                                @foreach ($categories as $category)
                                                    <li class="{{$category->subcategories_count > 0 ? 'dropdown' : ''}}"><a href="#">{{$category->name}}</a>
                                                        @if ($category->subcategories_count > 0)
                                                            <ul class="hb-dropdown">
                                                                @foreach ($category->subcategories as $subcategory)
                                                                    <li><a href="#">{{ $subcategory->name }}</a></li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </li>
                                                @endforeach

                                                <li><a href="about-us.html">About Us</a></li>
                                                <li><a href="contact.html">Contact</a></li>

                                            </ul>
                                        </nav>
                                </div>
                                <!-- Header Bottom Menu Area End Here -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Header Bottom Area End Here -->
                <!-- Begin Mobile Menu Area -->
                <div class="mobile-menu-area d-lg-none d-xl-none col-12">
                    <div class="container">
                        <div class="row">
                            <div class="mobile-menu">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Mobile Menu Area End Here -->
            </header>
