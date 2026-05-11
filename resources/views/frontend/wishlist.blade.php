@extends('frontend.master')

@section('title', 'Wishlist')

@section('maincontent')
<!-- Wishlist Area Start -->
<div class="wishlist-area pt-60 pb-60">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-content table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="li-product-remove">remove</th>
                                <th class="li-product-thumbnail">images</th>
                                <th class="cart-product-name">Product Name</th>
                                <th class="li-product-price">Price</th>
                                <th class="li-product-stock-status">Stock Status</th>
                                <th class="li-product-add-cart">add to cart</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php $wishlistItems = isset($wishlistItems) ? $wishlistItems : []; @endphp
                            @if(count($wishlistItems) > 0)
                                @foreach($wishlistItems as $item)
                                    <tr>
                                        <td class="li-product-remove">
                                            <form action="{{ route('wishlist.remove') }}" method="POST" class="remove-from-wishlist-form">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                                <button type="submit" style="background:none; border:none; cursor:pointer;">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                            </form>
                                        </td>
                                        <td class="li-product-thumbnail">
                                            <a href="{{ route('product.details', $item['id']) }}">
                                                <img src="{{ $item['image'] ? asset($item['image']) : asset('frontend/images/product/default.jpg') }}" alt="" style="width: 80px;">
                                            </a>
                                        </td>
                                        <td class="li-product-name">
                                            <a href="{{ route('product.details', $item['id']) }}">{{ $item['name'] }}</a>
                                        </td>
                                        <td class="li-product-price">
                                            <span class="amount">${{ number_format($item['price'], 2) }}</span>
                                        </td>
                                        <td class="li-product-stock-status">
                                            <span class="in-stock">In Stock</span>
                                        </td>
                                        <td class="li-product-add-cart">
                                            <form action="{{ route('cart.add') }}" method="POST" class="wishlist-add-to-cart-form" style="display:inline;">
                                                @csrf
                                                <input type="hidden" name="product_id" value="{{ $item['id'] }}">
                                                <button type="submit" style="background:none; border:none; cursor:pointer; color:#ea1b1b; background-color:#438bbf; padding:5px 10px; border:1px solid #ccc;">Add to Cart</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            @else
                                <tr>
                                    <td colspan="6" style="text-align: center; padding: 30px;">Your wishlist is empty</td>
                                </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Wishlist Area End -->
@endsection