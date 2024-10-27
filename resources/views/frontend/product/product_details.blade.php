@extends('frontend.main_master')
@section('title')
{{ $product->product_name }}
@endsection


@section('content')
<main class="main">

    @php
        $variations = $product->variations;
    @endphp


    <div class="container">
        <nav aria-label="breadcrumb" class="breadcrumb-nav">
            <ol class="breadcrumb" style="padding: 0">
                <li class="breadcrumb-item"><a href="/"><i class="icon-home"></i></a></li>
                <li class="breadcrumb-item"><a href="">{{ $product->product_name }}</a></li>
            </ol>
        </nav>

        <div class="product-single-container product-single-default">
            <div class="cart-message d-none">
                <strong class="single-cart-notice">{{ $product->product_name }}</strong>
                <span>has been added to your cart.</span>
            </div>

            <div class="row">
                <div class="col-lg-4 col-md-4 product-single-gallery">
                    <div class="product-slider-container">
                        <div class="label-group">
                            {{-- <div class="product-label label-hot">HOT</div>

                            <div class="product-label label-sale">
                                -16%
                            </div> --}}
                        </div>

                        <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                            @if ($product->product3dImage !== null)
                                <div class="product-item product3d-model">
                                    <button class="btn btn-primary floating-button" title="View 3d Model" data-toggle="modal" data-target="#exampleModal"><i class="fa-brands fa-unity" style="font-size: 25px"></i></button>
                                    <canvas class="webgl1" ></canvas>
                                </div>
                            @endif
                            

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
                        @if ($product->product3dImage !== null)
                        <div class="owl-dot">
                            <img src="{{ asset("upload/3d.png") }}" width="110" height="110"
                                alt="product-thumbnail" />
                        </div>
                        @endif
                        

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

                <div class="col-lg-4 col-md-4 product-single-details">
                    <h1 class="product-title" id="productName">{{ $product->product_name }}</h1>

                    

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

                        {{-- <li>
                            Brand: <strong>{{ $product->brand }}</strong>
                        </li> --}}

                        <li> 
                            CATEGORY: 
                            <strong><a href="#" class="product-category">{{ $product->category->category_name }} </a>
                                @if ($product->subCategory !== null)
                                -> <a href="#" class="product-category">{{ $product->subCategory->subcategory_name }} </a>
                                @endif

                                @if ($product->subSubCategory !== null)
                                -> <a href="#" class="product-category">{{ $product->subSubCategory->subsubcategory_name }} </a>
                                @endif
                            </strong>
                            
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


            

                    
                    <input type="hidden" name="product_id" value="{{ $product->id }}" id="productId">
                    <div class="product-action">
                        <div class="price-box product-filtered-price d-none" id="priceBox">
                        </div>
                        <div class="product-single-qty">
                            <input class="horizontal-quantity form-control" type="text" id="qty">
                        </div><!-- End .product-single-qty -->

                        <a href="javascript:;" class="btn btn-dark mr-2 disabled" title="Add to Cart" id="addToCartBtn" onclick="addToCart()">Add to Cart</a>

                        
                    </div><!-- End .product-action -->

                    <hr class="divider mb-0 mt-0">

                    <div class="product-single-share mb-3">
                        <label class="sr-only">Share:</label>

                        <div class="social-icons mr-2">
                            
                                {!! $shareButtons !!}
                        </div><!-- End .social-icons -->

                        {{-- <a href="wishlist.html" class="btn-icon-wish add-wishlist" title="Add to Wishlist"><i
                                class="icon-wishlist-2"></i><span>Add to
                                Wishlist</span></a> --}}
                    </div><!-- End .product single-share -->
                </div><!-- End .product-single-details -->

                <div class="col-g-4 col-md-4 product-video">
                @if ($product->productVideo !== null)
                    @if ($product->productVideo->video_priority == 1)
                        @if ($product->productVideo->embed_code !==null)
                        <iframe width="100%" height="300" src="{{ $product->productVideo->embed_code }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
                        @endif
                    
                    @elseif ($product->productVideo->video_priority == 2)
                        @if ($product->productVideo->video_source !==null)
                        <video width="400" controls>
                            <source src="{{ $product->productVideo->video_source ? asset($product->productVideo->video_source) : '' }}" type="video/mp4">
                            Your browser does not support HTML video.
                        </video>
                        @endif
                    
                    @endif
                @endif
                    
                    
                </div>  {{-- end column product-video --}}
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
                    <a class="nav-link" id="product-tab-reviews" data-toggle="tab"
                        href="#product-reviews-content" role="tab" aria-controls="product-reviews-content"
                        aria-selected="false">Reviews (<span class="review-count"></span>)</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="product-desc-content" role="tabpanel"
                    aria-labelledby="product-tab-desc">
                    <div class="product-desc-content">
                        {!! $product->long_desc !!}

                    </div><!-- End .product-desc-content -->
                </div><!-- End .tab-pane -->

                <div class="tab-pane fade" id="product-reviews-content" role="tabpanel"
                    aria-labelledby="product-tab-reviews">
                    <div class="product-reviews-content">
                        <h3 class="reviews-title"><span class="review-count"></span> review for {{$product->product_name}}</h3>

                        <div class="comment-list">
                            
                            
                        </div>

                        <div class="divider"></div>

                        <div class="add-product-review">
                            <h3 class="review-title">Add a review</h3>

                            @guest
                            <h4 class="text-center text-danger">You have to login to add a review</h4>
                            @else
                            
                            <form action="" class="comment-form m-0" id="reviewForm">
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                <div class="rating-form">
                                    <label for="rating">Your rating <span class="required">*</span></label>
                                    <span class="rating-stars">
                                        <a class="star-1" href="#">1</a>
                                        <a class="star-2" href="#">2</a>
                                        <a class="star-3" href="#">3</a>
                                        <a class="star-4" href="#">4</a>
                                        <a class="star-5" href="#">5</a>
                                    </span>

                                    
                                </div>

                                <div class="form-group">
                                    <label>Your review <span class="required">*</span></label>
                                    <textarea name="review" cols="5" rows="6" class="form-control form-control-sm"></textarea>
                                </div><!-- End .form-group -->


                                

                                <input type="submit" class="btn btn-primary" value="Submit">
                            </form>
                            @endguest
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





  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body d-flex justify-content-center">
            <canvas class="webgl2" ></canvas>
        </div>
      </div>
    </div>
  </div>





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
        var addToCartBtn = document.getElementById('addToCartBtn');

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
            addToCartBtn.classList.remove('disabled');
            var productId = {{ $product->id }};
            // Make AJAX request to fetch variation data
            $.ajax({
                type: 'GET',
                url: "{{ url('/fetch-varaition') }}/" + productId+"/"+selectedSize+"/"+selectedColor,
                success: function(response) {
                    var sellingPrice = response.selling_price;
                    var discountPrice = response.discount_price;
                    if(discountPrice==null){
                            priceBox.innerHTML = `
                                <span class="product-price">${sellingPrice}tk</span>
                            `;
                    }else{
                        priceBox.innerHTML = `
                            <del class="old-price"><span>${sellingPrice}tk</span></del>
                            <span class="product-price">${discountPrice}tk</span>
                        `;
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error); // Handle any errors
                }
            });
        } else {
            clearButtonContainer.classList.add('d-none');
            priceBox.classList.add('d-none');
            priceBox.classList.remove('d-block');
            addToCartBtn.classList.add('disabled');
        }
    }

    function clearSelection(event) {
        event.preventDefault();
        var colorCheckboxes = document.getElementsByName('color');
        var sizeCheckboxes = document.getElementsByName('size');
        var clearButtonContainer = document.getElementById('clearButtonContainer');
        var priceBox = document.getElementById('priceBox');
        var addToCartBtn = document.getElementById('addToCartBtn');

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
        addToCartBtn.classList.add('disabled');
    }
