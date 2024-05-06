@extends('frontend.main_master')
@section('title')
Gadget Verse | Online Gadget Shop
@endsection
@section('content')

<main class="main home mt-2">




    <div class="container mb-2">
        <div class="info-boxes-container row row-joined mb-2 font2">
            <div class="info-box info-box-icon-left col-lg-4">
                <i class="icon-shipping"></i>

                <div class="info-box-content">
                    <h4>FREE SHIPPING &amp; RETURN</h4>
                    <p class="text-body">Free shipping on all orders over $99</p>
                </div>
                <!-- End .info-box-content -->
            </div>
            <!-- End .info-box -->

            <div class="info-box info-box-icon-left col-lg-4">
                <i class="icon-money"></i>

                <div class="info-box-content">
                    <h4>MONEY BACK GUARANTEE</h4>
                    <p class="text-body">100% money back guarantee</p>
                </div>
                <!-- End .info-box-content -->
            </div>
            <!-- End .info-box -->

            <div class="info-box info-box-icon-left col-lg-4">
                <i class="icon-support"></i>

                <div class="info-box-content">
                    <h4>ONLINE SUPPORT 24/7</h4>
                    <p class="text-body">Lorem ipsum dolor sit amet.</p>
                </div>
                <!-- End .info-box-content -->
            </div>
            <!-- End .info-box -->
        </div>

        <div class="row">
            <div class="col-lg-9">
                <div class="home-slider slide-animate owl-carousel owl-theme mb-2" data-owl-options="{
                    'loop': false,
                    'dots': true,
                    'nav': false
                }">
                    <div class="home-slide home-slide1 banner banner-md-vw banner-sm-vw d-flex align-items-center">
                        <img class="slide-bg" style="background-color: #2699D0;" src="{{ asset('frontend/assets/images/demoes/demo1/slider/slide-1.png') }}" width="880" height="428" alt="home-slider">
                        <div class="banner-layer appear-animate" data-animation-name="fadeInUpShorter">
                            <h4 class="text-white mb-0">Find the Boundaries. Push Through!</h4>
                            <h2 class="text-white mb-0">Summer Sale</h2>
                            <h3 class="text-white text-uppercase m-b-3">70% Off</h3>
                            <h5 class="text-white text-uppercase d-inline-block mb-0 ls-n-20 align-text-bottom">
                                Starting At <b class="coupon-sale-text bg-secondary text-white d-inline-block">$<em
                                        class="align-text-top">199</em>99</b></h5>
                            <a href="demo1-shop.html" class="btn btn-dark btn-md ls-10">Shop Now!</a>
                        </div>
                        <!-- End .banner-layer -->
                    </div>
                    <!-- End .home-slide -->

                    <div class="home-slide home-slide2 banner banner-md-vw banner-sm-vw d-flex align-items-center">
                        <img class="slide-bg" style="background-color: #dadada;" src="{{ asset('frontend/assets/images/demoes/demo1/slider/slide-2.jpg') }}" width="880" height="428" alt="home-slider">
                        <div class="banner-layer text-uppercase appear-animate" data-animation-name="fadeInUpShorter">
                            <h4 class="m-b-2">Over 200 products with discounts</h4>
                            <h2 class="m-b-3">Great Deals</h2>
                            <h5 class="d-inline-block mb-0 align-top mr-5 mb-2">Starting At
                                <b>$<em>299</em>99</b>
                            </h5>
                            <a href="demo1-shop.html" class="btn btn-dark btn-md ls-10">Get Yours!</a>
                        </div>
                        <!-- End .banner-layer -->
                    </div>
                    <!-- End .home-slide -->

                    <div class="home-slide home-slide3 banner banner-md-vw banner-sm-vw  d-flex align-items-center">
                        <img class="slide-bg" style="background-color: #e5e4e2;" src="{{ asset('frontend/assets/images/demoes/demo1/slider/slide-3.jpgv') }}" width="880" height="428" alt="home-slider" />
                        <div class="banner-layer text-uppercase appear-animate" data-animation-name="fadeInUpShorter">
                            <h4 class="m-b-2">Up to 70% off</h4>
                            <h2 class="m-b-3">New Arrivals</h2>
                            <h5 class="d-inline-block mb-0 align-top mr-5 mb-2">Starting At
                                <b>$<em>299</em>99</b>
                            </h5>
                            <a href="demo1-shop.html" class="btn btn-dark btn-md ls-10">Get Yours!</a>
                        </div>
                        <!-- End .banner-layer -->
                    </div>
                    <!-- End .home-slide -->
                </div>
                <!-- End .home-slider -->

                <div class="banners-container m-b-2 owl-carousel owl-theme" data-owl-options="{
                    'dots': false,
                    'margin': 20,
                    'loop': false,
                    'responsive': {
                        '480': {
                            'items': 2
                        },
                        '768': {
                            'items': 3
                        }
                    }
                }">
                    <div class="banner banner1 banner-hover-shadow d-flex align-items-center mb-2 w-100 appear-animate" data-animation-name="fadeInLeftShorter" data-animation-delay="500">
                        <figure class="w-100">
                            <img src="{{ asset('frontend/assets/images/demoes/demo1/banners/banner-1.jpg') }}" style="background-color: #dadada;" alt="banner">
                        </figure>
                        <div class="banner-layer">
                            <h3 class="m-b-2">Porto Watches</h3>
                            <h4 class="m-b-4 text-primary"><sup class="text-dark"><del>20%</del></sup>30%<sup>OFF</sup></h4>
                            <a href="demo1-shop.html" class="text-dark text-uppercase ls-10">Shop Now</a>
                        </div>
                    </div>
                    <!-- End .banner -->
                    <div class="banner banner2 text-uppercase banner-hover-shadow d-flex align-items-center mb-2 w-100 appear-animate" data-animation-name="fadeInUpShorter" data-animation-delay="200">
                        <figure class="w-100">
                            <img src="{{ asset('frontend/assets/images/demoes/demo1/banners/banner-2.jpg') }}" style="background-color: #dadada;" alt="banner">
                        </figure>
                        <div class="banner-layer text-center">
                            <h3 class="m-b-1 ls-n-20">Deal Promos</h3>
                            <h4 class="text-body">Starting at $99</h4>
                            <a href="demo1-shop.html" class="text-dark text-uppercase ls-10">Shop Now</a>
                        </div>
                    </div>
                    <!-- End .banner -->
                    <div class="banner banner3 banner-hover-shadow d-flex align-items-center mb-2 w-100 appear-animate" data-animation-name="fadeInRightShorter" data-animation-delay="500">
                        <figure class="w-100">
                            <img src="{{ asset('frontend/assets/images/demoes/demo1/banners/banner-3.jpg') }}" style="background-color: #dadada;" alt="banner">
                        </figure>
                        <div class="banner-layer text-right">
                            <h3 class="m-b-2">Handbags</h3>
                            <h4 class="mb-3 text-secondary text-uppercase">Starting at $99</h4>
                            <a href="demo1-shop.html" class="text-dark text-uppercase ls-10">Shop Now</a>
                        </div>
                    </div>
                    <!-- End .banner -->
                </div>

                <h2 class="section-title ls-n-10 m-b-4 appear-animate" data-animation-name="fadeInUpShorter">
                    Featured Products</h2>

            
            
                <div class="products-slider owl-carousel owl-theme dots-top dots-small m-b-1 pb-1 appear-animate" data-animation-name="fadeInUpShorter">


                    @foreach ($products as $product)
                    @php
                        $productVariation = App\Models\ProductVariation::where('product_id', $product->id)->orderBy('discount_price')->first();
                    @endphp
                    <div class="product-default appear-animate" data-animation-name="fadeInRightShorter">
                        <figure>
                            <a href="{{ route('product.details', [$product->id, $product->product_slug]) }}">
                                <img src="{{ asset($product->product_thumbnail) }}" width="220" height="220" alt="product">
                            </a>
                        @php
                            $amount = $productVariation->selling_price- $productVariation->discount_price;
                            $discount=null;
                            if($amount>1){
                                $discount = ($amount/$productVariation->selling_price)*100;
                            }
                        @endphp
                        @if ($discount == null || $productVariation->discount_price==null)
                            <div class="label-group">
                                <div class="product-label label-hot">NEW</div>
                            </div>
                        @else
                            <div class="label-group">
                                <div class="product-label label-hot bg-danger">-{{ round($discount) }}%</div>
                            </div>
                        @endif
                            
                        </figure>
                        <div class="product-details">
                            <div class="category-list">
                                <a href="category.html" class="product-category">{{ $product->category->category_name }}</a>
                            </div>
                            <h3 class="product-title">
                                <a href="{{ route('product.details', [$product->id, $product->product_slug]) }}">{{ $product->product_name }}</a>
                            </h3>
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:80%"></span>
                                    <!-- End .ratings -->
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                                <!-- End .product-ratings -->
                            </div>
                            <!-- End .product-container -->
                            
                            <div class="price-box">
                            @if($productVariation->discount_price == null)
                                <span class="product-price">{{ $productVariation->selling_price }}</span>
                            @else
                                <del class="old-price">{{ $productVariation->selling_price }}</del>
                                <span class="product-price">{{ $productVariation->discount_price }}</span>
                            @endif
                            </div>
                            <!-- End .price-box -->
                            <div class="product-action">
                                <a href="wishlist.html" class="btn-icon-wish" title="wishlist"><i
                                        class="icon-heart"></i></a>
                                <a href="#" class="btn-icon btn-add-cart product-type-simple"><i
                                        class="icon-shopping-cart"></i><span>ADD TO CART</span></a>
                                <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View" data-toggle="modal" data-target="#exampleModal" id="{{ $product->id }}" onclick="productQuickView(this.id)"><i
                                        class="fas fa-external-link-alt"></i></a>
                            </div>
                        </div>
                        <!-- End .product-details -->
                    </div> {{-- end product default --}}
                    @endforeach

                </div>
            

                <!-- End .featured-proucts -->


                {{-- quick view --}}
                <div class="product-single-container product-single-default product-quick-view mb-0 custom-scrollbar">
                    <div class="row">
                        <div class="col-md-6 product-single-gallery mb-md-0">
                            <div class="product-slider-container">
                                <div class="label-group">
                                    <div class="product-label label-hot">HOT</div>
                                    <!---->
                                    <div class="product-label label-sale">
                                        -16%
                                    </div>
                                </div>
                
                                <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                                    <div class="product-item">
                                        <img class="product-single-image" src="assets/images/products/zoom/product-1-big.jpg"
                                            data-zoom-image="assets/images/products/zoom/product-1-big.jpg" />
                                    </div>
                                    <div class="product-item">
                                        <img class="product-single-image" src="assets/images/products/zoom/product-2-big.jpg"
                                            data-zoom-image="assets/images/products/zoom/product-2-big.jpg" />
                                    </div>
                                    <div class="product-item">
                                        <img class="product-single-image" src="assets/images/products/zoom/product-3-big.jpg"
                                            data-zoom-image="assets/images/products/zoom/product-3-big.jpg" />
                                    </div>
                                    <div class="product-item">
                                        <img class="product-single-image" src="assets/images/products/zoom/product-4-big.jpg"
                                            data-zoom-image="assets/images/products/zoom/product-4-big.jpg" />
                                    </div>
                                    <div class="product-item">
                                        <img class="product-single-image" src="assets/images/products/zoom/product-5-big.jpg"
                                            data-zoom-image="assets/images/products/zoom/product-5-big.jpg" />
                                    </div>
                                </div>
                                <!-- End .product-single-carousel -->
                            </div>
                            <div class="prod-thumbnail owl-dots">
                                <div class="owl-dot">
                                    <img src="assets/images/products/zoom/product-1.jpg" />
                                </div>
                                <div class="owl-dot">
                                    <img src="assets/images/products/zoom/product-2.jpg" />
                                </div>
                                <div class="owl-dot">
                                    <img src="assets/images/products/zoom/product-3.jpg" />
                                </div>
                                <div class="owl-dot">
                                    <img src="assets/images/products/zoom/product-4.jpg" />
                                </div>
                                <div class="owl-dot">
                                    <img src="assets/images/products/zoom/product-5.jpg" />
                                </div>
                            </div>
                        </div><!-- End .product-single-gallery -->
                
                        <div class="col-md-6">
                            <div class="product-single-details mb-0 ml-md-4">
                                <h1 class="product-title">Men Black Sports Shoes</h1>
                
                                <div class="ratings-container">
                                    <div class="product-ratings">
                                        <span class="ratings" style="width:60%"></span><!-- End .ratings -->
                                    </div><!-- End .product-ratings -->
                
                                    <a href="#" class="rating-link">( 6 Reviews )</a>
                                </div><!-- End .ratings-container -->
                
                                <hr class="short-divider">
                
                                <div class="price-box">
                                    <span class="product-price"> $1,699.00</span>
                                </div><!-- End .price-box -->
                
                                <div class="product-desc">
                                    <p>
                                        Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla
                                        pariatur. Excepteur sint occaecat cupidatat non.
                                    </p>
                                </div><!-- End .product-desc -->
                
                                <ul class="single-info-list">
                                    <!---->
                                    <li>
                                        SKU:
                                        <strong>654613612</strong>
                                    </li>
                
                                    <li>
                                        CATEGORY:
                                        <strong>
                                            <a href="#" class="product-category">SHOES</a>
                                        </strong>
                                    </li>
                                </ul>
                
                                <div class="product-filters-container">
                                    <div class="product-single-filter">
                                        <label>Size:</label>
                                        <ul class="config-size-list">
                                            <li><a href="javascript:;" class="d-flex align-items-center justify-content-center">XL</a>
                                            </li>
                                            <li class=""><a href="javascript:;"
                                                    class="d-flex align-items-center justify-content-center">L</a></li>
                                            <li class=""><a href="javascript:;"
                                                    class="d-flex align-items-center justify-content-center">M</a></li>
                                            <li class=""><a href="javascript:;"
                                                    class="d-flex align-items-center justify-content-center">S</a></li>
                                        </ul>
                                    </div>
                
                                    <div class="product-single-filter">
                                        <label></label>
                                        <a class="font1 text-uppercase clear-btn" href="#">Clear</a>
                                    </div>
                                    <!---->
                                </div>
                
                                <div class="product-action">
                                    <div class="price-box product-filtered-price">
                                        <del class="old-price"><span>$286.00</span></del>
                                        <span class="product-price">$245.00</span>
                                    </div>
                
                                    <div class="product-single-qty">
                                        <input class="horizontal-quantity form-control" type="text" />
                                    </div><!-- End .product-single-qty -->
                
                                    <a href="javascript:;" class="btn btn-dark add-cart mr-2" title="Add to Cart">Add to Cart</a>
                
                                    <a href="cart.html" class="btn view-cart d-none">View cart</a>
                                </div><!-- End .product-action -->
                
                                <hr class="divider mb-0 mt-0">
                
                                <div class="product-single-share mb-0">
                                    <label class="sr-only">Share:</label>
                
                                    <div class="social-icons mr-2">
                                        <a href="#" class="social-icon social-facebook icon-facebook" target="_blank"
                                            title="Facebook"></a>
                                        <a href="#" class="social-icon social-twitter icon-twitter" target="_blank" title="Twitter"></a>
                                        <a href="#" class="social-icon social-linkedin fab fa-linkedin-in" target="_blank"
                                            title="Linkedin"></a>
                                        <a href="#" class="social-icon social-gplus fab fa-google-plus-g" target="_blank"
                                            title="Google +"></a>
                                        <a href="#" class="social-icon social-mail icon-mail-alt" target="_blank" title="Mail"></a>
                                    </div><!-- End .social-icons -->
                
                                    <a href="wishlist.html" class="btn-icon-wish add-wishlist" title="Add to Wishlist"><i
                                            class="icon-wishlist-2"></i><span>Add to
                                            Wishlist</span></a>
                                </div><!-- End .product single-share -->
                            </div>
                        </div><!-- End .product-single-details -->
                
                        <button title="Close (Esc)" type="button" class="mfp-close">
                            ×
                        </button>
                    </div><!-- End .row -->
                </div><!-- End .product-single-container -->
                {{-- end quick view  --}}


                <div class="brands-slider owl-carousel owl-theme images-center appear-animate" data-animation-name="fadeIn" data-animation-duration="700" data-owl-options="{
                    'margin': 0,
                    'responsive': {
                        '768': {
                            'items': 4
                        },
                        '991': {
                            'items': 4
                        },
                        '1200': {
                            'items': 5
                        }
                    }
                }">
                    <img src="{{ asset('frontend/assets/images/brands/small/brand1.png') }}" width="140" height="60" alt="brand">
                    <img src="{{ asset('frontend/assets/images/brands/small/brand2.png') }}" width="140" height="60" alt="brand">
                    <img src="{{ asset('frontend/assets/images/brands/small/brand3.png') }}" width="140" height="60" alt="brand">
                    <img src="{{ asset('frontend/assets/images/brands/small/brand4.png') }}" width="140" height="60" alt="brand">
                    <img src="{{ asset('frontend/assets/images/brands/small/brand5.png') }}" width="140" height="60" alt="brand">
                    <img src="{{ asset('frontend/assets/images/brands/small/brand6.png') }}" width="140" height="60" alt="brand">
                </div>
                <!-- End .brands-slider -->

                <div class="row products-widgets">
                    <div class="col-sm-6 col-md-4 pb-4 pb-md-0 appear-animate" data-animation-name="fadeInLeftShorter" data-animation-delay="200">
                        <div class="product-column">
                            <h3 class="section-sub-title ls-n-20">Top Rated Products</h3>

                            <div class="product-default left-details product-widget">
                                <figure>
                                    <a href="demo1-product.html">
                                        <img src="{{ asset('frontend/assets/images/demoes/demo1/products/small/product-4.jpg') }}" width="84" height="84" alt="product">
                                        <img src="{{ asset('frontend/assets/images/demoes/demo1/products/small/product-4-2.jpg') }}" width="84" height="84" alt="product">
                                    </a>
                                </figure>
                                <div class="product-details">
                                    <h3 class="product-title"> <a href="demo1-product.html">Porto Extended
                                            Camera</a> </h3>
                                    <div class="ratings-container">
                                        <div class="product-ratings">
                                            <span class="ratings" style="width:100%"></span>
                                            <!-- End .ratings -->
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <!-- End .product-ratings -->
                                    </div>
                                    <!-- End .product-container -->
                                    <div class="price-box">
                                        <span class="product-price">$49.00</span>
                                    </div>
                                    <!-- End .price-box -->
                                </div>
                                <!-- End .product-details -->
                            </div>
                            <div class="product-default left-details product-widget">
                                <figure>
                                    <a href="demo1-product.html">
                                        <img src="{{ asset('frontend/assets/images/demoes/demo1/products/small/product-5.jpg') }}" width="84" height="84" alt="product">
                                        <img src="{{ asset('frontend/assets/images/demoes/demo1/products/small/product-5-2.jpg') }}" width="84" height="84" alt="product">
                                    </a>
                                </figure>
                                <div class="product-details">
                                    <h3 class="product-title"> <a href="demo1-product.html">Blue BackPack</a>
                                    </h3>
                                    <div class="ratings-container">
                                        <div class="product-ratings">
                                            <span class="ratings" style="width:100%"></span>
                                            <!-- End .ratings -->
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <!-- End .product-ratings -->
                                    </div>
                                    <!-- End .product-container -->
                                    <div class="price-box">
                                        <span class="product-price">$49.00</span>
                                    </div>
                                    <!-- End .price-box -->
                                </div>
                                <!-- End .product-details -->
                            </div>
                            <div class="product-default left-details product-widget ">
                                <figure>
                                    <a href="demo1-product.html">
                                        <img src="{{ asset('frontend/assets/images/demoes/demo1/products/small/product-6.jpg') }}" width="84" height="84" alt="product">
                                        <img src="{{ asset('frontend/assets/images/demoes/demo1/products/small/product-6-2.jpg') }}" width="84" height="84" alt="product">
                                    </a>
                                </figure>
                                <div class="product-details">
                                    <h3 class="product-title"> <a href="demo1-product.html">Casual Blue
                                            Shoes</a> </h3>
                                    <div class="ratings-container">
                                        <div class="product-ratings">
                                            <span class="ratings" style="width:100%"></span>
                                            <!-- End .ratings -->
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <!-- End .product-ratings -->
                                    </div>
                                    <!-- End .product-container -->
                                    <div class="price-box">
                                        <span class="product-price">$49.00</span>
                                    </div>
                                    <!-- End .price-box -->
                                </div>
                                <!-- End .product-details -->
                            </div>
                        </div>
                        <!-- End .product-column -->
                    </div>
                    <!-- End .col-md-4 -->

                    <div class="col-sm-6 col-md-4 pb-4 pb-md-0 appear-animate" data-animation-name="fadeInLeftShorter" data-animation-delay="500">
                        <div class="product-column">
                            <h3 class="section-sub-title ls-n-20">Best Selling Products</h3>

                            <div class="product-default left-details product-widget ">
                                <figure>
                                    <a href="demo1-product.html">
                                        <img src="{{ asset('frontend/assets/images/demoes/demo1/products/small/product-2.jpg') }}" width="84" height="84" alt="product">
                                    </a>
                                </figure>
                                <div class="product-details">
                                    <h3 class="product-title"> <a href="demo1-product.html">Battery Charger</a>
                                    </h3>
                                    <div class="ratings-container">
                                        <div class="product-ratings">
                                            <span class="ratings" style="width:100%"></span>
                                            <!-- End .ratings -->
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <!-- End .product-ratings -->
                                    </div>
                                    <!-- End .product-container -->
                                    <div class="price-box">
                                        <span class="product-price">$49.00</span>
                                    </div>
                                    <!-- End .price-box -->
                                </div>
                                <!-- End .product-details -->
                            </div>
                            <div class="product-default left-details product-widget ">
                                <figure>
                                    <a href="demo1-product.html">
                                        <img src="{{ asset('frontend/assets/images/demoes/demo1/products/small/product-7.jpg') }}" width="84" height="84" alt="product">
                                        <img src="{{ asset('frontend/assets/images/demoes/demo1/products/small/product-7-2.jpg') }}" width="84" height="84" alt="product">
                                    </a>
                                </figure>
                                <div class="product-details">
                                    <h3 class="product-title"> <a href="demo1-product.html">Computer Mouse</a>
                                    </h3>
                                    <div class="ratings-container">
                                        <div class="product-ratings">
                                            <span class="ratings" style="width:100%"></span>
                                            <!-- End .ratings -->
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <!-- End .product-ratings -->
                                    </div>
                                    <!-- End .product-container -->
                                    <div class="price-box">
                                        <span class="product-price">$49.00</span>
                                    </div>
                                    <!-- End .price-box -->
                                </div>
                                <!-- End .product-details -->
                            </div>
                            <div class="product-default left-details product-widget ">
                                <figure>
                                    <a href="demo1-product.html">
                                        <img src="{{ asset('frontend/assets/images/demoes/demo1/products/small/product-8.jpg') }}" width="84" height="84" alt="product">
                                        <img src="{{ asset('frontend/assets/images/demoes/demo1/products/small/product-8-2.jpg') }}" width="84" height="84" alt="product">
                                    </a>
                                </figure>
                                <div class="product-details">
                                    <h3 class="product-title"> <a href="demo1-product.html">Casual Note Bag</a>
                                    </h3>
                                    <div class="ratings-container">
                                        <div class="product-ratings">
                                            <span class="ratings" style="width:100%"></span>
                                            <!-- End .ratings -->
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <!-- End .product-ratings -->
                                    </div>
                                    <!-- End .product-container -->
                                    <div class="price-box">
                                        <span class="product-price">$49.00</span>
                                    </div>
                                    <!-- End .price-box -->
                                </div>
                                <!-- End .product-details -->
                            </div>
                        </div>
                        <!-- End .product-column -->
                    </div>
                    <!-- End .col-md-4 -->

                    <div class="col-sm-6 col-md-4 pb-4 pb-md-0 appear-animate" data-animation-name="fadeInLeftShorter" data-animation-delay="800">
                        <div class="product-column">
                            <h3 class="section-sub-title ls-n-20">Latest Products</h3>

                            <div class="product-default left-details product-widget ">
                                <figure>
                                    <a href="demo1-product.html">
                                        <img src="{{ asset('frontend/assets/images/demoes/demo1/products/small/product-9.jpg') }}" width="84" height="84" alt="product">
                                        <img src="{{ asset('frontend/assets/images/demoes/demo1/products/small/product-9-2.jpg') }}" width="84" height="84" alt="product">
                                    </a>
                                </figure>
                                <div class="product-details">
                                    <h3 class="product-title"> <a href="demo1-product.html">Ultimate 3D
                                            Bluetooth Speaker</a> </h3>
                                    <div class="ratings-container">
                                        <div class="product-ratings">
                                            <span class="ratings" style="width:100%"></span>
                                            <!-- End .ratings -->
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <!-- End .product-ratings -->
                                    </div>
                                    <!-- End .product-container -->
                                    <div class="price-box">
                                        <span class="product-price">$49.00</span>
                                    </div>
                                    <!-- End .price-box -->
                                </div>
                                <!-- End .product-details -->
                            </div>
                            <div class="product-default left-details product-widget ">
                                <figure>
                                    <a href="demo1-product.html">
                                        <img src="{{ asset('frontend/assets/images/demoes/demo1/products/small/product-10.jpg') }}" width="84" height="84" alt="product">
                                        <img src="{{ asset('frontend/assets/images/demoes/demo1/products/small/product-10-2.jpg') }}" width="84" height="84" alt="product">
                                    </a>
                                </figure>
                                <div class="product-details">
                                    <h3 class="product-title"> <a href="demo1-product.html">Brown-Black Men
                                            Casual Glasses</a> </h3>
                                    <div class="ratings-container">
                                        <div class="product-ratings">
                                            <span class="ratings" style="width:100%"></span>
                                            <!-- End .ratings -->
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <!-- End .product-ratings -->
                                    </div>
                                    <!-- End .product-container -->
                                    <div class="price-box">
                                        <span class="product-price">$49.00</span>
                                    </div>
                                    <!-- End .price-box -->
                                </div>
                                <!-- End .product-details -->
                            </div>
                            <div class="product-default left-details product-widget ">
                                <figure>
                                    <a href="demo1-product.html">
                                        <img src="{{ asset('frontend/assets/images/demoes/demo1/products/small/product-11.jpg') }}" width="84" height="84" alt="product">
                                        <img src="{{ asset('frontend/assets/images/demoes/demo1/products/small/product-11-2.jpg') }}" width="84" height="84" alt="product">
                                    </a>
                                </figure>
                                <div class="product-details">
                                    <h3 class="product-title"> <a href="demo1-product.html">Brown-Black Men
                                            Casual Glasses</a> </h3>
                                    <div class="ratings-container">
                                        <div class="product-ratings">
                                            <span class="ratings" style="width:100%"></span>
                                            <!-- End .ratings -->
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <!-- End .product-ratings -->
                                    </div>
                                    <!-- End .product-container -->
                                    <div class="price-box">
                                        <span class="product-price">$49.00</span>
                                    </div>
                                    <!-- End .price-box -->
                                </div>
                                <!-- End .product-details -->
                            </div>
                        </div>
                        <!-- End .product-column -->
                    </div>
                    <!-- End .col-md-4 -->
                </div>
                <!-- End .row -->

                <hr class="mt-1 mb-3 pb-2">

                <div class="feature-boxes-container">
                    <div class="row">
                        <div class="col-md-4 appear-animate" data-animation-name="fadeInRightShorter" data-animation-delay="200">
                            <div class="feature-box  feature-box-simple text-center">
                                <i class="icon-earphones-alt"></i>

                                <div class="feature-box-content p-0">
                                    <h3 class="mb-0 pb-1">Customer Support</h3>
                                    <h5 class="mb-1 pb-1">Need Assistance?</h5>

                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum magna, et dapib.</p>
                                </div>
                                <!-- End .feature-box-content -->
                            </div>
                            <!-- End .feature-box -->
                        </div>
                        <!-- End .col-md-4 -->

                        <div class="col-md-4 appear-animate" data-animation-name="fadeInRightShorter" data-animation-delay="400">
                            <div class="feature-box feature-box-simple text-center">
                                <i class="icon-credit-card"></i>

                                <div class="feature-box-content p-0">
                                    <h3 class="mb-0 pb-1">Secured Payment</h3>
                                    <h5 class="mb-1 pb-1">Safe & Fast</h5>

                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum magna, et dapib.</p>
                                </div>
                                <!-- End .feature-box-content -->
                            </div>
                            <!-- End .feature-box -->
                        </div>
                        <!-- End .col-md-4 -->

                        <div class="col-md-4 appear-animate" data-animation-name="fadeInRightShorter" data-animation-delay="600">
                            <div class="feature-box feature-box-simple text-center">
                                <i class="icon-action-undo"></i>

                                <div class="feature-box-content p-0">
                                    <h3 class="mb-0 pb-1">Returns</h3>
                                    <h5 class="mb-1 pb-1">Easy & Free</h5>

                                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis nec vestibulum magna, et dapib.</p>
                                </div>
                                <!-- End .feature-box-content -->
                            </div>
                            <!-- End .feature-box -->
                        </div>
                        <!-- End .col-md-4 -->
                    </div>
                    <!-- End .row -->
                </div>
                <!-- End .feature-boxes-container -->
            </div>
            <!-- End .col-lg-9 -->

            <div class="sidebar-overlay"></div>
            <div class="sidebar-toggle custom-sidebar-toggle"><i class="fas fa-sliders-h"></i></div>
            <aside class="sidebar-home col-lg-3 order-lg-first mobile-sidebar">
                <div class="side-menu-wrapper text-uppercase mb-2 d-none d-lg-block">
                    <h2 class="side-menu-title bg-gray ls-n-25">Browse Categories</h2>

                    <nav class="side-nav">
                        <ul class="menu menu-vertical sf-arrows">
                            <li class="active"><a href="/"><i class="icon-home"></i>Home</a></li>
                            {{-- <li>
                                <a href="demo1-shop.html" class="sf-with-ul"><i
                                        class="sicon-badge"></i>Categories</a>
                                <div class="megamenu megamenu-fixed-width megamenu-3cols">
                                    <div class="row">
                                        <div class="col-lg-4">
                                            <a href="#" class="nolink pl-0">VARIATION 1</a>
                                            <ul class="submenu">
                                                <li><a href="category.html">Fullwidth Banner</a></li>
                                                <li><a href="category-banner-boxed-slider.html">Boxed Slider
                                                        Banner</a>
                                                </li>
                                                <li><a href="category-banner-boxed-image.html">Boxed Image
                                                        Banner</a>
                                                </li>
                                                <li><a href="demo1-shop.html">Left Sidebar</a></li>
                                                <li><a href="category-sidebar-right.html">Right Sidebar</a></li>
                                                <li><a href="category-off-canvas.html">Off Canvas Filter</a>
                                                </li>
                                                <li><a href="category-horizontal-filter1.html">Horizontal
                                                        Filter1</a>
                                                </li>
                                                <li><a href="category-horizontal-filter2.html">Horizontal
                                                        Filter2</a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-4">
                                            <a href="#" class="nolink pl-0">VARIATION 2</a>
                                            <ul class="submenu">
                                                <li><a href="category-list.html">List Types</a></li>
                                                <li><a href="category-infinite-scroll.html">Ajax Infinite
                                                        Scroll</a>
                                                </li>
                                                <li><a href="category.html">3 Columns Products</a></li>
                                                <li><a href="category-4col.html">4 Columns Products</a></li>
                                                <li><a href="category-5col.html">5 Columns Products</a></li>
                                                <li><a href="category-6col.html">6 Columns Products</a></li>
                                                <li><a href="category-7col.html">7 Columns Products</a></li>
                                                <li><a href="category-8col.html">8 Columns Products</a></li>
                                            </ul>
                                        </div>
                                        <div class="col-lg-4 p-0">
                                            <div class="menu-banner">
                                                <figure>
                                                    <img src="{{ asset('frontend/assets/images/menu-banner.jpg') }}" width="192" height="313" alt="Menu banner">
                                                </figure>
                                                <div class="banner-content">
                                                    <h4>
                                                        <span class="">UP TO</span><br />
                                                        <b class="">50%</b>
                                                        <i>OFF</i>
                                                    </h4>
                                                    <a href="demo1-shop.html" class="btn btn-sm btn-dark">SHOP
                                                        NOW</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- End .megamenu -->
                            </li> --}}

                @foreach ($categories as $category)
                    @php
                    $subCategories = App\Models\SubCategory::where('category_id', $category->id)->orderBy('subcategory_name','ASC')->get();
                    @endphp
                        <li>
                            <a href="#" class="sf-with-ul"><i class="{{ $category->category_icon }}"></i>{{ $category->category_name }}</a>
                        @if (!empty($subCategories))
                            <ul>
                            @foreach ($subCategories as $subCategory)
                                @php
                                $subSubCategories = App\Models\SuBSubCategory::where('subcategory_id', $subCategory->id)->orderBy('subsubcategory_name','ASC')->get();
                                @endphp
                                <li><a href="#">{{ $subCategory->subcategory_name }}</a>
                                    <ul>

                                    @foreach ($subSubCategories as $subSubCategory)
                                        <li><a href="blog.html">{{ $subSubCategory->subsubcategory_name }}</a></li>
                                    @endforeach
                                    </ul>
                                </li>
                            @endforeach
                            </ul>
                        @endif
                            
                            
                        </li>

                @endforeach

                        </ul>
                    </nav>
                </div>
                <!-- End .side-menu-container -->

                <div class="widget widget-banners px-3 pb-3 text-center">
                    <div class="owl-carousel owl-theme dots-small">
                        <div class="banner d-flex flex-column align-items-center">
                            <h3 class="badge-sale bg-primary d-flex flex-column align-items-center justify-content-center text-uppercase">
                                <em>Sale</em>Many Item
                            </h3>

                            <h4 class="sale-text text-uppercase"><small>UP
                                    TO</small>50<sup>%</sup><sub>off</sub></h4>
                            <p>Bags, Clothing, T-Shirts, Shoes, Watches and much more...</p>
                            <a href="demo1-shop.html" class="btn btn-dark btn-md">View Sale</a>
                        </div>
                        <!-- End .banner -->

                        <div class="banner banner4">
                            <figure>
                                <img src="{{ asset('frontend/assets/images/demoes/demo1/banners/banner-7.jpg') }}" alt="banner">
                            </figure>

                            <div class="banner-layer">
                                <div class="coupon-sale-content">
                                    <h4>DRONE + CAMERAS</h4>
                                    <h5 class="coupon-sale-text text-gray ls-n-10 p-0 font1"><i>UP
                                            TO</i><b class="text-white bg-dark font1">$100</b> OFF</h5>
                                    <p class="ls-0">Top Brands and Models!</p>
                                    <a href="demo1-shop.html" class="btn btn-inline-block btn-dark btn-black ls-0">VIEW
                                        SALE</a>
                                </div>
                            </div>
                        </div>
                        <!-- End .banner -->

                        <div class="banner banner5">
                            <h4>HEADPHONES SALE</h4>

                            <figure class="m-b-3">
                                <img src="{{ asset('frontend/assets/images/demoes/demo1/banners/banner-8.jpg') }}" alt="banner">
                            </figure>

                            <div class="banner-layer">
                                <div class="coupon-sale-content">
                                    <h5 class="coupon-sale-text ls-n-10 p-0 font1"><i>UP
                                            TO</i><b class="text-white bg-secondary font1">50%</b> OFF</h5>
                                    <a href="demo1-shop.html" class="btn btn-inline-block btn-dark btn-black ls-0">VIEW
                                        SALE</a>
                                </div>
                            </div>
                        </div>
                        <!-- End .banner -->
                    </div>
                    <!-- End .banner-slider -->
                </div>
                <!-- End .widget -->

                <div class="widget widget-newsletters bg-gray text-center">
                    <h3 class="widget-title text-uppercase m-b-3">Subscribe Newsletter</h3>
                    <p class="mb-2">Get all the latest information on Events, Sales and Offers. </p>
                    <form action="#">
                        <div class="form-group position-relative sicon-envolope-letter">
                            <input type="email" class="form-control" name="newsletter-email" placeholder="Email address">
                        </div>
                        <!-- Endd .form-group -->
                        <input type="submit" class="btn btn-primary btn-md" value="Subscribe">
                    </form>
                </div>
                <!-- End .widget -->

                <div class="widget widget-testimonials">
                    <div class="owl-carousel owl-theme dots-left dots-small">
                        <div class="testimonial">
                            <div class="testimonial-owner">
                                <figure>
                                    <img src="{{ asset('frontend/assets/images/clients/client-1.jpg') }}" alt="client">
                                </figure>

                                <div>
                                    <h4 class="testimonial-title">john Smith</h4>
                                    <span>CEO &amp; Founder</span>
                                </div>
                            </div>
                            <!-- End .testimonial-owner -->

                            <blockquote class="ml-4 pr-0">
                                <p>Lorem ipsum dolor sit amet, consectetur elitad adipiscing Cras non placerat mi.
                                </p>
                            </blockquote>
                        </div>
                        <!-- End .testimonial -->

                        <div class="testimonial">
                            <div class="testimonial-owner">
                                <figure>
                                    <img src="{{ asset('frontend/assets/images/clients/client-2.jpg') }}" alt="client">
                                </figure>

                                <div>
                                    <h4 class="testimonial-title">Dae Smith</h4>
                                    <span>CEO &amp; Founder</span>
                                </div>
                            </div>
                            <!-- End .testimonial-owner -->

                            <blockquote class="ml-4 pr-0">
                                <p>Lorem ipsum dolor sit amet, consectetur elitad adipiscing Cras non placerat mi.
                                </p>
                            </blockquote>
                        </div>
                        <!-- End .testimonial -->

                        <div class="testimonial">
                            <div class="testimonial-owner">
                                <figure>
                                    <img src="{{ asset('frontend/assets/images/clients/client-3.jpg') }}" alt="client">
                                </figure>

                                <div>
                                    <h4 class="testimonial-title">John Doe</h4>
                                    <span>CEO &amp; Founder</span>
                                </div>
                            </div>
                            <!-- End .testimonial-owner -->

                            <blockquote class="ml-4 pr-0">
                                <p>Lorem ipsum dolor sit amet, consectetur elitad adipiscing Cras non placerat mi.
                                </p>
                            </blockquote>
                        </div>
                        <!-- End .testimonial -->
                    </div>
                    <!-- End .testimonials-slider -->
                </div>
                <!-- End .widget -->

                <div class="widget widget-posts post-date-in-media media-with-zoom mb-0 mb-lg-2 pb-lg-2">
                    <div class="owl-carousel owl-theme dots-left dots-m-0 dots-small" data-owl-options="
                        { 'margin' : 20,
                          'loop': false }">
                        <article class="post">
                            <div class="post-media">
                                <a href="single.html">
                                    <img src="{{ asset('frontend/assets/images/blog/home/post-1.jpg') }}" data-zoom-image="{{ asset('frontend/assets/images/blog/home/post-1.jpg') }}" width="280" height="209" alt="Post">
                                </a>
                                <div class="post-date">
                                    <span class="day">29</span>
                                    <span class="month">Jun</span>
                                </div>
                                <!-- End .post-date -->

                                <span class="prod-full-screen">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                            <!-- End .post-media -->

                            <div class="post-body">
                                <h2 class="post-title">
                                    <a href="single.html">Post Format Standard</a>
                                </h2>

                                <div class="post-content">
                                    <p>Leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with... </p>

                                    <a href="single.html" class="read-more">read more <i
                                            class="icon-right-open"></i></a>
                                </div>
                                <!-- End .post-content -->
                            </div>
                            <!-- End .post-body -->
                        </article>

                        <article class="post">
                            <div class="post-media">
                                <a href="single.html">
                                    <img src="{{ asset('frontend/assets/images/blog/home/post-2.jpg') }}" data-zoom-image="{{ asset('frontend/assets/images/blog/home/post-2.jpg') }}" width="280" height="209" alt="Post">
                                </a>
                                <div class="post-date">
                                    <span class="day">29</span>
                                    <span class="month">Jun</span>
                                </div>
                                <!-- End .post-date -->
                                <span class="prod-full-screen">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                            <!-- End .post-media -->

                            <div class="post-body">
                                <h2 class="post-title">
                                    <a href="single.html">Fashion Trends</a>
                                </h2>

                                <div class="post-content">
                                    <p>Leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with... </p>

                                    <a href="single.html" class="read-more">read more <i
                                            class="icon-right-open"></i></a>
                                </div>
                                <!-- End .post-content -->
                            </div>
                            <!-- End .post-body -->
                        </article>

                        <article class="post">
                            <div class="post-media">
                                <a href="single.html">
                                    <img src="{{ asset('frontend/assets/images/blog/home/post-3.jpg') }}" data-zoom-image="{{ asset('frontend/assets/images/blog/home/post-3.jpg') }}" width="280" height="209" alt="Post">
                                </a>
                                <div class="post-date">
                                    <span class="day">29</span>
                                    <span class="month">Jun</span>
                                </div>
                                <!-- End .post-date -->
                                <span class="prod-full-screen">
                                    <i class="fas fa-search"></i>
                                </span>
                            </div>
                            <!-- End .post-media -->

                            <div class="post-body">
                                <h2 class="post-title">
                                    <a href="single.html">
                                        Post Format Video</a>
                                </h2>

                                <div class="post-content">
                                    <p>Leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with... </p>

                                    <a href="single.html" class="read-more">read more <i
                                            class="icon-right-open"></i></a>
                                </div>
                                <!-- End .post-content -->
                            </div>
                            <!-- End .post-body -->
                        </article>
                    </div>
                    <!-- End .posts-slider -->
                </div>
                <!-- End .widget -->
            </aside>
            <!-- End .col-lg-3 -->
        </div>
        <!-- End .row -->
    </div>
    <!-- End .container -->
</main>
@include('frontend.body.newsletter_popup')
@endsection