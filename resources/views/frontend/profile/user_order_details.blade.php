@extends('frontend.main_master')

@section('title')
Order Details
@endsection

@section('content')

<div class="main">
    <div class="page-header">
		<div class="container d-flex flex-column align-items-center">
			<nav aria-label="breadcrumb" class="breadcrumb-nav">
				<div class="container">
					<ol class="breadcrumb">
						<li class="breadcrumb-item"><a href="/">Home</a></li>
						<li class="breadcrumb-item" >My Account</li>
						<li class="breadcrumb-item active" aria-current="page">Orders</li>
					</ol>
				</div>
			</nav>

			<h1>Order Details</h1>
		</div>
	</div>
    <div class="container my-5">
        <div class="row user-profile">
            <div class="col-md-2">
                @include('frontend.profile.user_menu')
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Shipping Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Division</th>
                                    <td>{{ ucfirst($order->shippingDetails->division->division_name) }}</td>
                                </tr>
                                <tr>
                                    <th>District</th>
                                    <td>{{ ucfirst($order->shippingDetails->district->district_name) }}</td>
                                </tr>
                                <tr>
                                    <th>Address</th>
                                    <td>{{ $order->shippingDetails->address }}</td>
                                </tr>
                                <tr>
                                    <th>Post Code</th>
                                    <td>{{ $order->shippingDetails->post_code }}</td>
                                </tr>
                                <tr>
                                    <th>Shipping Name</th>
                                    <td>{{ $order->shippingDetails->shipping_name }}</td>
                                </tr>
                                <tr>
                                    <th>Shipping Email</th>
                                    <td>{{ $order->shippingDetails->shipping_email }}</td>
                                </tr>
                                <tr>
                                    <th>Shipping Phone</th>
                                    <td>{{ $order->shippingDetails->shipping_phone }}</td>
                                </tr>
                                <tr>
                                    <th>Notes</th>
                                    <td>{{ $order->shippingDetails->notes }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Order Details</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Invoice</th>
                                    <td>{{ $order->invoice_no }}</td>
                                </tr>
                                <tr>
                                    <th>Order Date</th>
                                    <td>{{ $order->order_confirmation }}</td>
                                </tr>
                                <tr>
                                    <th>Sub Total Amount</th>
                                    <td>{{ $order->subtotal_amount }}</td>
                                </tr>
                                @if ($order->coupon !== null)
                                <tr>
                                    <th>Coupon</th>
                                    <td>{{ $order->coupon }}</td>
                                </tr>
                                <tr>
                                    <th>Discount Amount</th>
                                    <td>-{{ $order->discount_amount }}</td>
                                </tr>
                                @endif
                                <tr>
                                    <th>Shipping Charge</th>
                                    <td>{{ $order->shipping_charge }}</td>
                                </tr>
                                <tr>
                                    <th>Total amount</th>
                                    <td>{{ $order->amount }} (including shiping charge)</td>
                                </tr>
                                @if ($order->payment_method == "cashon")
                                <tr>
                                    <th>Payment Method</th>
                                    <td>Cash on delivery</td>
                                </tr>
                                @endif
                                
                                <tr>
                                    <th>status</th>
                                    <td><span class="badge badge-primary">{{ ucfirst($order->status) }}</span></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-10 ml-auto">
                <div class="card">
                    <div class="card-header">
                        <h3 class="text-center">Order Items</h3>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <th>Image</th>
                                    <th>Product Name</th>
                                    <th>Color</th>
                                    <th>Size</th>
                                    <th>Quantity</th>
                                    <th>Unit price</th>
                                    <th>Sub Total</th>
                                </tr>
                                @foreach ($orderItems as $item)
                                    
                                <tr>
                                    <td style="vertical-align: middle;"><img src="{{ asset($item->product_image) }}" alt="" width="70px" height="auto"></td>
                                    <td style="vertical-align: middle;">{{ $item->product_name }}</td>
                                    <td style="vertical-align: middle;">{{ $item->color }}</td>
                                    <td style="vertical-align: middle;">{{ $item->size }}</td>
                                    <td style="vertical-align: middle;">{{ $item->qty }}</td>
                                    <td style="vertical-align: middle;">{{ $item->price }}</td>
                                    <td style="vertical-align: middle;">{{ $item->price*$item->qty }}</td>
                                </tr>

                                @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.container --> 
</div>

@endsection



