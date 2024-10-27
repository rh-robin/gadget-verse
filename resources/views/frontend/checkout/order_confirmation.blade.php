@extends('frontend.main_master')
@section('title')
Checkout
@endsection
@section('content')

<main class="main main-test">
    <div class="container checkout-container">
        <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
            <li class="disabled">
                <a href="">Shopping Cart</a>
            </li>
            <li class="disabled">
                <a href="">Checkout</a>
            </li>
            <li class="active">
                <a href="">Order Completion</a>
            </li>
        </ul>

        

        <div class="row">
            <!-- End .col-lg-8 -->

            <div class="col-lg-10 mx-auto">
                <div class="order-summary">
                    <h3>YOUR ORDER</h3>
                    <div class="buttons py-4 d-flex justify-content-between">
                        <a type="submit" class="btn btn-dark" title="Video Call">
                           <i class="fa-solid fa-video text-light"></i>
                        </a>
                        <a href="{{ route('order.confirm', $order->id) }}" type="submit" class="btn btn-dark ">
                             <span class="text-light">Pay Shipping Charge</span>
                        </a>
                    </div>
                    <p>You can request for a video call or directly place the order by paying shipping charge</p>

                    <table class="table table-mini-cart">
                        <thead>
                            <tr>
                                <th>Image</th>
                                <th>Product</th>
                                <th>Unit Price</th>
                                <th class="text-right">Sub Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartContents as $cartContent)
                                
                            <tr>
                                <td width="20%">
                                    <img src="{{ asset($cartContent->options->image) }}" style="width: 100px; height:auto" alt="">
                                </td>
                                <td class="product-col">
                                    <h3 class="product-title">
                                        {{ $cartContent->name }} ×
                                        <span class="product-qty">{{ $cartContent->qty }}</span><br>
                                        <span><strong>Color:</strong> {{ $cartContent->options->color }} <strong>Size:</strong> {{ $cartContent->options->size }}</span>
                                    </h3>
                                </td>

                                <td class="price-col">
                                    <span>{{ $cartContent->price }}</span>
                                </td>

                                <td class="price-col">
                                    <span>{{ $cartContent->price * $cartContent->qty }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="cart-subtotal">
                                <td colspan="3">
                                    <h4>Subtotal</h4>
                                </td>

                                <td class="price-col">
                                    <span>{{ $cartTotal }}</span>
                                </td>
                            </tr>
                            
                        @if (Session::has('coupon'))
                            <tr class="cart-subtotal">
                                <td colspan="3">
                                    <h4>Coupon: {{ Session::get('coupon')['coupon_code'] }}</h4>
                                </td>
                                <td class="price-col">
                                    <span>-{{ Session::get('coupon')['discount_amount'] }}</span>
                                </td>
                            </tr>
                            <tr class="order-shipping">
                                <td class="text-left" colspan="3">
                                    <h4 class="m-b-sm">Shipping</h4>
                                </td>
                                <td>
                                    <span id="shippingCharge">{{ $shippingCharge }}</span>
                                </td>
                            </tr>
                            <tr class="order-total">
                                <td colspan="3">
                                    <h4>Total</h4>
                                </td>
                                <td>
                                    <b class="total-price"><span id="total">{{ $totalAmount }}tk</span></b>
                                </td>
                            </tr>
                        @else
                            <tr class="order-shipping">
                                <td class="text-left" colspan="3">
                                    <h4 class="m-b-sm">Shipping</h4>
                                </td>
                                <td>
                                    <span id="shippingCharge">{{ $shippingCharge }}</span>
                                </td>
                            </tr>
                            <tr class="order-total">
                                <td colspan="3">
                                    <h4>Total</h4>
                                </td>
                                <td>
                                    <b class="total-price"><span id="total">{{ $totalAmount }}tk</span></b>
                                </td>
                            </tr>
                        @endif
                            <tr>
                                <td colspan="3"><h4 class="">Payment method:</h4></td>
                                <td><span style="font-weight: 400;">Cash on delivery</span></td>
                            </tr>
                        </tfoot>
                    </table>

                    
                </div>
                <!-- End .cart-summary -->
            </div>
            <!-- End .col-lg-4 -->
        </div>
        <!-- End .row -->
    </div>
    <!-- End .container -->
</main>
<!-- End .main -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>


<script>
    function submitForm() {
            document.getElementById("submitForm").submit();
    }
</script>

@endsection