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
                        <li class="breadcrumb-item active" aria-current="page">Edit Coupon</li>
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
                 <h3 class="box-title">Add Coupon</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                    <form method="POST" action="{{ route('coupon.update', $coupon->id) }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <h5>Coupon Code <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="text" name="code" value="{{ old('code') ? old('code') : ($coupon->code ?? '') }}" class="form-control">
                                <div class="help-block"></div>
                            </div>
                            @error('code')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Amount <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="number" name="value" value="{{ old('value') ? old('value') : ($coupon->value ?? '') }}" class="form-control">
                                <div class="help-block"></div>
                            </div>
                            @error('value')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Type <span class="text-danger"></span></h5>
                            <div class="controls">
                                <select class="form-select form-control" name="type" aria-label="Default select example">
                                    <option value="1" {{ (old('type') ? old('type') : ($coupon->type ?? '')) == 1 ? 'selected' : '' }}>Fixed</option>
                                    <option value="2" {{ (old('type') ? old('type') : ($coupon->type ?? '')) == 2 ? 'selected' : '' }}>Percentage</option>
                                </select>
                                <div class="help-block"></div>
                            </div>
                            @error('type')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Validity <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="date" name="validity" value="{{ old('validity') ? old('validity') : ($coupon->validity ?? '') }}" class="form-control" min="{{ Carbon\Carbon::now()->format('Y-m-d') }}">
                                <div class="help-block"></div>
                            </div>
                            @error('validity')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Cart minimum Amount <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="number" name="cart_value" value="{{ old('cart_value') ? old('cart_value') : ($coupon->cart_value ?? '') }}" class="form-control">
                                <div class="help-block"></div>
                            </div>
                            @error('cart_value')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Update">
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