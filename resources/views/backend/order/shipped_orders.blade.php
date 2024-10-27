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
                        <li class="breadcrumb-item active" aria-current="page">Shipped Orders</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="row">
        <div class="col-12">

            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Shipped Order List</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">
                     <table id="example1" class="table table-bordered table-striped">
                       <thead>
                           <tr>
                               <th style="padding: 5px">Date</th>
                               <th style="padding: 5px">Invoice</th>
                               <th style="padding: 5px">Amount</th>
                               <th style="padding: 5px">Payment Method</th>
                               <th style="padding: 5px">Order Confirmation (by user)</th>
                               <th style="padding: 5px">Status</th>
                               <th width="30%" style="padding: 5px">Action</th>
                           </tr>
                       </thead>
                       <tbody>
                        @forelse ($orders as $order)
                        <tr>
                            <td style="padding: 5px">{{ $order->order_date }}</td>
                            <td style="padding: 5px">{{ $order->invoice_no }}</td>
                            <td style="padding: 5px">{{ $order->amount }}</td>
                            <td style="padding: 5px">
                                @php
                                    $paymentMethod = "";
                                    if($order->payment_method == "cashon"){
                                        $paymentMethod = "Cash on delivery";
                                    }
                                @endphp
                                {{ $paymentMethod }}
                            </td>
                            <td style="padding: 5px">{{ ucfirst($order->order_confirmation) }}</td>
                            <td style="padding: 5px">
                                <span class="badge badge-pill badge-success"> {{ ucfirst($order->status) }} </span>
                            </td>
                            <td width="30%" style="padding: 5px" class="text-center">
                                <a href="{{ route('order.details', $order->id) }}" class="btn btn-sm mx-1 btn-info" title="View Order"><i class="fa fa-eye "></i></a>
                                <a href="{{ route('invoice.download', $order->id) }}" class="btn btn-sm mx-1 btn-info" title="Download Invoice"><i class="fa fa-download mr-1"></i>Invoice</a>
                            </td>
                        </tr>
                        @empty
                        @endforelse

                       </tbody>
                     </table>
                   </div>
               </div>
               <!-- /.box-body -->
             </div>
             <!-- /.box -->

                      
        </div> {{-- end col-12 --}}
        
    </div> {{-- end row --}}

</section>






@endsection