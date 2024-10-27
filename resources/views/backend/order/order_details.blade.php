@extends('admin.admin_master')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Order</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Order</li>
                        <li class="breadcrumb-item active" aria-current="page">Order Details</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="row">
        <div class="col-md-6 col-12">
            <div class="box">			  
                <div class="box-header with-border">
                    <h4 class="box-title">Shipping Details <strong></strong></h4>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        @if ($order->shippingDetails->division != null)
                        <tr>
                            <th>Division</th>
                            <td>{{ ucfirst($order->shippingDetails->division->division_name) }}</td>
                        </tr>
                        @endif

                        @if ($order->shippingDetails->district != null)
                        <tr>
                            <th>District</th>
                            <td>{{ ucfirst($order->shippingDetails->district->district_name) }}</td>
                        </tr>
                        @endif
                        
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
        </div> {{-- end shipping details --}}

        <div class="col-md-6 col-12">
            <div class="box">			  
                <div class="box-header with-border">
                    <h4 class="box-title">Order Details <strong></strong></h4>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Invoice</th>
                            <td class="text-danger">{{ $order->invoice_no }}</td>
                        </tr>
                        <tr>
                            <th>Order Date</th>
                            <td>{{ $order->order_date }}</td>
                        </tr>
                        <tr>
                            <th>User Confirmation</th>
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
                        <tr>
                            <th></th>
                            <td>
                                @if ($order->status == "pending")
                                <a href="{{ route('pending-accept', $order->id) }}" class="btn btn-block btn-success" id="accept">Accept</a>
                                <a href="{{ route('pending-cancel', $order->id) }}" class="btn btn-block btn-danger" id="canceled">Cancel</a>
                                @endif

                                @if ($order->status == "canceled")
                                <a href="{{ route('pending-accept', $order->id) }}" class="btn btn-block btn-success" id="accept">Accept</a>
                                @endif

                                @if ($order->status == "accepted")
                                <a href="{{ route('accept-processing', $order->id) }}" class="btn btn-block btn-success" id="processing">Processing</a>
                                @endif

                                @if ($order->status == "processing")
                                <a href="{{ route('processing-picked', $order->id) }}" class="btn btn-block btn-success" id="picked">Picked</a>
                                @endif

                                @if ($order->status == "picked")
                                <a href="{{ route('picked-shipped', $order->id) }}" class="btn btn-block btn-success" id="shipped">Shipped</a>
                                @endif

                                @if ($order->status == "shipped")
                                <a href="{{ route('shipped-delivered', $order->id) }}" class="btn btn-block btn-success" id="delivered">Delivered</a>
                                @endif
                                
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div> {{-- end order details --}}

        <div class="col-md-12 col-12">
            <div class="box">			  
                <div class="box-header with-border">
                    <h4 class="box-title">Order Items <strong></strong></h4>
                </div>
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
        </div> {{-- end order items --}}
        
    </div> {{-- end row --}}

</section>






@endsection