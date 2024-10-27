@extends('admin.admin_master')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Coupon</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Coupon</li>
                        <li class="breadcrumb-item active" aria-current="page">All Coupons</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="row">
        <div class="col-8">

            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Coupon List</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">
                     <table id="example1" class="table table-bordered table-striped">
                       <thead>
                           <tr>
                               <th style="padding: 5px">Coupon Code</th>
                               <th style="padding: 5px">Amount</th>
                               <th style="padding: 5px">Expire Date</th>
                               <th style="padding: 5px">Validity</th>
                               <th style="padding: 5px">Status</th>
                               <th width="30%" style="padding: 5px">Action</th>
                           </tr>
                       </thead>
                       <tbody>
                        @forelse ($coupons as $coupon)
                        <tr>
                            <td style="padding: 5px">{{ $coupon->code }}</td>
                            <td style="padding: 5px">{{ $coupon->value }}</td>
                            <td style="padding: 5px">{{ Carbon\Carbon::parse($coupon->validity)->format('D, d F Y') }}</td>
                            <td style="padding: 5px">
                                @if($coupon->validity >= Carbon\Carbon::now()->format('Y-m-d'))
                                <span class="badge badge-pill badge-success"> Valid </span>
                                @else
                                <span class="badge badge-pill badge-danger"> InValid </span>
                                @endif
                            </td>
                            <td style="padding: 5px">
                                @if($coupon->status ==1)
                                <span class="badge badge-pill badge-success"> Active </span>
                                @else
                                <span class="badge badge-pill badge-danger"> InActive </span>
                                @endif
                            </td>
                            <td width="30%" style="padding: 5px" class="text-center">
                             <a href="{{ route('coupon.edit',$coupon->id) }}" class="btn btn-sm mx-1 btn-info" title="Edit Data"><i class="fa fa-pencil "></i></a>
                             <a href="{{ route('coupon.delete',$coupon->id) }}" id="delete" class="btn btn-sm mx-1 btn-danger" title="Delete Data"><i class="fa fa-trash "></i></a>
                             @if($coupon->status == 1)
                             <a href="{{ route('coupon.inactive',$coupon->id) }}" class="btn btn-sm mx-1 btn-danger" title="Inactive Now"><i class="fa fa-arrow-down"></i> </a>
                                @else
                             <a href="{{ route('coupon.active',$coupon->id) }}" class="btn btn-sm mx-1 btn-success" title="Active Now"><i class="fa fa-arrow-up"></i> </a>
                             @endif
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

                      
        </div> {{-- end col-8 --}}
        <div class="col-4">

            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Add Coupon</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <form method="POST" action="{{ route('coupon.store') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <h5>Coupon Code <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="text" name="code" value="{{ old('code') }}" class="form-control"> <div class="help-block"></div></div>
                            @error('code')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Amount <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="number" name="value" value="{{ old('value') }}" class="form-control"> <div class="help-block"></div></div>
                            @error('value')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Type <span class="text-danger"></span></h5>
                            <div class="controls">
                                <select class="form-select form-control" name="type" aria-label="Default select example">
                                    <option selected>Select Type</option>
                                    <option value="1">Fixed</option>
                                    <option value="2">Percentage</option>
                                </select>
                                <div class="help-block"></div></div>
                            @error('type')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Validity <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="date" name="validity" value="{{ old('validity') }}" class="form-control" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}"> <div class="help-block"></div></div>
                            @error('validity')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Cart minimum Amount <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="number" name="cart_value" class="form-control"> <div class="help-block"></div></div>
                            @error('cart_value')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Add New">
                        </div>
                   </form>
               </div>
               <!-- /.box-body -->
             </div>
             <!-- /.box -->

                      
        </div> {{-- end col-4 --}}
    </div> {{-- end row --}}

</section>






@endsection