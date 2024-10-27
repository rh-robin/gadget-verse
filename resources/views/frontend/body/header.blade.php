<header class="header home">

@php
$categories = App\Models\Category::orderBy('category_name','ASC')->where('status',1)->get();
$setting = App\Models\Setting::find(1);

@endphp

    
    <!-- End .header-top -->

    <div class="header-middle text-dark sticky-header">
        <div class="container">
            <div class="header-left col-lg-2 w-auto pl-0">
                <button class="mobile-menu-toggler mr-2" type="button">
                    <i class="fas fa-bars"></i>
                </button>
                <a href="/" class="logo">
                    <img src="{{ asset( $setting->logo) }}" width="111" height="44" alt="Porto Logo">
                </a>
            </div>
            <!-- End .header-left -->

            <div class="header-right w-lg-max pl-2">
                <div class="header-search header-icon header-search-inline header-search-category w-lg-max">
                    <a href="#" class="search-toggle" role="button"><i class="icon-search-3"></i></a>
                    <form action="#" method="get">
                        <div class="header-search-wrapper">
                            <input type="search" class="form-control" name="q" id="q" placeholder="Search..." required>
                            <div class="select-custom">
                                <select id="cat" name="cat">
                                    <option value="">All Categories</option>


                            @foreach ($categories as $category)
                                @php
                                $subCategories = App\Models\SubCategory::where('category_id', $category->id)->orderBy('subcategory_name','ASC')->get();
                                @endphp

                                <option value="4">{{ $category->category_name }}</option>
                                @foreach ($subCategories as $subCategory)
                                    <option value="4">- {{ $subCategory->subcategory_name }}</option>
                                @endforeach
                            @endforeach
                                    


                                </select>
                            </div>
                            <!-- End .select-custom -->
                            <button class="btn icon-magnifier" type="submit"></button>
                        </div>
                        <!-- End .header-search-wrapper -->
                    </form>
                </div>
                <!-- End .header-search -->

                <div class="header-contact d-none d-lg-flex align-items-center pr-xl-5 mr-5 mr-xl-3 ml-5">
                    <i class="icon-phone-2"></i>
                    <h6 class="pt-1 line-height-1">Call us now<a href="tel:#" class="d-block text-dark ls-10 pt-1">+123 5678 890</a></h6>
                </div>
                <!-- End .header-contact -->
                @auth
                <a href="{{ route('dashboard') }}" class="header-icon header-icon-user"><i class="icon-user-2"></i></a>
                @else
                <a href="{{ route('login') }}" class="header-icon header-icon-user"><i class="icon-user-2"></i></a>
                @endauth
                

                <a href="wishlist.html" class="header-icon"><i class="icon-wishlist-2"></i></a>

                <div class="dropdown cart-dropdown">
                    <a href="#" title="Cart" class="dropdown-toggle dropdown-arrow cart-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                        <i class="minicart-icon"></i>
                        <span class="cart-count badge-circle" id="cartCount">3</span>
                    </a>

                    <div class="cart-overlay"></div>

                    <div class="dropdown-menu mobile-cart">
                        <a href="#" title="Close (Esc)" class="btn-close">×</a>

                        <div class="dropdownmenu-wrapper custom-scrollbar">
                            <div class="dropdown-cart-header">Shopping Cart</div>
                            <!-- End .dropdown-cart-header -->
                            <div class="dropdown-cart-products">
                                <div class="py-3" style="border-bottom: 1px solid #e6ebee; "></div>
                                <div class="" id="miniCart"></div>

                            </div>
                            <!-- End .cart-product -->

                            <div class="dropdown-cart-total">
                                <span>SUBTOTAL:</span>

                                <span class="cart-total-price float-right" id="subTotal"></span>
                            </div>
                            <!-- End .dropdown-cart-total -->

                            <div class="dropdown-cart-action">
                                <a href="{{ route('cart.view') }}" class="btn btn-gray btn-block view-cart">View
                                    Cart</a>
                                <a href="{{ route('checkout') }}" class="btn btn-dark btn-block">Checkout</a>
                            </div>
                            <!-- End .dropdown-cart-total -->
                        </div>
                        <!-- End .dropdownmenu-wrapper -->
                    </div>
                    <!-- End .dropdown-menu -->
                </div>
                <!-- End .dropdown -->
            </div>
            <!-- End .header-right -->
        </div>
        <!-- End .container -->
    </div>
    <!-- End .header-middle -->

    <!-- Start .header-bottom -->
    <div class="header-bottom sticky-header d-none d-lg-block" data-sticky-options="{'mobile': false}">
        <div class="container">
            <nav class="main-nav w-100">
                <ul class="menu">
                    <li>
                        <a href="/">Home</a>
                    </li>

                @foreach ($categories as $category)
                    @php
                    $subCategories = App\Models\SubCategory::where('category_id', $category->id)->orderBy('subcategory_name','ASC')->get();
                    
                    @endphp

                    <li>
                        <a href="{{route('category.product', ['id' => $category->id, 'slug' => $category->category_slug])}}">{{ $category->category_name }}</a>
                        @if (count($subCategories) > 0)

                        <ul style="display: none;">
                        @foreach ($subCategories as $subCategory)
                            @php
                            $subSubCategories = App\Models\SuBSubCategory::where('subcategory_id', $subCategory->id)->orderBy('subsubcategory_name','ASC')->get();
                            @endphp

                            <li class=""><a href="{{route('subcategory.product',  ['id' => $subCategory->id, 'slug' => $subCategory->subcategory_slug])}}" class="{{ count($subSubCategories) > 0 ? 'sf-with-ul' : '' }}">{{ $subCategory->subcategory_name }}</a>

                                @if (count($subSubCategories) > 0)
                                <ul style="display: none;">
                                    @foreach ($subSubCategories as $subSubCategory)
                                    <li><a href="{{route('subsubcategory.product', ['id' => $subSubCategory->id, 'slug' => $subSubCategory->subsubcategory_slug])}}">{{ $subSubCategory->subsubcategory_name }}</a></li>
                                    @endforeach
                                </ul>
                                @endif

                            </li>
                        @endforeach
                        </ul>
                        
                        
                        
                        @endif
                    </li>
                @endforeach

                    
                    <li><a href="">Contact Us</a></li>
                    
                </ul>
            </nav>
        </div><!-- End .container -->
    </div><!-- End .header-bottom -->
</header>