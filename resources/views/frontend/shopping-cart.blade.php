@extends('frontend.master')

@section('title', 'Shopping Cart')

@section('maincontent')
             <!-- Begin Li's Breadcrumb Area -->
             <div class="breadcrumb-area">
                 <div class="container">
                     <div class="breadcrumb-content">
                         <ul>
                             <li><a href="{{ route('home') }}">Home</a></li>
                             <li class="active">Shopping Cart</li>
                         </ul>
                     </div>
                 </div>
             </div>
             <!-- Li's Breadcrumb Area End Here -->
             <!--Shopping Cart Area Strat-->
             <div class="Shopping-cart-area pt-60 pb-60">
                 <div class="container">

                     @if( Session :: has( 'success' ))
                     <p class="alert alert-success"> {{ Session :: get( 'success' ) }}</p>
                     @elseif( Session :: has('danger' ))
                     <p class="alert alert-danger"> {{ Session :: get( 'danger' ) }} </p>
                     @endif
                     <form action="{{ route('bulk-update.cart') }}" method="POST">
                         @csrf
                         <div class="row">
                             <div class="col-12">
                                 <div class="table-content table-responsive">
                                         <table class="table">
                                             <thead>
                                                 <tr>
                                                     <th class="li-product-remove">remove</th>
                                                     <th class="li-product-thumbnail">images</th>
                                                     <th class="cart-product-name">Product</th>
                                                     <th class="li-product-price">Unit Price</th>
                                                     <th class="li-product-quantity">Quantity</th>
                                                     <th class="li-product-subtotal">Total</th>
                                                 </tr>
                                             </thead>
                                             <tbody>
                                                  @forelse ($items as $id => $item)
                                                  @php
                                                      $product = $item['product'];
                                                      $price = $item['price'] ?? 0;
                                                      $discount = $product ? ($product->discount ?? 0) : 0;
                                                      $discount_price = $price - ($price / 100 * $discount);
                                                      $itemSubtotal = $discount_price * ($item['quantity'] ?? 0);
                                                  @endphp
                                                 <tr>
                                                     <td class="li-product-remove">
                                                         <a href="{{ route('cart.remove', $id) }}" onclick="event.preventDefault(); document.getElementById('remove-form-{{ $id }}').submit();"><i class="fa fa-times"></i></a>
                                                         <form id="remove-form-{{ $id }}" action="{{ route('cart.remove', $id) }}" method="POST" style="display: none;">
                                                             @csrf
                                                             <input type="hidden" name="product_id" value="{{ $id }}">
                                                         </form>
                                                     </td>
                                                     <td class="li-product-thumbnail">
                                                         <a href="#"><img src="{{ asset($item['image']) }}" alt="{{ $item['name'] }}" style="max-width: 80px;"></a>
                                                     </td>
                                                     <td class="li-product-name"><a href="#">{{ $item['name'] }}</a></td>
                                                     <td class="li-product-price"><span class="amount">${{ number_format($discount_price, 2) }}</span></td>
                                                     <td class="quantity">
    <label>Quantity</label>

    <div class="cart-plus-minus">

        <input
            class="cart-plus-minus-box"
            value="{{ $item['quantity'] ?? 0 }}"
            type="text"
            name="qty[{{ $id }}]"
            data-product-id="{{ $id }}"
        >

        <div class="dec qtybutton"
            onclick="
                var input = document.querySelector('input[name=&quot;qty[{{ $id }}]&quot;]');
                var val = parseInt(input.value);
                if(val > 1){
                    input.value = val - 1;
                }
            ">
            <i class="fa fa-angle-down"></i>
        </div>

        <div class="inc qtybutton"
            onclick="
                var input = document.querySelector('input[name=&quot;qty[{{ $id }}]&quot;]');
                input.value = parseInt(input.value) + 1;
            ">
            <i class="fa fa-angle-up"></i>
        </div>

    </div>
</td>
                                                     <td class="product-subtotal"><span class="amount">${{ number_format($itemSubtotal, 2) }}</span></td>
                                                 </tr>
                                                 @empty
                                                 <tr>
                                                     <td colspan="6" class="text-center">Your cart is empty</td>
                                                 </tr>
                                                 @endforelse
                                             </tbody>
                                         </table>
                                     </div>
                                     <div class="row">
                                         <div class="col-12">
                                             <div class="coupon-all">

                                                 <div class="coupon2">
                                                     <button type="submit" class="button update-cart-btn-main" style="background-color: #000000; color: #fff;">Update cart</button>
                                                 </div>
                                             </div>
                                         </div>
                                     </div>
                                 </form>
                                 <div class="row">
                                     <div class="col-md-5 ml-auto">
                                  <div class="cart-page-total">
                                              <h2>Cart totals</h2>
                                              <ul>
                                                  <li>Subtotal <span>${{ number_format($originalTotal ?? 0, 2) }}</span></li>
                                                  <li>Discount <span>-${{ number_format($discountTotal ?? 0, 2) }}</span></li>
                                                  <li>Total <span>${{ number_format($total ?? 0, 2) }}</span></li>
                                              </ul>
                                          </div>
                                     </div>
                                 </div>
                             </div>
                         </div>
                         <div class="row">
                                <div class="col-12">
                                  <div class="order-button-payment mt-3">
                                      <a href="{{ route('checkout') }}" class="register-button">Place Order</a>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
              </div>
              <!--Shopping Cart Area End-->

@endsection
