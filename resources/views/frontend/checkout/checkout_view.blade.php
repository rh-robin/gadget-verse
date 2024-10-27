@extends('frontend.main_master')
@section('title')
Checkout
@endsection
@section('content')

<main class="main main-test">
    <div class="container checkout-container">
        <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
            <li>
                <a href="{{ route('cart.view') }}">Shopping Cart</a>
            </li>
            <li class="active">
                <a href="">Checkout</a>
            </li>
            <li class="disabled">
                <a href="">Order Complete</a>
            </li>
        </ul>

        

        <div class="row">
            <div class="col-lg-7">
                <ul class="checkout-steps">
                    <li>
                        <h2 class="step-title">Billing details</h2>

                        <form action="{{ route('order.create') }}" id="submitForm" method="POST">
                            @csrf
                            <div class="form-group">
                                <label>Shipping Name
                                    <abbr class="required" title="required">*</abbr>
                                </label>
                                <input type="text" name="shipping_name" class="form-control" placeholder="Your Name" value="{{ Auth::user()->name }}" />
                                @error('shipping_name')
                                <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                @enderror
                            </div>

                            <div class="form-check mb-1">
                                <input class="form-check-input" type="radio" name="inOutDhaka" id="inside" value="inside">
                                <label class="form-check-label pl-2" for="inside">
                                  Inside Dhaka City
                                </label>
                            </div>

                            <div class="form-check mb-2">
                                <input class="form-check-input" type="radio" name="inOutDhaka" id="outside" value="outside">
                                <label class="form-check-label pl-2" for="outside">
                                  Outside Dhaka City
                                </label>
                                @error('inOutDhaka')
                                <div class=""><small class="text-danger">{{ $message }}</small></div>
                                @enderror
                            </div>
                            

                            
                            {{-- <div class="select-custom">
                                <label>Division
                                    <abbr class="required" title="required">*</abbr></label>
                                <select name="division_id" class="form-control">
                                    <option value="" selected>Select Division
                                    </option>
                                @foreach ($divisions as $division)
                                    <option value="{{ $division->id }}">{{ $division->division_name }}</option>
                                @endforeach

                                </select>
                                @error('division_id')
                                <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                @enderror
                            </div> --}}

                            {{-- <div class="select-custom">
                                <label>District
                                    <abbr class="required" title="required">*</abbr></label>
                                <select name="district_id" class="form-control">
                                    <option value="" selected>Select District
                                    </option>

                                </select>
                                @error('district_id')
                                <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                @enderror
                            </div> --}}

                            <div class="form-group mb-1 pb-2">
                                <label>Street address
                                    <abbr class="required" title="required">*</abbr></label>
                                <textarea name="address" class="form-control" placeholder="Area name, Street name, Street number, House number, Flat number" cols="30" rows="5"></textarea>
                                @error('address')
                                <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                @enderror
                            </div>


                            <div class="form-group">
                                <label>Postcode / Zip
                                    <abbr class="required" title="required"></abbr></label>
                                <input type="text" name="post_code" class="form-control" />
                                @error('post_code')
                                <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Phone <abbr class="required" title="required">*</abbr></label>
                                <input type="tel" name="shipping_phone" class="form-control" value="{{ Auth::user()->phone }}"/>
                                @error('shipping_phone')
                                <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Email address
                                    <abbr class="required" title="required">*</abbr></label>
                                <input type="email" name="shipping_email" class="form-control" value="{{ Auth::user()->email }}"/>
                                @error('shipping_email')
                                <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                @enderror
                            </div>



                            <div class="form-group">
                                <label class="order-comments">Order notes (optional)</label>
                                <textarea class="form-control" name="notes" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                            </div>
                        
                    </li>
                </ul>
            </div>
            <!-- End .col-lg-8 -->

            <div class="col-lg-5">
                <div class="order-summary">
                    <h3>YOUR ORDER</h3>

                    <table class="table table-mini-cart">
                        <thead>
                            <tr>
                                <th colspan="2">Product</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($cartContents as $cartContent)
                                
                            <tr>
                                <td class="product-col">
                                    <h3 class="product-title">
                                        {{ $cartContent->name }} ×
                                        <span class="product-qty">{{ $cartContent->qty }}</span><br>
                                        <span><strong>Color:</strong> {{ $cartContent->options->color }} <strong>Size:</strong> {{ $cartContent->options->size }}</span>
                                    </h3>
                                </td>

                                <td class="price-col">
                                    <span>{{ $cartContent->price * $cartContent->qty }}</span>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr class="cart-subtotal">
                                <td>
                                    <h4>Subtotal</h4>
                                </td>

                                <td class="price-col">
                                    <span>{{ $cartTotal }}</span>
                                </td>
                            </tr>
                            
                        @if (Session::has('gv-coupon'))
                            <tr class="cart-subtotal">
                                <td>
                                    <h4>Coupon: {{ Session::get('gv-coupon')['coupon_code'] }}</h4>
                                </td>
                                <td class="price-col">
                                    <span>-{{ Session::get('gv-coupon')['discount_amount'] }}</span>
                                </td>
                            </tr>
                            <tr class="order-shipping">
                                <td class="text-left">
                                    <h4 class="m-b-sm">Shipping</h4>
                                </td>
                                <td>
                                    <span id="shippingCharge"></span>
                                </td>
                            </tr>
                            <tr class="order-total">
                                <td>
                                    <h4>Total</h4>
                                </td>
                                <td>
                                    <b class="total-price"><span id="total">{{ Session::get('gv-coupon')['total_amount'] }}tk</span></b>
                                </td>
                            </tr>
                        @elseif (Session::has('gv-refer'))
                            <tr class="cart-subtotal">
                                <td>
                                    <h4>Referral code: {{ Session::get('gv-refer')['refer_code'] }}</h4>
                                </td>
                                <td class="price-col">
                                    <span>-{{ Session::get('gv-refer')['discount_amount'] }}</span>
                                </td>
                            </tr>
                            <tr class="order-shipping">
                                <td class="text-left">
                                    <h4 class="m-b-sm">Shipping</h4>
                                </td>
                                <td>
                                    <span id="shippingCharge"></span>
                                </td>
                            </tr>
                            <tr class="order-total">
                                <td>
                                    <h4>Total</h4>
                                </td>
                                <td>
                                    <b class="total-price"><span id="total">{{ Session::get('gv-refer')['total_amount'] }}tk</span></b>
                                </td>
                        </tr>
                        @else
                            <tr class="order-shipping">
                                <td class="text-left">
                                    <h4 class="m-b-sm">Shipping</h4>
                                </td>
                                <td>
                                    <span id="shippingCharge"></span>
                                </td>
                            </tr>
                            <tr class="order-total">
                                <td>
                                    <h4>Total</h4>
                                </td>
                                <td>
                                    <b class="total-price"><span id="total">{{ $cartTotal }}tk</span></b>
                                </td>
                            </tr>
                        @endif
                            
                        </tfoot>
                    </table>

                    <div class="payment-methods">
                        <h4 class="">Payment methods</h4>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="payment_method" id="paynow" value="paynow">
                            <label class="form-check-label  px-2" for="paynow">
                              Pay Now
                            </label>
                        </div>
                        <div class="form-check ">
                            <input class="form-check-input" type="radio" name="payment_method" id="cash" value="cashon">
                            <label class="form-check-label px-2" for="cash">
                              Cash on delivery
                            </label>
                        </div>
                        <p class="text-success" id="paymentText"></p>
                        @error('payment_method')
                        <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                        @enderror
                    </div>

                    </form>  {{-- ============== end form ========== --}}

                    <button type="submit" class="btn btn-dark btn-place-order" onclick="submitForm()">
                        Next
                    </button>
                    <p>After clicking next button, you will be able to confirm the order and see the product via video call</p>
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
    $(document).ready(function(){
        /* scripts to get division wise district */
        /* $('select[name="division_id"]').on('change', function(){
            var division_id = $(this).val();
            if(division_id){
                $.ajax({
                    url: "{{ url('/get-district-ajax') }}/"+division_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data){
                        var d = $('select[name="district_id"]').empty();
                        d = d.append('<option value="" selected disabled>Select District</option>')
                        $.each(data, function(key, value){
                            d.append('<option value="'+value.id+'">'+value.district_name+'</option>');
                        });
                    }
                });
            }else{
                alert('danger');
            }
        }); */

        /* scripts to get shipping charge */
        /* $('select[name="district_id"]').on('change', function(){
            var district_id = $(this).val();
            if(district_id){
                $.ajax({
                    url: "{{ url('/get-shipping-charge') }}/"+district_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data){
                        $('#shippingCharge').text(data.shipping_charge);
                        $('#total').text(data.total+"tk");
                        
                    }
                });
            }else{
                alert('danger');
            }
        }); */


        $('input[name="inOutDhaka"]').on('change', function(){
            let value = $(this).val();
            if(value){
                $.ajax({
                    url: "{{ url('/get-shipping-charge') }}/"+value,
                    type: "GET",
                    dataType: "json",
                    success: function(data){
                        $('#shippingCharge').text(data.shipping_charge);
                        $('#total').text(data.total+"tk");
                        
                    }
                });
            }else{
                alert('danger');
            }
        });


        $('input[name="payment_method"]').on('change', function(){
            let value = $(this).val();
            if(value == 'cashon'){
            console.log(value);
                $('#paymentText').text("You have to pay the shipping charge to place your order.");
            }else{
                $('#paymentText').text("");
            }
        });
    })

</script>

<script>
    function submitForm() {
            document.getElementById("submitForm").submit();
    }
</script>

@endsection