</script>


{{-- 3d model  --}}
<script>
    var product3dImage = {!! json_encode($product->product3dImage ?? null) !!};
    if(product3dImage != null){
        var modelPath = "{{ asset('') }}";
        modelPath += product3dImage.image_source;
        console.log(modelPath);
        var scaleX = product3dImage.scale_x;
        var scaleY = product3dImage.scale_y;
        var scaleZ = product3dImage.scale_z;
        var background = product3dImage.background;
        var directional_light_color = product3dImage.directional_light_color;
        var directional_light_opacity = product3dImage.directional_light_opacity;
        var ambient_light_color = product3dImage.ambient_light_color;
        var ambient_light_opacity = product3dImage.ambient_light_opacity;
        var target_x = product3dImage.target_x;
        var target_y = product3dImage.target_y;
        var target_z = product3dImage.target_z;
    }
</script>

<script type="module" src="{{ asset('frontend/assets/js/3dmodel.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
{{-- ================ add review =============== --}}
<script>
    $(document).ready(function() {
        let rating = 0;

        // Handle rating selection
        $('.rating-stars a').on('click', function(e) {
            e.preventDefault();
            rating = $(this).text();
        });

        // Handle form submission
        $('#reviewForm').on('submit', function(e) {
            e.preventDefault();

            let review = $('textarea[name="review"]').val();
            let productId = $('input[name="product_id"]').val();
            if (!rating || !review) {
                alert('Please provide both a rating and a review.');
                return;
            }

            $.ajax({
                url: '/submit-review',  // Update this URL to your form submission endpoint
                method: 'POST',
                data: {
                    rating: rating,
                    review: review,
                    product_id: productId,
                },
                success: function(data) {
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 3000
                    });
                    if($.isEmptyObject(data.error)){
                        Toast.fire({
                            icon: 'success',
                            title: data.success
                        });
                    }else{
                        Toast.fire({
                            icon: "error",
                            title: data.error
                        });
                    }
                    $('#reviewForm')[0].reset();
                    $('.rating-stars a').removeClass('active');
                    rating = 0;
                },
                error: function(xhr) {
                    alert('An error occurred while submitting your review. Please try again.');
                }
            });
        });


        /* load reviews */
        let reviews = {!! json_encode($reviews) !!};
        $('.review-count').text(reviews.length)
        reviews.forEach(function(review) {
            // Convert the review's created_at timestamp to a Date object
            let reviewDate = new Date(review.created_at);

            // Format the date as "Month Day, Year"
            let options = { month: 'long', day: 'numeric', year: 'numeric' };
            let formattedDate = reviewDate.toLocaleDateString('en-US', options);

            let reviewHtml = `
                <div class="comments mb-2" id="singleComment">
                    <figure class="img-thumbnail">
                        <img src="{{ asset('upload/user_images/${review.user.profile_photo_path}') }}" alt="author" width="80" height="80">
                    </figure>
                    <div class="comment-block">
                        <div class="comment-header">
                            <div class="comment-arrow"></div>
                            <div class="ratings-container float-sm-right">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:${review.rating * 20}%"></span>
                                    <span class="tooltiptext tooltip-top"></span>
                                </div>
                            </div>
                            <span class="comment-by">
                                <strong>${review.user.name}</strong> – ${formattedDate}
                            </span>
                        </div>
                        <div class="comment-content">
                            <p>${review.review}</p>
                        </div>
                    </div>
                </div>
            `;
            $('.comment-list').append(reviewHtml);
        }); /* end foreach */
    });
</script>

@endsection

@push('styles')
<style>
    .product3d-model {
        position: relative;
    }

    .floating-button {
        position: absolute;
        top: 10px; /* Pushed down slightly */
        left: 10px; /* Pushed to the right slightly */
        z-index: 10;  /* Stacked above the canvas */
        padding: 5px 10px; /* Adjust padding as needed */
        border-radius: 4px; /* Optional: rounded corners */
    }

    .webgl {
        width: 100%;
        height: 100%;
        display: block;
        background-color: #000; /* Optional: background color for the canvas */
    }
    #social-links ul{
        display: flex !important;
    }
    #social-links ul li{
        margin: 4px;
        border: 2px solid #e7e7e7;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        text-align: center;
    }
    #social-links ul li a{
        color: #222529;

    }
    #social-links ul li:hover {
        border: 2px solid var(--primary);

    }
    #social-links ul li:hover a{
        color: var(--primary);

    }
</style>
@endpush