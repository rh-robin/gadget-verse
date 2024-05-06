@extends('frontend.main_master')
@section('title')
{{ $product->product_name }}
@endsection
@section('content')

@section('content')
<main class="main">

    @php
        $variations = $product->variations;
    @endphp


    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="demo4.html"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="#">Products</a></li>
            </ol>
        </nav>

        <div class="product-single-container product-single-default">
            <div class="cart-message d-none">
                <strong class="single-cart-notice">{{ $product->product_name }}</strong>
                <span>has been added to your cart.</span>
            </div>

            <div class="row">
                <div class="col-lg-5 col-md-6 product-single-gallery">
                    <div class="product-slider-container">
                        <div class="label-group">
                            <div class="product-label label-hot">HOT</div>

                            <div class="product-label label-sale">
                                -16%
                            </div>
                        </div>

                        <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                            <div class="product-item">
                                <img class="product-single-image"
                                    src="{{ asset($product->product_thumbnail) }}"
                                    data-zoom-image="{{ asset($product->product_thumbnail) }}" width="468"
                                    height="468" alt="product" />
                            </div>
                    @foreach ($variations as $variation)
                        @php
                            $images = $variation->images;
                        @endphp
                        @foreach ($images as $image)
                            <div class="product-item">
                                <img class="product-single-image"
                                    src="{{ asset($image->image_source) }}"
                                    data-zoom-image="{{ asset($image->image_source) }}" width="468"
                                    height="468" alt="product" />
                            </div>
                        @endforeach
                    @endforeach
                        </div>
                        <!-- End .product-single-carousel -->

                        <span class="prod-full-screen">
                            <i class="icon-plus"></i>
                        </span>
                    </div>
                    

                    <div class="prod-thumbnail owl-dots" id="owlDots">
                        <div class="owl-dot">
                            <img src="{{ asset($product->product_thumbnail) }}" width="110" height="110"
                                alt="product-thumbnail" />
                        </div>

                    @foreach ($variations as $variation)
                        @php
                            $images = $variation->images;
                        @endphp
                        @foreach ($images as $image)

                        <div class="owl-dot">
                            <img src="{{ asset($image->image_source) }}" width="110" height="110"
                                alt="product-thumbnail" />
                        </div>

                        @endforeach
                    @endforeach
                        
                    </div>
                </div><!-- End .product-single-gallery -->

                <div class="col-lg-7 col-md-6 product-single-details">
                    <h1 class="product-title">{{ $product->product_name }}</h1>

                    

                    <div class="ratings-container">
                        <div class="product-ratings">
                            <span class="ratings" style="width:60%"></span><!-- End .ratings -->
                            <span class="tooltiptext tooltip-top"></span>
                        </div><!-- End .product-ratings -->

                        <a href="#" class="rating-link">( 6 Reviews )</a>
                    </div><!-- End .ratings-container -->

                    <hr class="short-divider">
                    @php
                        $lowestSellingPrice = $product->variations()->min('selling_price');
                        $highestSellingPrice = $product->variations()->max('selling_price');
                        $lowestDiscountPrice = $product->variations()->min('discount_price');
                        $highestDiscountPrice = $product->variations()->max('discount_price');

                        $lowestPrice = 0;
                        $highestPrice = 0;
                        if ($lowestDiscountPrice>0) {
                            $lowestPrice = $lowestDiscountPrice;
                        }else{
                            $lowestPrice = $lowestSellingPrice;
                        }
                        if ($highestDiscountPrice>0) {
                            $highestPrice = $highestDiscountPrice;
                        }

                    @endphp
                    <div class="price-box">
                        @if ($lowestPrice == $highestPrice || $highestPrice==0)
                            <span class="product-price"> {{ $lowestPrice }}tk</span>
                        @else
                            <span class="product-price">{{ $lowestPrice }}tk &ndash;</span>
                            <span class="product-price"> {{ $highestPrice }}tk</span>
                        @endif
                        
                    </div><!-- End .price-box -->

                    <div class="product-desc">
                        <p>
                            {{ $product->short_desc }}
                        </p>
                    </div><!-- End .product-desc -->

                    <ul class="single-info-list">

                        <li>
                            SKU: <strong>{{ $product->product_sku }}</strong>
                        </li>

                        <li>
                            CATEGORY: <strong><a href="#" class="product-category">{{ $product->category->category_name }}</a></strong>
                        </li>

                        <li>
                            @php
                               $tags = explode(",", $product->product_tags);
                            @endphp
                            TAGs: 
                            @foreach ($tags as $tag)
                            <strong><a href="#" class="product-category">{{ $tag}} , </a></strong>
                            @endforeach
                            
                        </li>
                    </ul>

                    @php
                        $sizes = [];
                        $colors = [];
                        foreach ($variations as $variation) {
                            // Check if the size exists in the $colors array
                            $sizeExists = false;
                            foreach ($sizes as $size) {
                                if ($size === $variation->size) {
                                    $sizeExists = true;
                                    break;
                                }
                            }
                            // If the color is not found, add it to the $colors array
                            if (!$sizeExists) {
                                $sizes[] = $variation->size;
                            }

                            // Check if the color exists in the $colors array
                            $colorExists = false;
                            foreach ($colors as $color) {
                                if ($color['color_name'] === $variation->color_name && $color['color_code'] === $variation->color_code) {
                                    $colorExists = true;
                                    break;
                                }
                            }
                            // If the color is not found, add it to the $colors array
                            if (!$colorExists) {
                                $colors[] = [
                                    'color_name' => $variation->color_name,
                                    'color_code' => $variation->color_code
                                ];
                            }
                        }
                    @endphp

                    <div class="product-filters-container">
                        <div class="filter_color d-flex ">
                            <h4 class="pr-2" style="margin-bottom:0; font-size:16px;">Colors: </h4>
                            @foreach ($colors as $color)
    
                            <div class="d-flex pr-5" >
                                <div class="pr-3">
                                    <input type="checkbox" id="color{{ $loop->index }}" name="color" onclick="colorCheckbox(this)" value="{{ $color['color_name'] }}">
                                    <label class="text-capitalize" for="color{{ $loop->index }}" style="font-weight: 400; font-size:16px;">{{ $color['color_name'] }}</label>
                                </div>
                                <div class="" style="width: 20px; height:20px; background-color:{{$color['color_name']}}"></div>
                            </div>
    
                            @endforeach
                            
                        </div>
                        <div class="filter_color d-flex">
                            <h4 class="pr-2" style="margin-bottom:0; font-size:16px;">Sizes: </h4>
                            @foreach ($sizes as $size)
    
                            <div class="pr-5" >
                                <div class="">
                                    <input type="checkbox" id="size{{ $loop->index }}" name="size" onclick="sizeCheckbox(this)" value="{{ $size }}">
                                    <label class="text-capitalize" for="size{{ $loop->index }}" style="font-weight: 400; font-size:16px;">{{ $size }}</label>
                                </div>
                            </div>
    
                            @endforeach
                            
                        </div>
                        <div class=" d-none" id="clearButtonContainer">
                            <label></label>
                            <a class="font1 text-uppercase clear-btn" href="#" onclick="clearSelection(event)">Clear</a>
                        </div>
                    </div>


            {{-- kkkkkkkkkkkkkkkkkkkkkkkkkkkkkkllllllllllllllk --}}

                    

                    <div class="product-action">
                        <div class="price-box product-filtered-price d-none" id="priceBox">
                        </div>
                        <div class="product-single-qty">
                            <input class="horizontal-quantity form-control" type="text">
                        </div><!-- End .product-single-qty -->

                        <a href="javascript:;" class="btn btn-dark add-cart mr-2" title="Add to Cart">Add to
                            Cart</a>

                        <a href="cart.html" class="btn btn-gray view-cart d-none">View cart</a>
                    </div><!-- End .product-action -->

                    <hr class="divider mb-0 mt-0">

                    <div class="product-single-share mb-3">
                        <label class="sr-only">Share:</label>

                        <div class="social-icons mr-2">
                            <a href="#" class="social-icon social-facebook icon-facebook" target="_blank"
                                title="Facebook"></a>
                            <a href="#" class="social-icon social-twitter icon-twitter" target="_blank"
                                title="Twitter"></a>
                            <a href="#" class="social-icon social-linkedin fab fa-linkedin-in" target="_blank"
                                title="Linkedin"></a>
                            <a href="#" class="social-icon social-gplus fab fa-google-plus-g" target="_blank"
                                title="Google +"></a>
                            <a href="#" class="social-icon social-mail icon-mail-alt" target="_blank"
                                title="Mail"></a>
                        </div><!-- End .social-icons -->

                        <a href="wishlist.html" class="btn-icon-wish add-wishlist" title="Add to Wishlist"><i
                                class="icon-wishlist-2"></i><span>Add to
                                Wishlist</span></a>
                    </div><!-- End .product single-share -->
                </div><!-- End .product-single-details -->
            </div><!-- End .row -->
        </div><!-- End .product-single-container -->

        <div class="product-single-tabs">
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="product-tab-desc" data-toggle="tab"
                        href="#product-desc-content" role="tab" aria-controls="product-desc-content"
                        aria-selected="true">Description</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="product-tab-size" data-toggle="tab" href="#product-size-content"
                        role="tab" aria-controls="product-size-content" aria-selected="true">Size Guide</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="product-tab-tags" data-toggle="tab" href="#product-tags-content"
                        role="tab" aria-controls="product-tags-content" aria-selected="false">Additional
                        Information</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" id="product-tab-reviews" data-toggle="tab"
                        href="#product-reviews-content" role="tab" aria-controls="product-reviews-content"
                        aria-selected="false">Reviews (1)</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel"
                    aria-labelledby="product-tab-desc">
                    <div class="product-desc-content">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor
                            incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, nostrud ipsum
                            consectetur sed do, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea
                            commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                            cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat.</p>
                        <ul>
                            <li>Any Product types that You want - Simple,
                                Configurable</li>
                            <li>Downloadable/Digital Products, Virtual
                                Products</li>
                            <li>Inventory Management with Backordered items
                            </li>
                        </ul>
                        <p>Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim
                            veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                            consequat. </p>
                    </div><!-- End .product-desc-content -->
                </div><!-- End .tab-pane -->

                <div class="tab-pane fade" id="product-size-content" role="tabpanel"
                    aria-labelledby="product-tab-size">
                    <div class="product-size-content">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="{{ asset('assets/images/products/single/body-shape.png') }}" alt="body shape"
                                    width="217" height="398">
                            </div><!-- End .col-md-4 -->

                            <div class="col-md-8">
                                <table class="table table-size">
                                    <thead>
                                        <tr>
                                            <th>SIZE</th>
                                            <th>CHEST(in.)</th>
                                            <th>WAIST(in.)</th>
                                            <th>HIPS(in.)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>XS</td>
                                            <td>34-36</td>
                                            <td>27-29</td>
                                            <td>34.5-36.5</td>
                                        </tr>
                                        <tr>
                                            <td>S</td>
                                            <td>36-38</td>
                                            <td>29-31</td>
                                            <td>36.5-38.5</td>
                                        </tr>
                                        <tr>
                                            <td>M</td>
                                            <td>38-40</td>
                                            <td>31-33</td>
                                            <td>38.5-40.5</td>
                                        </tr>
                                        <tr>
                                            <td>L</td>
                                            <td>40-42</td>
                                            <td>33-36</td>
                                            <td>40.5-43.5</td>
                                        </tr>
                                        <tr>
                                            <td>XL</td>
                                            <td>42-45</td>
                                            <td>36-40</td>
                                            <td>43.5-47.5</td>
                                        </tr>
                                        <tr>
                                            <td>XXL</td>
                                            <td>45-48</td>
                                            <td>40-44</td>
                                            <td>47.5-51.5</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div><!-- End .row -->
                    </div><!-- End .product-size-content -->
                </div><!-- End .tab-pane -->

                <div class="tab-pane fade" id="product-tags-content" role="tabpanel"
                    aria-labelledby="product-tab-tags">
                    <table class="table table-striped mt-2">
                        <tbody>
                            <tr>
                                <th>Weight</th>
                                <td>23 kg</td>
                            </tr>

                            <tr>
                                <th>Dimensions</th>
                                <td>12 × 24 × 35 cm</td>
                            </tr>

                            <tr>
                                <th>Color</th>
                                <td>Black, Green, Indigo</td>
                            </tr>

                            <tr>
                                <th>Size</th>
                                <td>Large, Medium, Small</td>
                            </tr>
                        </tbody>
                    </table>
                </div><!-- End .tab-pane -->

                <div class="tab-pane fade" id="product-reviews-content" role="tabpanel"
                    aria-labelledby="product-tab-reviews">
                    <div class="product-reviews-content">
                        <h3 class="reviews-title">1 review for Men Black Sports Shoes</h3>

                        <div class="comment-list">
                            <div class="comments">
                                <figure class="img-thumbnail">
                                    <img src="{{ asset('assets/images/blog/author.jpg') }}" alt="author" width="80"
                                        height="80">
                                </figure>

                                <div class="comment-block">
                                    <div class="comment-header">
                                        <div class="comment-arrow"></div>

                                        <div class="ratings-container float-sm-right">
                                            <div class="product-ratings">
                                                <span class="ratings" style="width:60%"></span>
                                                <!-- End .ratings -->
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div><!-- End .product-ratings -->
                                        </div>

                                        <span class="comment-by">
                                            <strong>Joe Doe</strong> – April 12, 2018
                                        </span>
                                    </div>

                                    <div class="comment-content">
                                        <p>Excellent.</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="divider"></div>

                        <div class="add-product-review">
                            <h3 class="review-title">Add a review</h3>

                            <form action="#" class="comment-form m-0">
                                <div class="rating-form">
                                    <label for="rating">Your rating <span class="required">*</span></label>
                                    <span class="rating-stars">
                                        <a class="star-1" href="#">1</a>
                                        <a class="star-2" href="#">2</a>
                                        <a class="star-3" href="#">3</a>
                                        <a class="star-4" href="#">4</a>
                                        <a class="star-5" href="#">5</a>
                                    </span>

                                    <select name="rating" id="rating" required="" style="display: none;">
                                        <option value="">Rate…</option>
                                        <option value="5">Perfect</option>
                                        <option value="4">Good</option>
                                        <option value="3">Average</option>
                                        <option value="2">Not that bad</option>
                                        <option value="1">Very poor</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Your review <span class="required">*</span></label>
                                    <textarea cols="5" rows="6" class="form-control form-control-sm"></textarea>
                                </div><!-- End .form-group -->


                                <div class="row">
                                    <div class="col-md-6 col-xl-12">
                                        <div class="form-group">
                                            <label>Name <span class="required">*</span></label>
                                            <input type="text" class="form-control form-control-sm" required>
                                        </div><!-- End .form-group -->
                                    </div>

                                    <div class="col-md-6 col-xl-12">
                                        <div class="form-group">
                                            <label>Email <span class="required">*</span></label>
                                            <input type="text" class="form-control form-control-sm" required>
                                        </div><!-- End .form-group -->
                                    </div>

                                    <div class="col-md-12">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input"
                                                id="save-name" />
                                            <label class="custom-control-label mb-0" for="save-name">Save my
                                                name, email, and website in this browser for the next time I
                                                comment.</label>
                                        </div>
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-primary" value="Submit">
                            </form>
                        </div><!-- End .add-product-review -->
                    </div><!-- End .product-reviews-content -->
                </div><!-- End .tab-pane -->
            </div><!-- End .tab-content -->
        </div><!-- End .product-single-tabs -->

        <div class="products-section pt-0">
            <h2 class="section-title">Related Products</h2>

            <div class="products-slider owl-carousel owl-theme dots-top dots-small">
                <div class="product-default">
                    <figure>
                        <a href="product.html">
                            <img src="{{ asset('assets/images/products/product-1.jpg') }}" width="280" height="280"
                                alt="product">
                            <img src="{{ asset('assets/images/products/product-1-2.jpg') }}" width="280" height="280"
                                alt="product">
                        </a>
                        <div class="label-group">
                            <div class="product-label label-hot">HOT</div>
                            <div class="product-label label-sale">-20%</div>
                        </div>
                    </figure>
                    <div class="product-details">
                        <div class="category-list">
                            <a href="category.html" class="product-category">Category</a>
                        </div>
                        <h3 class="product-title">
                            <a href="product.html">Ultimate 3D Bluetooth Speaker</a>
                        </h3>
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:80%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <div class="price-box">
                            <del class="old-price">$59.00</del>
                            <span class="product-price">$49.00</span>
                        </div><!-- End .price-box -->
                        <div class="product-action">
                            <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i
                                    class="icon-heart"></i></a>
                            <a href="product.html" class="btn-icon btn-add-cart"><i
                                    class="fa fa-arrow-right"></i><span>SELECT
                                    OPTIONS</span></a>
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i
                                    class="fas fa-external-link-alt"></i></a>
                        </div>
                    </div><!-- End .product-details -->
                </div>

                <div class="product-default">
                    <figure>
                        <a href="product.html">
                            <img src="{{ asset('assets/images/products/product-3.jpg') }}" width="280" height="280"
                                alt="product">
                            <img src="{{ asset('assets/images/products/product-3-2.jpg') }}" width="280" height="280"
                                alt="product">
                        </a>
                        <div class="label-group">
                            <div class="product-label label-hot">HOT</div>
                            <div class="product-label label-sale">-20%</div>
                        </div>
                    </figure>
                    <div class="product-details">
                        <div class="category-list">
                            <a href="category.html" class="product-category">Category</a>
                        </div>
                        <h3 class="product-title">
                            <a href="product.html">Circled Ultimate 3D Speaker</a>
                        </h3>
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:80%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <div class="price-box">
                            <del class="old-price">$59.00</del>
                            <span class="product-price">$49.00</span>
                        </div><!-- End .price-box -->
                        <div class="product-action">
                            <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i
                                    class="icon-heart"></i></a>
                            <a href="product.html" class="btn-icon btn-add-cart"><i
                                    class="fa fa-arrow-right"></i><span>SELECT
                                    OPTIONS</span></a>
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i
                                    class="fas fa-external-link-alt"></i></a>
                        </div>
                    </div><!-- End .product-details -->
                </div>

                <div class="product-default">
                    <figure>
                        <a href="product.html">
                            <img src="{{ asset('assets/images/products/product-7.jpg') }}" width="280" height="280"
                                alt="product">
                            <img src="{{ asset('assets/images/products/product-7-2.jpg') }}" width="280" height="280"
                                alt="product">
                        </a>
                        <div class="label-group">
                            <div class="product-label label-hot">HOT</div>
                            <div class="product-label label-sale">-20%</div>
                        </div>
                    </figure>
                    <div class="product-details">
                        <div class="category-list">
                            <a href="category.html" class="product-category">Category</a>
                        </div>
                        <h3 class="product-title">
                            <a href="product.html">Brown-Black Men Casual Glasses</a>
                        </h3>
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:80%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <div class="price-box">
                            <del class="old-price">$59.00</del>
                            <span class="product-price">$49.00</span>
                        </div><!-- End .price-box -->
                        <div class="product-action">
                            <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i
                                    class="icon-heart"></i></a>
                            <a href="product.html" class="btn-icon btn-add-cart"><i
                                    class="fa fa-arrow-right"></i><span>SELECT
                                    OPTIONS</span></a>
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i
                                    class="fas fa-external-link-alt"></i></a>
                        </div>
                    </div><!-- End .product-details -->
                </div>

                <div class="product-default">
                    <figure>
                        <a href="product.html">
                            <img src="{{ asset('assets/images/products/product-6.jpg') }}" width="280" height="280"
                                alt="product">
                            <img src="{{ asset('assets/images/products/product-6-2.jpg') }}" width="280" height="280"
                                alt="product">
                        </a>
                        <div class="label-group">
                            <div class="product-label label-hot">HOT</div>
                            <div class="product-label label-sale">-20%</div>
                        </div>
                    </figure>
                    <div class="product-details">
                        <div class="category-list">
                            <a href="category.html" class="product-category">Category</a>
                        </div>
                        <h3 class="product-title">
                            <a href="product.html">Men Black Gentle Belt</a>
                        </h3>
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:80%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <div class="price-box">
                            <del class="old-price">$59.00</del>
                            <span class="product-price">$49.00</span>
                        </div><!-- End .price-box -->
                        <div class="product-action">
                            <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i
                                    class="icon-heart"></i></a>
                            <a href="product.html" class="btn-icon btn-add-cart"><i
                                    class="fa fa-arrow-right"></i><span>SELECT
                                    OPTIONS</span></a>
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i
                                    class="fas fa-external-link-alt"></i></a>
                        </div>
                    </div><!-- End .product-details -->
                </div>

                <div class="product-default">
                    <figure>
                        <a href="product.html">
                            <img src="{{ asset('assets/images/products/product-4.jpg') }}" width="280" height="280"
                                alt="product">
                            <img src="{{ asset('assets/images/products/product-4-2.jpg') }}" width="280" height="280"
                                alt="product">
                        </a>
                        <div class="label-group">
                            <div class="product-label label-hot">HOT</div>
                            <div class="product-label label-sale">-20%</div>
                        </div>
                    </figure>
                    <div class="product-details">
                        <div class="category-list">
                            <a href="category.html" class="product-category">Category</a>
                        </div>
                        <h3 class="product-title">
                            <a href="product.html">Blue Backpack for the Young - S</a>
                        </h3>
                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:80%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->
                        <div class="price-box">
                            <del class="old-price">$59.00</del>
                            <span class="product-price">$49.00</span>
                        </div><!-- End .price-box -->
                        <div class="product-action">
                            <a href="wishlist.html" title="Wishlist" class="btn-icon-wish"><i
                                    class="icon-heart"></i></a>
                            <a href="product.html" class="btn-icon btn-add-cart"><i
                                    class="fa fa-arrow-right"></i><span>SELECT
                                    OPTIONS</span></a>
                            <a href="ajax/product-quick-view.html" class="btn-quickview" title="Quick View"><i
                                    class="fas fa-external-link-alt"></i></a>
                        </div>
                    </div><!-- End .product-details -->
                </div>
            </div><!-- End .products-slider -->
        </div><!-- End .products-section -->

        <hr class="mt-0 m-b-5" />

        <div class="product-widgets-container row pb-2">
            <div class="col-lg-3 col-sm-6 pb-5 pb-md-0">
                <h4 class="section-sub-title">Featured Products</h4>
                <div class="product-default left-details product-widget">
                    <figure>
                        <a href="product.html">
                            <img src="{{ asset('assets/images/products/small/product-1.jpg') }}" width="74" height="74"
                                alt="product">
                            <img src="{{ asset('assets/images/products/small/product-1-2.jpg') }}" width="74" height="74"
                                alt="product">
                        </a>
                    </figure>

                    <div class="product-details">
                        <h3 class="product-title"> <a href="product.html">Ultimate 3D Bluetooth Speaker</a>
                        </h3>

                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->

                        <div class="price-box">
                            <span class="product-price">$49.00</span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>

                <div class="product-default left-details product-widget">
                    <figure>
                        <a href="product.html">
                            <img src="{{ asset('assets/images/products/small/product-2.jpg') }}" width="74" height="74"
                                alt="product">
                            <img src="{{ asset('assets/images/products/small/product-2-2.jpg') }}" width="74" height="74"
                                alt="product">
                        </a>
                    </figure>

                    <div class="product-details">
                        <h3 class="product-title"> <a href="product.html">Brown Women Casual HandBag</a> </h3>

                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top">5.00</span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->

                        <div class="price-box">
                            <span class="product-price">$49.00</span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>

                <div class="product-default left-details product-widget">
                    <figure>
                        <a href="product.html">
                            <img src="{{ asset('assets/images/products/small/product-3.jpg') }}" width="74" height="74"
                                alt="product">
                            <img src="{{ asset('assets/images/products/small/product-3-2.jpg') }}" width="74" height="74"
                                alt="product">
                        </a>
                    </figure>

                    <div class="product-details">
                        <h3 class="product-title"> <a href="product.html">Circled Ultimate 3D Speaker</a> </h3>

                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->

                        <div class="price-box">
                            <span class="product-price">$49.00</span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 pb-5 pb-md-0">
                <h4 class="section-sub-title">Best Selling Products</h4>
                <div class="product-default left-details product-widget">
                    <figure>
                        <a href="product.html">
                            <img src="{{ asset('assets/images/products/small/product-4.jpg') }}" width="74" height="74"
                                alt="product">
                            <img src="{{ asset('assets/images/products/small/product-4-2.jpg') }}" width="74" height="74"
                                alt="product">
                        </a>
                    </figure>

                    <div class="product-details">
                        <h3 class="product-title"> <a href="product.html">Blue Backpack for the Young - S</a>
                        </h3>

                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top">5.00</span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->

                        <div class="price-box">
                            <span class="product-price">$49.00</span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>

                <div class="product-default left-details product-widget">
                    <figure>
                        <a href="product.html">
                            <img src="{{ asset('assets/images/products/small/product-5.jpg') }}" width="74" height="74"
                                alt="product">
                            <img src="{{ asset('assets/images/products/small/product-5-2.jpg') }}" width="74" height="74"
                                alt="product">
                        </a>
                    </figure>

                    <div class="product-details">
                        <h3 class="product-title"> <a href="product.html">Casual Spring Blue Shoes</a> </h3>

                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->

                        <div class="price-box">
                            <span class="product-price">$49.00</span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>

                <div class="product-default left-details product-widget">
                    <figure>
                        <a href="product.html">
                            <img src="{{ asset('assets/images/products/small/product-6.jpg') }}" width="74" height="74"
                                alt="product">
                            <img src="{{ asset('assets/images/products/small/product-6-2.jpg') }}" width="74" height="74"
                                alt="product">
                        </a>
                    </figure>

                    <div class="product-details">
                        <h3 class="product-title"> <a href="product.html">Men Black Gentle Belt</a> </h3>

                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top">5.00</span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->

                        <div class="price-box">
                            <span class="product-price">$49.00</span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 pb-5 pb-md-0">
                <h4 class="section-sub-title">Latest Products</h4>
                <div class="product-default left-details product-widget">
                    <figure>
                        <a href="product.html">
                            <img src="{{ asset('assets/images/products/small/product-7.jpg') }}" width="74" height="74"
                                alt="product">
                            <img src="{{ asset('assets/images/products/small/product-7-2.jpg') }}" width="74" height="74"
                                alt="product">
                        </a>
                    </figure>

                    <div class="product-details">
                        <h3 class="product-title"> <a href="product.html">Men Black Sports Shoes</a> </h3>

                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->

                        <div class="price-box">
                            <span class="product-price">$49.00</span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>

                <div class="product-default left-details product-widget">
                    <figure>
                        <a href="product.html">
                            <img src="{{ asset('assets/images/products/small/product-8.jpg') }}" width="74" height="74"
                                alt="product">
                            <img src="{{ asset('assets/images/products/small/product-8-2.jpg') }}" width="74" height="74"
                                alt="product">
                        </a>
                    </figure>

                    <div class="product-details">
                        <h3 class="product-title"> <a href="product.html">Brown-Black Men Casual Glasses</a>
                        </h3>

                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top">5.00</span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->

                        <div class="price-box">
                            <span class="product-price">$49.00</span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>

                <div class="product-default left-details product-widget">
                    <figure>
                        <a href="product.html">
                            <img src="{{ asset('assets/images/products/small/product-9.jpg') }}" width="74" height="74"
                                alt="product">
                            <img src="{{ asset('assets/images/products/small/product-9-2.jpg') }}" width="74" height="74"
                                alt="product">
                        </a>
                    </figure>

                    <div class="product-details">
                        <h3 class="product-title"> <a href="product.html">Black Men Casual Glasses</a> </h3>

                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->

                        <div class="price-box">
                            <span class="product-price">$49.00</span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>
            </div>

            <div class="col-lg-3 col-sm-6 pb-5 pb-md-0">
                <h4 class="section-sub-title">Top Rated Products</h4>
                <div class="product-default left-details product-widget">
                    <figure>
                        <a href="product.html">
                            <img src="{{ asset('assets/images/products/small/product-10.jpg') }}" width="74" height="74"
                                alt="product">
                            <img src="{{ asset('assets/images/products/small/product-10-2.jpg') }}" width="74" height="74"
                                alt="product">
                        </a>
                    </figure>

                    <div class="product-details">
                        <h3 class="product-title"> <a href="product.html">Basketball Sports Blue Shoes</a> </h3>

                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->

                        <div class="price-box">
                            <span class="product-price">$49.00</span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>

                <div class="product-default left-details product-widget">
                    <figure>
                        <a href="product.html">
                            <img src="{{ asset('assets/images/products/small/product-11.jpg') }}" width="74" height="74"
                                alt="product">
                            <img src="{{ asset('assets/images/products/small/product-11-2.jpg') }}" width="74" height="74"
                                alt="product">
                        </a>
                    </figure>

                    <div class="product-details">
                        <h3 class="product-title"> <a href="product.html">Men Sports Travel Bag</a> </h3>

                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top">5.00</span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->

                        <div class="price-box">
                            <span class="product-price">$49.00</span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>

                <div class="product-default left-details product-widget">
                    <figure>
                        <a href="product.html">
                            <img src="{{ asset('assets/images/products/small/product-12.jpg') }}" width="74" height="74"
                                alt="product">
                            <img src="{{ asset('assets/images/products/small/product-12-2.jpg') }}" width="74" height="74"
                                alt="product">
                        </a>
                    </figure>

                    <div class="product-details">
                        <h3 class="product-title"> <a href="product.html">Brown HandBag</a> </h3>

                        <div class="ratings-container">
                            <div class="product-ratings">
                                <span class="ratings" style="width:100%"></span><!-- End .ratings -->
                                <span class="tooltiptext tooltip-top"></span>
                            </div><!-- End .product-ratings -->
                        </div><!-- End .product-container -->

                        <div class="price-box">
                            <span class="product-price">$49.00</span>
                        </div><!-- End .price-box -->
                    </div><!-- End .product-details -->
                </div>
            </div>
        </div><!-- End .row -->
    </div><!-- End .container -->
