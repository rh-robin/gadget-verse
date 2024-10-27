@extends('frontend.main_master')

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

			<h1>All Orders</h1>
		</div>
	</div>
    <div class="container my-5">
        <div class="row user-profile">
            <div class="col-md-3">
                @include('frontend.profile.user_menu')
            </div>
            <div class="col-md-1"></div>
            <div class="col-md-8">
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Date</th>
                                <th scope="col">Total</th>
                                <th scope="col">Invoice</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)
                                
                            <tr>
                                <td>{{ $order->order_date}}</td>
                                <td>{{ $order->amount}}tk</td>
                                <td>{{ $order->invoice_no}}</td>
                                <td><span class="badge badge-primary">{{ ucfirst($order->status) }}</span></td>
                                <td>
                                    <a href="{{ route('user.order.details', $order->id) }}" class="btn btn-sm btn-info btn-rounded"><i class="fa-solid fa-eye mr-2"></i>View</a>
                                    <a href="{{ route('user.order.invoice', $order->id) }}" class="btn btn-sm btn-danger btn-rounded"><i class="fa-solid fa-download mr-2"></i>Invoice</a>
                                </td>
                            </tr>
                            @empty
                                <tr>
                                    <td colspan="5"><p>You didn't place any order</p></td>
                                </tr>
                            @endforelse
                          </tbody>
                    </table>
                  </div>
            </div>
        </div>
    </div>
    <!-- /.container --> 
</div>

@endsection



