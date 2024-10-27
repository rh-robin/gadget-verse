@extends('frontend.main_master')
@section('title')
Shopping Cart
@endsection
@section('content')
 

<main class="main">
    <div class="container">
        <ul class="checkout-progress-bar d-flex justify-content-center flex-wrap">
            <li class="active">
                <a href="cart.html">Shopping Cart</a>
            </li>
            <li>
                <a href="checkout.html">Checkout</a>
            </li>
            <li class="disabled">
                <a href="cart.html">Order Complete</a>
            </li>
        </ul>

        <div class="row">
            <div class="col-lg-8">
                <div class="cart-table-container">
                    <table class="table table-cart">
                        <thead>
                            <tr>
                                <th class="thumbnail-col"></th>
                                <th class="product-col" style="width:23%">Product</th>
                                <th>Color/Size</th>
                                <th class="price-col">Price</th>
                                <th class="qty-col">Quantity</th>
                                <th class="text-right">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody id="cart">
                        </tbody>
                        

                        <tfoot>
                            <tr>
                                <td colspan="5" class="clearfix">
                                    
                                @if(Session::has('gv-coupon') || Session::has('gv-refer'))

                                @else
                                    <div class="float-left" id="couponField">
                                        <div class="cart-discount">
                                            <form action="javascript:;">
                                                <p>Do you have Coupon or Referral Code?</p>
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="coupon_refer" id="exampleRadios1" value="coupon" onclick="showCodeField(this)">
                                                    <label class="form-check-label pl-2" for="exampleRadios1">
                                                      Coupon
                                                    </label>
                                                </div>
                                                <div class="form-check mt-1">
                                                    <input class="form-check-input" type="radio" name="coupon_refer" id="exampleRadios2" value="refer" onclick="showCodeField(this)">
                                                    <label class="form-check-label pl-2" for="exampleRadios2">
                                                      Referral Code
                                                    </label>
                                                </div>
                                                <div class="input-group mt-2" id="codeContainer">
                                                    
                                                </div><!-- End .input-group -->
                                            </form>
                                        </div>
                                    </div><!-- End .float-left -->
                                @endif

                                    <div class="float-right">
                                        <a href="" class="btn btn-shop btn-update-cart">
                                            Update Cart
                                        </a>
                                    </div><!-- End .float-right -->
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div><!-- End .cart-table-container -->
            </div><!-- End .col-lg-8 -->

            <div class="col-lg-4">
                <div class="cart-summary">
                    <h3>CART TOTALS</h3>

                    <table class="table table-totals" id="totalTable">
                        
                    </table>

                    <div class="checkout-methods">
                        
                        <a href="{{ route('checkout') }}" class="btn btn-block btn-dark" id="checkoutBtn">Proceed to Checkout
                            <i class="fa fa-arrow-right"></i></a>
                    </div>
                </div><!-- End .cart-summary -->
            </div><!-- End .col-lg-4 -->
        </div><!-- End .row -->
    </div><!-- End .container -->

    <div class="mb-6"></div><!-- margin -->
</main><!-- End .main -->



<script>
    function showCodeField(input){
        let inputValue = input.value;
        let codeContainer = document.getElementById('codeContainer');

        if(inputValue == "coupon"){
            codeContainer.innerHTML = `
                <input type="text" class="form-control form-control-sm" id="couponName" placeholder="Coupon Code" required>
                <div class="input-group-append">
                    <button class="btn btn-sm" type="submit" onclick="applyCoupon()">Apply
                        Coupon</button>
                </div>
            `;
        }
        if(inputValue == "refer"){
            codeContainer.innerHTML = `
                <input type="text" class="form-control form-control-sm" id="referCode" placeholder="Referral Code" required>
                <div class="input-group-append">
                    <button class="btn btn-sm" type="submit" onclick="applyReferCode()">Appy Referral Code</button>
                </div>
            `;
        }
        
    }
</script>




@endsection