</main><!-- End .main -->
{{-- <div class="owl-item active"></div> --}}

{{-- handle color and size checkbox --}}
<script>
    function colorCheckbox(clickedCheckbox) {
        // Get the ID of the clicked checkbox
        var clickedCheckboxId = clickedCheckbox.id;

        // Uncheck all checkboxes with name 'color' except the clicked one
        var checkboxes = document.getElementsByName('color');
        checkboxes.forEach(function(checkbox) {
            if (checkbox.id !== clickedCheckboxId) {
                checkbox.checked = false;
            }
        });
        checkSelection();
    }

    function sizeCheckbox(clickedCheckbox) {
        // Get the ID of the clicked checkbox
        var clickedCheckboxId = clickedCheckbox.id;

        // Uncheck all checkboxes with name 'size' except the clicked one
        var checkboxes = document.getElementsByName('size');
        checkboxes.forEach(function(checkbox) {
            if (checkbox.id !== clickedCheckboxId) {
                checkbox.checked = false;
            }
        });
        checkSelection();
    }

    function checkSelection() {
        var colorCheckboxes = document.getElementsByName('color');
        var sizeCheckboxes = document.getElementsByName('size');
        var clearButtonContainer = document.getElementById('clearButtonContainer');
        var priceBox = document.getElementById('priceBox');

        var selectedColor = "";
        var selectedSize = "";

        colorCheckboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                selectedColor = checkbox.value;
            }
        });

        sizeCheckboxes.forEach(function(checkbox) {
            if (checkbox.checked) {
                selectedSize = checkbox.value;
            }
        });

        if (selectedColor !== "" && selectedSize !== "") {
            clearButtonContainer.classList.remove('d-none');
            priceBox.classList.remove('d-none');
            priceBox.classList.add('d-block');
            var productId = {{ $product->id }};
            // Make AJAX request to fetch variation data
            $.ajax({
                type: 'GET',
                url: "{{ url('/fetch-varaition') }}/" + productId+"/"+selectedSize+"/"+selectedColor,
                success: function(response) {
                    var sellingPrice = response.selling_price;
                    var discountPrice = response.discount_price;
                    priceBox.innerHTML = `
                        <del class="old-price"><span>${sellingPrice}tk</span></del>
                        <span class="product-price">${discountPrice}tk</span>
                    `;
                },
                error: function(xhr, status, error) {
                    console.error(error); // Handle any errors
                }
            });
        } else {
            clearButtonContainer.classList.add('d-none');
        }
    }

    function clearSelection(event) {
        event.preventDefault();
        var colorCheckboxes = document.getElementsByName('color');
        var sizeCheckboxes = document.getElementsByName('size');
        var clearButtonContainer = document.getElementById('clearButtonContainer');
        var priceBox = document.getElementById('priceBox');

        colorCheckboxes.forEach(function(checkbox) {
            checkbox.checked = false;
        });

        sizeCheckboxes.forEach(function(checkbox) {
            checkbox.checked = false;
        });

        clearButtonContainer.classList.add('d-none');
        priceBox.classList.add('d-none');
        priceBox.classList.remove('d-block');
        priceBox.innerHTML = ``;
    }
</script>

@endsection