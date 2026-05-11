@extends('frontend.master')

@section('title', 'Checkout')

@section('maincontent')
             <!-- Begin Li's Breadcrumb Area -->
             <div class="breadcrumb-area">
                 <div class="container">
                     <div class="breadcrumb-content">
                         <ul>
                             <li><a href="{{ route('home') }}">Home</a></li>
                             <li class="active">Checkout</li>
                         </ul>
                     </div>
                 </div>
             </div>
             <!-- Li's Breadcrumb Area End Here -->
             <style>
             .hide { display: none; }
              .has-error input { border-color: #a94442; }
             .has-error .help-block { color: #a94442; }
              </style>
                 <!--Checkout Area Strat-->
             <div class="checkout-area pt-60 pb-30">
                 <div class="container">
                     @if( Session :: has( 'success' ))
                     <p class="alert alert-success"> {{ Session :: get( 'success' ) }}</p>
                     @elseif( Session :: has('error') )
                     <p class="alert alert-danger"> {{ Session :: get( 'error' ) }} </p>
                     @endif
                     <form id="checkout-form" action="{{ route('order.store') }}" method="POST" class="require-validation" data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}">
                         @csrf
                         <div class="row">
                             <div class="col-lg-6 col-12">
                                 <div class="checkbox-form">
                                     <h3>Billing Details</h3>
                                     <div class="row">
                                         <div class="col-md-12">
                                             <div class="country-select clearfix">
                                                 <label>Country <span class="required">*</span></label>
                                                 <select class="nice-select wide" name="country">
                                                   <option data-display="Bangladesh" value="Bangladesh">Bangladesh</option>
                                                   <option value="uk">London</option>
                                                   <option value="rou">Romania</option>
                                                   <option value="fr">French</option>
                                                   <option value="de">Germany</option>
                                                   <option value="aus">Australia</option>
                                                 </select>
                                             </div>
                                         </div>
                                         <div class="col-md-12">
                                                  <div class="checkout-form-list">
                                                  <label>Name <span class="required">*</span></label>
                                                  <input placeholder="" class="required" type="text" name="name" value="{{ old('name') }}">
                                              </div>
                                         </div>
                                         <div class="col-md-12">
                                             <div class="checkout-form-list">
                                                 <label>Company Name</label>
                                                 <input placeholder="" type="text" name="company_name">
                                             </div>
                                         </div>

                                          <div class="col-md-12">
                                              <div class="checkout-form-list">
                                                  <label>Address <span class="required">*</span></label>
                                                  <input placeholder="Street address" class="required" type="text" name="address" value="{{ old('address') }}">
                                              </div>
                                          </div>
                                         <div class="col-md-12">
                                             <div class="checkout-form-list">
                                                 <input placeholder="Apartment, suite, unit etc. (optional)" type="text" name="address2">
                                             </div>
                                         </div>
                                          <div class="col-md-12">
                                              <div class="checkout-form-list">
                                                  <label>Town / City <span class="required">*</span></label>
                                                  <input type="text" class="required" name="city" value="{{ old('city') }}">
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="checkout-form-list">
                                                  <label>State / County <span class="required">*</span></label>
                                                  <input placeholder="" class="required" type="text" name="state" value="{{ old('state') }}">
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="checkout-form-list">
                                                  <label>Postcode / Zip <span class="required">*</span></label>
                                                  <input placeholder="" class="required" type="text" name="postcode" value="{{ old('postcode') }}">
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="checkout-form-list">
                                                  <label>Email Address <span class="required">*</span></label>
                                                  <input placeholder="" class="required" type="email" name="email" value="{{ old('email') }}">
                                              </div>
                                          </div>
                                          <div class="col-md-6">
                                              <div class="checkout-form-list">
                                                  <label>Phone  <span class="required">*</span></label>
                                                  <input type="text" class="required" name="phone" value="{{ old('phone') }}">
                                              </div>
                                          </div>
                                     </div>
                                 </div>
                             </div>
                             <div class="col-lg-6 col-12">
                                 <div class="your-order">
                                     <h3>Your order</h3>
 <div class="your-order-table table-responsive">
                                          <table class="table">
                                              <thead>
                                                  <tr>
                                                      <th class="cart-product-name">Product</th>
                                                      <th class="cart-product-total">Original Price</th>
                                                      <th class="cart-product-total">Discount</th>
                                                      <th class="cart-product-total">Final Price</th>
                                                      <th class="cart-product-total">Quantity</th>
                                                      <th class="cart-product-total">Total</th>
                                                  </tr>
                                              </thead>
                                               <tbody>
                                                   @forelse($minicartItems as $id => $item)
                                                   @php
                                                       $product = $item['product'];
                                                       $price = $product->price;
                                                       $discount = $product->discount ?? 0;
                                                       $discount_price = $price - ($price / 100 * $discount);
                                                       $itemSubtotal = $discount_price * $item['quantity'];
                                                   @endphp
                                                   <tr class="cart_item">
                                                       <td class="cart-product-name">{{ $item['name'] }}</td>
                                                       <td class="cart-product-total"><span class="amount">${{ number_format($price, 2) }}</span></td>
                                                       <td class="cart-product-total"><span class="amount">{{ $discount }}%</span></td>
                                                       <td class="cart-product-total"><span class="amount">${{ number_format($discount_price, 2) }}</span></td>
                                                       <td class="cart-product-total"><span class="amount">{{ $item['quantity'] }}</span></td>
                                                       <td class="cart-product-total"><span class="amount">${{ number_format($itemSubtotal, 2) }}</span></td>
                                                   </tr>
                                                   @empty
                                                   <tr>
                                                      <td colspan="6" class="text-center">Your cart is empty</td>
                                                   </tr>
                                                   @endforelse
                                               </tbody>
                                               <tfoot>
                                                 @php
                                                     $totalAmount = 0;
                                                     foreach($minicartItems as $id => $item) {
                                                         $product = $item['product'];
                                                         $price = $product->price;
                                                         $discount = $product->discount ?? 0;
                                                         $discount_price = $price - ($price / 100 * $discount);
                                                         $totalAmount += $discount_price * $item['quantity'];
                                                     }
                                                 @endphp
                                                  <tr class="cart-subtotal">
                                                      <th>Total Price</th>
                                                      <td colspan="5"><span class="amount">${{ number_format($totalAmount, 2) }}</span></td>
                                                  </tr>
                                                  <tr class="cart-subtotal">
                                                      <th>Discount Amount</th>
                                                      <td colspan="5"><span class="amount">- ${{ number_format($subtotal - $totalAmount, 2) }}</span></td>
                                                  </tr>
                                                  <tr class="order-total">
                                                      <th>Order Total</th>
                                                      <td colspan="5"><strong><span class="amount">${{ number_format($totalAmount, 2) }}</span></strong></td>
                                                  </tr>
                                              </tfoot>
                                          </table>
                                      </div>
                                                 <div class='form-row row'>

                             <div class='col-xs-12 form-group required'>

                                 <label class='control-label'>Name on Card</label> <input

                                     class='form-control' size='4' type='text'>

                             </div>

                         </div>



                         <div class='form-row row'>

                             <div class='col-xs-12 form-group card required'>

                                 <label class='control-label'>Card Number</label> <input

                                     autocomplete='off' class='form-control card-number' size='20'

                                     type='text'>

                             </div>

                         </div>
                         <input type="hidden" name="total_amount" value="{{ $totalAmount }}">



                         <div class='form-row row'>

                             <div class='col-xs-12 col-md-4 form-group cvc required'>

                                 <label class='control-label'>CVC</label> <input autocomplete='off'

                                     class='form-control card-cvc' placeholder='ex. 311' size='4'

                                     type='text'>

                             </div>

                             <div class='col-xs-12 col-md-4 form-group expiration required'>

                                 <label class='control-label'>Expiration Month</label> <input

                                     class='form-control card-expiry-month' placeholder='MM' size='2'

                                     type='text'>

                             </div>

                             <div class='col-xs-12 col-md-4 form-group expiration required'>

                                 <label class='control-label'>Expiration Year</label> <input

                                     class='form-control card-expiry-year' placeholder='YYYY' size='4'

                                     type='text'>

                             </div>

                         </div>



                         <div class="row">

                             <div class="col-xs-12">



                                     <div class="order-button-payment mt-3">
                                         <button type="submit" class="register-button">Place Order</button>
                                     </div>
                                 </div>
                             </div>
                         </div>
                     </form>
                 </div>
             </div>
             <!--Checkout Area End-->
@endsection