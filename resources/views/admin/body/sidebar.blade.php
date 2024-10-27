@php
  $prefix = Request::route()->getPrefix();
  $route = Route::current()->getName();
@endphp


<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">	
		
        <div class="user-profile">
			<div class="ulogo">
				 <a href="index.html">
				  <!-- logo for regular state and mobile devices -->
					 <div class="d-flex align-items-center justify-content-center">					 	
						  <img src="{{ asset('backend/images/logo-dark.png') }}" alt="">
						  <h3><b>Gadget Verse</b> Admin</h3>
					 </div>
				</a>
			</div>
        </div>
      
      <!-- sidebar menu-->
      <ul class="sidebar-menu" data-widget="tree">  
		  
		    <li class="{{ ($route === 'admin.dashboard') ? 'active' : '' }}">
          <a href="{{ route('admin.dashboard') }}">
            <i data-feather="pie-chart"></i>
			      <span>Dashboard</span>
          </a>
        </li>  
		
        <li class="treeview {{ ($prefix === '/brand') ? 'active' : '' }}">
          <a href="#">
            <i class="fa-solid fa-handshake"></i>
            <span>Brand</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route === 'brand.view') ? 'active' : '' }}"><a href="{{ route('brand.view') }}"><i class="ti-more"></i>All Brands</a></li>
            <li><a href="calendar.html"><i class="ti-more"></i>Calendar</a></li>
          </ul>
        </li> 

        <li class="treeview {{ ($prefix === '/category') ? 'active' : '' }}">
          <a href="#">
            <i class="fa-solid fa-list"></i>
            <span>Category</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route === 'category.view') ? 'active' : '' }}"><a href="{{ route('category.view') }}"><i class="ti-more"></i>All Categories</a></li>
            <li class="{{ ($route === 'subcategory.view') ? 'active' : '' }}"><a href="{{ route('subcategory.view') }}"><i class="ti-more"></i>All Sub Categories</a></li>
            <li class="{{ ($route === 'subsubcategory.view') ? 'active' : '' }}"><a href="{{ route('subsubcategory.view') }}"><i class="ti-more"></i>All Sub Sub-Categories</a></li>
          </ul>
        </li> 


       
        

        <li class="treeview {{ ($prefix === '/product') ? 'active' : '' }}">
          <a href="#">
            <i class="fa-solid fa-bag-shopping"></i>
            <span>Product</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route === 'product.view') ? 'active' : '' }}"><a href="{{ route('product.view') }}"><i class="ti-more"></i>All Products</a></li>
            <li class="{{ ($route === 'product.add') ? 'active' : '' }}"><a href="{{ route('product.add') }}"><i class="ti-more"></i>Add Product</a></li>
          </ul>
        </li> 

        <li class="treeview {{ ($prefix === '/review') ? 'active' : '' }}">
          <a href="#">
            <i class="fa-regular fa-star"></i>
            <span>Review</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route === 'review.view') ? 'active' : '' }}"><a href="{{ route('review.view') }}"><i class="ti-more"></i>All Reviews</a></li>
          </ul>
        </li>


        <li class="treeview {{ ($prefix === '/coupon') ? 'active' : '' }}">
          <a href="#">
            <i class="fa-solid fa-money-bill"></i>
            <span>Coupon</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route === 'coupon.view') ? 'active' : '' }}"><a href="{{ route('coupon.view') }}"><i class="ti-more"></i>Manage Coupons</a></li>
          </ul>
        </li> 


        <li class="treeview {{ ($prefix === '/shipping') ? 'active' : '' }}">
          <a href="#">
            <i class="fa-solid fa-truck-fast"></i>
            <span>Shipping Area</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route === 'division.view') ? 'active' : '' }}"><a href="{{ route('division.view') }}"><i class="ti-more"></i>Divisions</a></li>
            <li class="{{ ($route === 'district.view') ? 'active' : '' }}"><a href="{{ route('district.view') }}"><i class="ti-more"></i>Districts</a></li>
          </ul>
        </li> 


        <li class="treeview {{ ($prefix === '/order') ? 'active' : '' }}">
          <a href="#">
            <i class="fa-solid fa-list"></i>
            <span>Order</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route === 'order.pending.view') ? 'active' : '' }}"><a href="{{ route('order.pending.view') }}"><i class="ti-more"></i>Pending</a></li>
            <li class="{{ ($route === 'order.accepted.view') ? 'active' : '' }}"><a href="{{ route('order.accepted.view') }}"><i class="ti-more"></i>Accepted</a></li>
            <li class="{{ ($route === 'order.processing.view') ? 'active' : '' }}"><a href="{{ route('order.processing.view') }}"><i class="ti-more"></i>Processing</a></li>
            <li class="{{ ($route === 'order.picked.view') ? 'active' : '' }}"><a href="{{ route('order.picked.view') }}"><i class="ti-more"></i>Picked</a></li>
            <li class="{{ ($route === 'order.shipped.view') ? 'active' : '' }}"><a href="{{ route('order.shipped.view') }}"><i class="ti-more"></i>Shipped</a></li>
            <li class="{{ ($route === 'order.delivered.view') ? 'active' : '' }}"><a href="{{ route('order.delivered.view') }}"><i class="ti-more"></i>Delivered</a></li>
            <li class="{{ ($route === 'order.canceled.view') ? 'active' : '' }}"><a href="{{ route('order.canceled.view') }}"><i class="ti-more"></i>Canceled</a></li>
          </ul>
        </li> 


        <li class="treeview {{ ($prefix === '/report') ? 'active' : '' }}">
          <a href="#">
            <i class="fa-regular fa-clipboard"></i>
            <span>Report</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route === 'report.search') ? 'active' : '' }}"><a href="{{ route('report.search') }}"><i class="ti-more"></i>Search Report</a></li>
          </ul>
        </li> 

        {{-- ========== user ========= --}}
        <li class="treeview {{ ($prefix === '/user') ? 'active' : '' }}">
          <a href="#">
            <i class="fa-solid fa-user-tie"></i>
            <span>User</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route === 'user.all') ? 'active' : '' }}"><a href="{{ route('user.all') }}"><i class="ti-more"></i>All User</a></li>
          </ul>
        </li> 
        {{-- ========== end user ========= --}}


        {{-- ========== Slider ========= --}}
        <li class="treeview {{ ($prefix === '/slider') ? 'active' : '' }}">
          <a href="#">
            <i class="fa-regular fa-image"></i>
            <span>Slider</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route === 'slider.add') ? 'active' : '' }}"><a href="{{ route('slider.add') }}"><i class="ti-more"></i>Add Slider</a></li>
            <li class="{{ ($route === 'slider.view') ? 'active' : '' }}"><a href="{{ route('slider.view') }}"><i class="ti-more"></i>All Sliders</a></li>
          </ul>
        </li> 
        {{-- ========== end Slider ========= --}}


        {{-- ========== Site setting ========= --}}
        <li class="treeview {{ ($prefix === '/settings') ? 'active' : '' }}">
          <a href="#">
            <i class="fa-solid fa-user-tie"></i>
            <span>Settings</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route === 'site.setting') ? 'active' : '' }}"><a href="{{ route('site.setting') }}"><i class="ti-more"></i>Site Setting</a></li>
          </ul>
        </li> 
        {{-- ========== end Site setting ========= --}}


        <li class="treeview {{ ($prefix === '/slider') ? 'active' : '' }}">
          <a href="#">
            <i class="fa-regular fa-image"></i>
            <span>Slider</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li class="{{ ($route === 'slider.view') ? 'active' : '' }}"><a href="{{ route('slider.view') }}"><i class="ti-more"></i>All Sliders</a></li>
          </ul>
        </li> 
		  
        <li class="treeview">
          <a href="#">
            <i data-feather="mail"></i> <span>Mailbox</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="mailbox_inbox.html"><i class="ti-more"></i>Inbox</a></li>
            <li><a href="mailbox_compose.html"><i class="ti-more"></i>Compose</a></li>
            <li><a href="mailbox_read_mail.html"><i class="ti-more"></i>Read</a></li>
          </ul>
        </li>
		
        <li class="treeview">
          <a href="#">
            <i data-feather="file"></i>
            <span>Pages</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="profile.html"><i class="ti-more"></i>Profile</a></li>
            <li><a href="invoice.html"><i class="ti-more"></i>Invoice</a></li>
            <li><a href="gallery.html"><i class="ti-more"></i>Gallery</a></li>
            <li><a href="faq.html"><i class="ti-more"></i>FAQs</a></li>
            <li><a href="timeline.html"><i class="ti-more"></i>Timeline</a></li>
          </ul>
        </li> 		  
		 
        <li class="header nav-small-cap">User Interface</li>
		  
        <li class="treeview">
          <a href="#">
            <i data-feather="grid"></i>
            <span>Components</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="components_alerts.html"><i class="ti-more"></i>Alerts</a></li>
            <li><a href="components_badges.html"><i class="ti-more"></i>Badge</a></li>
          </ul>
        </li>
		
		<li class="treeview">
          <a href="#">
            <i data-feather="credit-card"></i>
            <span>Cards</span>
            <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
          </a>
          <ul class="treeview-menu">
			<li><a href="card_advanced.html"><i class="ti-more"></i>Advanced Cards</a></li>
			<li><a href="card_basic.html"><i class="ti-more"></i>Basic Cards</a></li>
			<li><a href="card_color.html"><i class="ti-more"></i>Cards Color</a></li>
		  </ul>
        </li>  
		  
        
        
      </ul>
    </section>
	
	<div class="sidebar-footer">
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Settings" aria-describedby="tooltip92529"><i class="ti-settings"></i></a>
		<!-- item-->
		<a href="mailbox_inbox.html" class="link" data-toggle="tooltip" title="" data-original-title="Email"><i class="ti-email"></i></a>
		<!-- item-->
		<a href="javascript:void(0)" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ti-lock"></i></a>
	</div>
  </aside>