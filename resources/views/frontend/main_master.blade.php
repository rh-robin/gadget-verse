<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>

    {{-- <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Porto - Bootstrap eCommerce Template">
    <meta name="author" content="SW-THEMES"> --}}

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('frontend/assets/images/icons/favicon.png') }}">


    <script>
        WebFontConfig = {
            google: {
                families: ['Open+Sans:300,400,600,700', 'Poppins:300,400,500,600,700,800', 'Oswald:300,400,500,600,700,800', 'Playfair+Display:900', 'Shadows+Into+Light:400']
            }
        };
        (function(d) {
            var wf = d.createElement('script'),
                s = d.scripts[0];
            wf.src = '{{ asset("frontend/assets/js/webfont.js") }}';
            wf.async = true;
            s.parentNode.insertBefore(wf, s);
        })(document);
    </script>

    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">

    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/demo1.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/vendor/simple-line-icons/css/simple-line-icons.min.css') }}">


    {{-- three js --}}
    <script async src="https://unpkg.com/es-module-shims@1.6.3/dist/es-module-shims.js"></script>
    <script type="importmap">
        {
        "imports": {
            "three": "https://unpkg.com/three@v0.163.0/build/three.module.js",
            "three/addons/": "https://unpkg.com/three@v0.163.0/examples/jsm/"
        }
        }
    </script>

    {{-- toastr css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    
    <style>
        .invalid-feedback{
            display: inline-block;
        }
        .header-bottom {
            background: none;
        }
        @media (max-width: 770px) {
            .user-profile img{
                width: 50%;
                margin: 0 auto;
                display: block;
            }
        }
    </style>
    @stack('styles')
</head>

<body>
    <div class="page-wrapper">
        
        <!-- End .top-notice -->

        @include('frontend.body.header')
        <!-- End .header -->

        
        @yield('content')
        <!-- End .main -->


  <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" >
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="product-single-container product-single-default product-quick-view mb-0">
                <div class="row">
                    <div class="col-md-6 product-single-gallery mb-md-0">
                        <div class="product-slider-container">
            
                            <div class="product-single-carousel owl-carousel owl-theme show-nav-hover">
                                <div class="product-item">
                                    <img id="thumbnail" class="product-single-image" src=""/>
                                </div>
                            </div>
                            <!-- End .product-single-carousel -->
                        </div>
                        {{-- <div class="prod-thumbnail owl-dots">
                            <div class="owl-dot">
                                <img src="assets/images/products/zoom/product-1.jpg" />
                            </div>
                        </div> --}}
                    </div><!-- End .product-single-gallery -->
            
                    <div class="col-md-6">
                        <div class="product-single-details mb-0 ml-md-4">
                            <h1 class="product-title" id="productName"></h1>
            
                            <div class="ratings-container">
                                <div class="product-ratings">
                                    <span class="ratings" style="width:60%"></span><!-- End .ratings -->
                                </div><!-- End .product-ratings -->
            
                                <a href="#" class="rating-link">( 6 Reviews )</a>
                            </div><!-- End .ratings-container -->
            
                            <hr class="short-divider">
            
                            <div class="price-box" id="priceRange">
                                <span class="product-price"></span>
                            </div><!-- End .price-box -->
            
                            <div class="product-desc">
                                <p id="shortDesc">
                                    
                                </p>
                            </div><!-- End .product-desc -->
            
                            <ul class="single-info-list">
                                <!---->
                                <li>
                                    SKU:
                                    <strong id="sku"></strong>
                                </li>
            
                                <li>
                                    CATEGORY:
                                    <strong>
                                        <a href="#" class="product-category" id="category"></a>
                                    </strong>
                                </li>
                            </ul>
            
                            <div class="product-filters-container">
                                <div class="filter_color d-flex" >
                                    <h4 class="pr-2" style="margin-bottom:0; font-size:16px;">Colors: </h4>
                                    <div class="d-flex flex-wrap" id="colorContainer"></div>
                                </div>
                                <div class="filter_color d-flex">
                                    <h4 class="pr-2" style="margin-bottom:0; font-size:16px;">Sizes: </h4>
                                    
                                    <div class="d-flex flex-wrap" id="sizeContainer"></div>
                                    
            
                                   
                                    
                                </div>
                                <div class=" d-none" id="clearButtonContainer">
                                    <label></label>
                                    <a class="font1 text-uppercase clear-btn" href="#" onclick="clearSelections(event)">Clear</a>
                                </div>
                            </div>
                            <input type="hidden" name="product_id" value="" id="productId">
                            <div class="product-action">
                                <div class="price-box product-filtered-price d-none" id="priceBox">
                                    
                                </div>
            
                                <div class="product-single-qty">
                                    <input class="horizontal-quantity form-control" type="text" id="qty"/>
                                </div><!-- End .product-single-qty -->
            
                                <a href="javascript:;" class="btn btn-dark mr-2 disabled" title="Add to Cart" id="addToCartBtn" onclick="addToCart()">Add to Cart</a>
            
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
            
                    <button title="Close (Esc)" type="button" class="mfp-close close"   data-dismiss="modal" aria-label="Close" id="closeModal">
                        ×
                    </button>
                </div><!-- End .row -->
            </div> {{-- end product-single-container --}}
        </div>
        </div>
    </div>
  {{-- ===================================================================
    =========================================================
    ==================================================== --}}
   

        @include('frontend.body.footer')
        <!-- End .footer -->
    </div>
    <!-- End .page-wrapper -->

    <div class="loading-overlay">
        <div class="bounce-loader">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>

    <div class="mobile-menu-overlay"></div>
    <!-- End .mobil-menu-overlay -->

    <div class="mobile-menu-container">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="fa fa-times"></i></span>
            <nav class="mobile-nav">
                <ul class="mobile-menu menu-with-icon">
                    <li><a href="demo1.html"><i class="icon-home"></i>Home</a></li>
                    <li>
                        <a href="demo1-shop.html" class="sf-with-ul"><i class="sicon-badge"></i>Categories</a>
                        <ul>
                            <li><a href="category.html">Full Width Banner</a></li>
                            <li><a href="category-banner-boxed-slider.html">Boxed Slider Banner</a></li>
                            <li><a href="category-banner-boxed-image.html">Boxed Image Banner</a></li>
                            <li><a href="category-sidebar-left.html">Left Sidebar</a></li>
                            <li><a href="category-sidebar-right.html">Right Sidebar</a></li>
                            <li><a href="category-off-canvas.html">Off Canvas Filter</a></li>
                            <li><a href="category-horizontal-filter1.html">Horizontal Filter 1</a></li>
                            <li><a href="category-horizontal-filter2.html">Horizontal Filter 2</a></li>
                            <li><a href="#">List Types</a></li>
                            <li><a href="category-infinite-scroll.html">Ajax Infinite Scroll<span
                                        class="tip tip-new">New</span></a></li>
                            <li><a href="category.html">3 Columns Products</a></li>
                            <li><a href="category-4col.html">4 Columns Products</a></li>
                            <li><a href="category-5col.html">5 Columns Products</a></li>
                            <li><a href="category-6col.html">6 Columns Products</a></li>
                            <li><a href="category-7col.html">7 Columns Products</a></li>
                            <li><a href="category-8col.html">8 Columns Products</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="demo1-product.html" class="sf-with-ul"><i class="sicon-basket"></i>Products</a>
                        <ul>
                            <li>
                                <a href="#" class="nolink">PRODUCT PAGES</a>
                                <ul>
                                    <li><a href="product.html">SIMPLE PRODUCT</a></li>
                                    <li><a href="product-variable.html">VARIABLE PRODUCT</a></li>
                                    <li><a href="product.html">SALE PRODUCT</a></li>
                                    <li><a href="product.html">FEATURED & ON SALE</a></li>
                                    <li><a href="product-sticky-info.html">WIDTH CUSTOM TAB</a></li>
                                    <li><a href="product-sidebar-left.html">WITH LEFT SIDEBAR</a></li>
                                    <li><a href="product-sidebar-right.html">WITH RIGHT SIDEBAR</a></li>
                                    <li><a href="product-addcart-sticky.html">ADD CART STICKY</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="#" class="nolink">PRODUCT LAYOUTS</a>
                                <ul>
                                    <li><a href="product-extended-layout.html">EXTENDED LAYOUT</a></li>
                                    <li><a href="product-grid-layout.html">GRID IMAGE</a></li>
                                    <li><a href="product-full-width.html">FULL WIDTH LAYOUT</a></li>
                                    <li><a href="product-sticky-info.html">STICKY INFO</a></li>
                                    <li><a href="product-sticky-both.html">LEFT & RIGHT STICKY</a></li>
                                    <li><a href="product-transparent-image.html">TRANSPARENT IMAGE</a></li>
                                    <li><a href="product-center-vertical.html">CENTER VERTICAL</a></li>
                                    <li><a href="#">BUILD YOUR OWN</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" class="sf-with-ul"><i class="sicon-envelope"></i>Pages</a>
                        <ul>
                            <li>
                                <a href="wishlist.html">Wishlist</a>
                            </li>
                            <li>
                                <a href="cart.html">Shopping Cart</a>
                            </li>
                            <li>
                                <a href="checkout.html">Checkout</a>
                            </li>
                            <li>
                                <a href="dashboard.html">Dashboard</a>
                            </li>
                            <li>
                                <a href="login.html">Login</a>
                            </li>
                            <li>
                                <a href="forgot-password.html">Forgot Password</a>
                            </li>
                        </ul>
                    </li>
                    <li><a href="blog.html"><i class="sicon-book-open"></i>Blog</a></li>
                    <li><a href="demo1-about.html"><i class="sicon-users"></i>About Us</a></li>
                </ul>

                <ul class="mobile-menu menu-with-icon mt-2 mb-2">
                    <li class="border-0">
                        <a href="#" target="_blank"><i class="sicon-star"></i>Buy Porto!<span
                                class="tip tip-hot">Hot</span></a>
                    </li>
                </ul>

                <ul class="mobile-menu">
                    <li><a href="login.html">My Account</a></li>
                    <li><a href="demo1-contact.html">Contact Us</a></li>
                    <li><a href="wishlist.html">My Wishlist</a></li>
                    <li><a href="#">Site Map</a></li>
                    <li><a href="cart.html">Cart</a></li>
                    <li><a href="login.html" class="login-link">Log In</a></li>
                </ul>
            </nav>
            <!-- End .mobile-nav -->

            <form class="search-wrapper mb-2" action="#">
                <input type="text" class="form-control mb-0" placeholder="Search..." required />
                <button class="btn icon-search text-white bg-transparent p-0" type="submit"></button>
            </form>

            <div class="social-icons">
                <a href="#" class="social-icon social-facebook icon-facebook" target="_blank">
                </a>
                <a href="#" class="social-icon social-twitter icon-twitter" target="_blank">
                </a>
                <a href="#" class="social-icon social-instagram icon-instagram" target="_blank">
                </a>
            </div>
        </div>
        <!-- End .mobile-menu-wrapper -->
    </div>
    <!-- End .mobile-menu-container -->

    <div class="sticky-navbar">
        <div class="sticky-info">
            <a href="demo1.html">
                <i class="icon-home"></i>Home
            </a>
        </div>
        <div class="sticky-info">
            <a href="demo1-shop.html" class="">
                <i class="icon-bars"></i>Categories
            </a>
        </div>
        <div class="sticky-info">
            <a href="wishlist.html" class="">
                <i class="icon-wishlist-2"></i>Wishlist
            </a>
        </div>
        <div class="sticky-info">
            <a href="login.html" class="">
                <i class="icon-user-2"></i>Account
            </a>
        </div>
        <div class="sticky-info">
            <a href="cart.html" class="">
                <i class="icon-shopping-cart position-relative">
                    <span class="cart-count badge-circle">3</span>
                </i>Cart
            </a>
        </div>
    </div>

   {{--  @include('frontend.body.newsletter_popup') --}}
    <!-- End .newsletter-popup -->

    <a id="scroll-top" href="#top" title="Top" role="button"><i class="icon-angle-up"></i></a>


    



    <!-- Plugins JS File -->
    <script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/plugins.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.appear.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.plugin.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/jquery.countdown.min.js') }}"></script>

    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Main JS File -->
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>

    




    {{-- scripts to load product quick view data --}}
    <script>
        $.ajaxSetup({
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        })

        function productQuickView(id){
            let thumbnail =  document.getElementById('thumbnail');
            let productName =  document.getElementById('productName');
            let priceRange =  document.getElementById('priceRange');
            let shortDesc =  document.getElementById('shortDesc');
            let sku =  document.getElementById('sku');
            let category =  document.getElementById('category');
            let colorContainer =  document.getElementById('colorContainer');
            let sizeContainer =  document.getElementById('sizeContainer');
            var clearButtonContainer = document.getElementById('clearButtonContainer');
            clearButtonContainer.classList.add('d-none');
            var priceBox = document.getElementById('priceBox');
            priceBox.innerHTML = ``;
            var productId = document.getElementById('productId');
            productId.value = id;
            var thumbnailSrc = ""
            $.ajax({
                type: 'GET',
                url: "{{ url('/product/quickview') }}/" + id,
                success: function(response) {
                    thumbnail.src = "{{ asset('') }}"
                    thumbnailSrc = response.product.product_thumbnail;
                    thumbnail.src += thumbnailSrc;
                    productName.innerText = response.product.product_name;
                    let lowestPrice = response.lowestPrice;
                    let highestPrice = response.highestPrice;
                    if (lowestPrice == highestPrice || highestPrice==0){
                        priceRange.innerHTML = `
                            <span class="product-price">${lowestPrice}tk</span>
                        `;
                    }else{
                        priceRange.innerHTML = `
                        <span class="product-price">${lowestPrice}tk &ndash;</span>
                        <span class="product-price"> ${highestPrice}tk</span>
                        `;
                    }
                    shortDesc.innerText = response.product.short_desc;
                    sku.innerText = response.product.product_sku;
                    category.innerText = response.category;
                    let colors = response.colors;
                    colorContainer.innerHTML=``;
                    colors.forEach(color => {
                        let colordiv = `
                            <div class="d-flex pr-3" >
                                <div class="pr-2">
                                    <input type="checkbox" id="color_${color['color_name']}" name="color" onclick="checkboxColor(this,${id})" value="${color['color_name']}">
                                    <label class="text-capitalize" for="color_${color['color_name']}" style="font-weight: 400; font-size:16px;">${color['color_name']}</label>
                                </div>
                                <div class="" style="width: 20px; height:20px; background-color:${color['color_code'] ? color['color_code'] : color['color_name']}"></div>
                            </div>
                        `;
                        colorContainer.innerHTML += colordiv;
                    });
                    let sizes = response.sizes;
                    sizeContainer.innerHTML = ``;
                    sizes.forEach(size => {
                        let sizediv = `
                            <div class="pr-5" >
                                <div class="">
                                    <input type="checkbox" id="size_${size}" name="size" onclick="checkboxSize(this,${id})" value="${size}">
                                    <label class="text-capitalize" for="size_${size}" style="font-weight: 400; font-size:16px;">${size}</label>
                                </div>
                            </div>
                        `;
                        sizeContainer.innerHTML += sizediv;
                    });
                    let qty = document.getElementById('qty');
                    qty.value = 1;
                },
                error: function(xhr, status, error) {
                    console.error(error); // Handle any errors
                }
            });
        }

        
        function checkboxColor(clickedCheckbox, id) {
            // Get the ID of the clicked checkbox
            var clickedCheckboxId = clickedCheckbox.id;
            
            // Uncheck all checkboxes with name 'color' except the clicked one
            var checkboxes = document.getElementsByName('color');
            checkboxes.forEach(function(checkbox) {
                if (checkbox.id !== clickedCheckboxId) {
                    checkbox.checked = false;
                }
            });
            checkSelections(id);
        }

        function checkboxSize(clickedCheckbox, id) {
            // Get the ID of the clicked checkbox
            var clickedCheckboxId = clickedCheckbox.id;
            // Uncheck all checkboxes with name 'size' except the clicked one
            var checkboxes = document.getElementsByName('size');
            checkboxes.forEach(function(checkbox) {
                if (checkbox.id !== clickedCheckboxId) {
                    checkbox.checked = false;
                }
            });
            checkSelections(id);
        }

        function checkSelections(id) {
            let thumbnail =  document.getElementById('thumbnail');
            var colorCheckboxes = document.getElementsByName('color');
            var sizeCheckboxes = document.getElementsByName('size');
            var addToCartBtn = document.getElementById('addToCartBtn');
            
            var productId = id;

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
                var productId = id;
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
                priceBox.innerHTML=``;
                addToCartBtn.classList.add('disabled');
            }
        }

        function clearSelections(event) {
            event.preventDefault();
            var colorCheckboxes = document.getElementsByName('color');
            var sizeCheckboxes = document.getElementsByName('size');
            var clearButtonContainer = document.getElementById('clearButtonContainer');
            colorCheckboxes.forEach(function(checkbox) {
                checkbox.checked = false;
            });

            sizeCheckboxes.forEach(function(checkbox) {
                checkbox.checked = false;
            });

            clearButtonContainer.classList.add('d-none');
            priceBox.classList.add('d-none');
            priceBox.classList.remove('d-block');
            priceBox.innerHTML=``;
            addToCartBtn.classList.add('disabled');
        }

        /* start add to cart function */
        function addToCart(){
            var productId = document.getElementById('productId').value;
            var productName = document.getElementById('productName').innerText;
            var colorCheckboxes = document.getElementsByName('color');
            var sizeCheckboxes = document.getElementsByName('size');
            var qtyField = document.getElementById('qty');
            var qty = document.getElementById('qty').value;
            var color;
            var size;
            colorCheckboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    color =  checkbox.value;
                }
            });
            sizeCheckboxes.forEach(function(checkbox) {
                if (checkbox.checked) {
                    size =  checkbox.value;
                }
            });
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ url('/cart/data/store') }}/" + productId,
                data: {
                    productName: productName,
                    color: color,
                    size: size,
                    qty: qty,
                },
                success: function(data){
                    $('#closeModal').click();
                    qtyField.value = 1;
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
                            icon: 'error',
                            title: data.error
                        });
                    }
                    miniCart();
                }
            });
        }
    </script>

    {{-- mini cart --}}
    <script>
        function miniCart(){
            $.ajax({
                type: "GET",
                url: "/product/minicart",
                dataType: "json",
                success: function(response){
                    let miniCart = '';
                    $('#cartCount').text(response.cartCount);
                    $('#subTotal').text(response.cartTotal);
                    $.each(response.carts, function(key, value){
                        
                        miniCart +=`
                            <div class="product">
                                <div class="product-details">
                                    <h4 class="product-title">
                                        <a href="demo1-product.html">${value.name}</a>
                                    </h4>

                                    <span class="cart-product-info">
                                        <div class="pb-2">
                                            <span>Color: ${value.options.color}</span>
                                            <span class="pl-3">Size: ${value.options.size}</span>
                                        </div>
                                        <span class="cart-product-qty">${value.qty}</span> × ${value.price}tk
                                    </span>
                                </div>
                                <!-- End .product-details -->

                                <figure class="product-image-container">
                                    <a href="demo1-product.html" class="product-image">
                                        <img src="{{ asset('') }}${value.options.image}" alt="product" width="80" height="80">
                                    </a>

                                    <a href="javascript:;" class="btn-remove" title="Remove Product" id="${value.rowId}" onclick="removeFromCart(this.id)"><span>×</span></a>
                                </figure>
                            </div>
                            <!-- End .product -->
                        `;
                    });
                    $('#miniCart').html(miniCart);
                }
            })
        }
        miniCart();

        function removeFromCart(rowId){
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "/cart/data/remove/"+rowId,
                success: function(data){
                    miniCart();
                    cart();
                    removeCoupon();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 3000
                    });
                    if($.isEmptyObject(data.error)){
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        });
                    }else{
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        });
                    }
                }
            })
        }
    </script>


    {{-- my cart page --}}
    <script>
        function cart(){
            $.ajax({
                type: "GET",
                url: "/cart/get-content",
                dataType: "json",
                success: function(response){
                    let cart = '';
                    if(response.carts.length == 0){
                        cart = `<td colspan="5"><p class="text-center">No item in your cart</p></td>`;
                    }else{
                        $.each(response.carts, function(key, value){
                            cart +=`
                            <tr class="product-row">
                                <td>
                                    <figure class="product-image-container">
                                        <a href="product.html" class="product-image">
                                            <img src="/${value.options.image}" alt="product">
                                        </a>

                                        <a href="javascript:;" class="btn-remove icon-cancel" title="Remove Product" id="${value.rowId}" onclick="removeFromCart(this.id)"></a>
                                    </figure>
                                </td>
                                <td class="product-col">
                                    <h5 class="product-title">
                                        <a href="product.html">${value.name}</a>
                                    </h5>
                                </td>
                                <td class="">
                                    <span>Color: ${value.options.color}</span></br>
                                    <span>Size: ${value.options.size}</span>
                                </td>
                                <td>${value.price}</td>
                                <td>
                                    <div class="product-single-qty" style="display: flex; height: 50px;">
                                        ${value.qty > 1 ?
                                            `<button class="btn bg-transparent" style="border: 1px solid #dfdfdf; border-right:0" id="${value.rowId}" onclick="cartDecrement(this.id)">-</button>`
                                        :   
                                        `<button class="btn bg-transparent disabled" style="border: 1px solid #dfdfdf; border-right:0">-</button>`
                                        }
                                        
                                        <input class="horizontal-quantity form-control" type="text" name="qty" value="${value.qty}" style="height:100%; width: 38px; background: transparent;" readonly>
                                        <button class="btn bg-transparent" style="border: 1px solid #dfdfdf; border-left:0" id="${value.rowId}" onclick="cartIncrement(this.id)">+</button>
                                    </div>
                                </td>
                                <td class="text-right"><span class="subtotal-price">${value.qty*value.price}</span></td>
                            </tr>
                            `;
                        });
                    }
                    $('#cart').html(cart);

                    
                }
            })
        }
        cart();

        function cartIncrement(rowId){
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/cart/item/increment/'+rowId,
                success: function(data){
                    miniCart();
                    cart();
                    couponCalculation();
                    const Toast = Swal.mixin({
                        toast: true,
                        position: "top-end",
                        icon: "success",
                        showConfirmButton: false,
                        timer: 3000
                    });
                    if($.isEmptyObject(data.error)){
                        Toast.fire({
                            type: 'success',
                            title: data.success
                        });
                    }else{
                        Toast.fire({
                            type: 'error',
                            title: data.error
                        });
                    }
                }
            });
        }

        function cartDecrement(rowId){
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/cart/item/decrement/'+rowId,
                success: function(data){
                    miniCart();
                    cart();
                    couponCalculation();
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
                            icon: 'error',
                            title: data.error
                        });
                    }
                }
            });
        }
        
    </script>

    {{-- ========================= apply coupon ===================== --}}
    <script>
        function applyCoupon(){
            let couponName = $('#couponName').val();
            $.ajax({
                type: "POST",
                url: '/coupon-apply',
                dataType: "json",
                data: {coupon: couponName},
                success: function(data){
                    couponCalculation();
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
                }
            })
        }

        function couponCalculation(){
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/coupon-calculation',
                success: function(data){
                    if(data.total){
                        $('#couponField').show();
                        $('#totalTable').html(`
                            <tbody>
                                <tr>
                                    <td>Subtotal</td>
                                    <td id="">${data.total}</td>
                                </tr>

                                <tr>
                                    <td class="text-left">
                                        Shipping
                                    </td>
                                    <td class="text-left">
                                        Will be added in checkout page
                                    </td>
                                </tr>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td style="padding-right:0;">Total</td>
                                    <td style="font-weight: 400; font-size: 1.2rem; padding-left:0;">${data.total}</td>
                                </tr>
                            </tfoot>
                        `);
                    }else{
                        $('#couponField').hide();
                        $('#totalTable').html(`
                            <tbody>
                                <tr>
                                    <td>Subtotal</td>
                                    <td>${data.subTotal}</td>
                                </tr>
                                <tr>
                                    <td>Coupon Code</td>
                                    <td>${data.coupon_code}<button style="border: 1px solid #dfdfdf; margin-left:2px;" type="submit" onclick="removeCoupon()"><i class="fa-solid fa-times"></i></button></td>
                                </tr>
                                <tr>
                                    <td>Discount(${data.coupon_discount == data.discount_amount ? data.coupon_discount + "tk" : data.coupon_discount + "%"})</td>
                                    <td>-${data.discount_amount}</td>
                                </tr>

                                <tr>
                                    <td colspan="2" class="text-left">
                                        <h4>Shipping</h4>

                                        <p>Will be added in checkout page</p>
                                    </td>
                                </tr>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td style="padding-right:0;">Total</td>
                                    <td style="font-weight: 400; font-size: 1.2rem; padding-left:0;">${data.total_amount}</td>
                                </tr>
                            </tfoot>
                        `);
                    }
                }
            })
        }
        couponCalculation();

        function removeCoupon(){
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/coupon-remove',
                success: function(data){
                    couponCalculation();
                    
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
                }
            })
        }


    /* ========================= apply refer code =====================  */
        function applyReferCode(){
            let referCode = $('#referCode').val();
            $.ajax({
                type: "POST",
                url: '/refer-code-apply',
                dataType: "json",
                data: {referCode: referCode},
                success: function(data){
                    referCalculation();
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
                }
            })
        }

        function referCalculation(){
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/refer-calculation',
                success: function(data){
                    if(data.total){
                        $('#couponField').show();
                        $('#totalTable').html(`
                            <tbody>
                                <tr>
                                    <td>Subtotal</td>
                                    <td id="">${data.total}</td>
                                </tr>

                                <tr>
                                    <td class="text-left">
                                        Shipping
                                    </td>
                                    <td class="text-left">
                                        Will be added in checkout page
                                    </td>
                                </tr>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td style="padding-right:0;">Total</td>
                                    <td style="font-weight: 400; font-size: 1.2rem; padding-left:0;">${data.total}</td>
                                </tr>
                            </tfoot>
                        `);
                    }else{
                        $('#couponField').hide();
                        $('#totalTable').html(`
                            <tbody>
                                <tr>
                                    <td>Subtotal</td>
                                    <td>${data.subTotal}</td>
                                </tr>
                                <tr>
                                    <td>Referral Code</td>
                                    <td>${data.refer_code}<button style="border: 1px solid #dfdfdf; margin-left:2px;" type="submit" onclick="removeRefer()"><i class="fa-solid fa-times"></i></button></td>
                                </tr>
                                <tr>
                                    <td>Discount(${data.refer_discount+"%"})</td>
                                    <td>-${data.discount_amount}</td>
                                </tr>

                                <tr>
                                    <td colspan="2" class="text-left">
                                        <h4>Shipping</h4>

                                        <p>Will be added in checkout page</p>
                                    </td>
                                </tr>
                            </tbody>

                            <tfoot>
                                <tr>
                                    <td style="padding-right:0;">Total</td>
                                    <td style="font-weight: 400; font-size: 1.2rem; padding-left:0;">${data.total_amount}</td>
                                </tr>
                            </tfoot>
                        `);
                    }
                }
            })
        }
        referCalculation()

        function removeRefer(){
            $.ajax({
                type: "GET",
                dataType: "json",
                url: '/refer-remove',
                success: function(data){
                    referCalculation();
                    
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
                }
            })
        }
    </script>


    {{-- scripts for toastr --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    <script>
        @if(Session::has('message'))
        var type = "{{ Session::get('alert-type','info') }}"
        switch(type) {
            case 'info':
            toastr.info(" {{ Session::get('message') }} ");
            toast[0].style.color = "red";
            break;
            case 'success':
            toastr.success(" {{ Session::get('message') }} ");
            break;
            case 'warning':
            toastr.warning(" {{ Session::get('message') }} ");
            break;
            case 'error':
            toastr.error(" {{ Session::get('message') }}");
            break;
        }
        @endif
    </script>
</body>

</html>