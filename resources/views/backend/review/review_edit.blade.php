@extends('admin.admin_master')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Category </h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Review </li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Review </li>
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
                 <h3 class="box-title">Edit Review </h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <form method="POST" action="{{ route('review.update') }}">
                    @csrf
                        <input type="hidden" name="id" value="{{ $review->id }}">
                        <div class="form-group">
                            <h5>Product Name <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="" value="{{  $review->product->product_name }}" class="form-control" readonly> <div class="help-block"></div></div>
                        </div>
                        <div class="form-group">
                            <h5>User Name <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="" value="{{ $review->user->name }}" class="form-control" readonly> <div class="help-block"></div></div>
                        </div>
                        <div class="form-group">
                            <h5>Rating <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="rating" value="{{ $review->rating }}" class="form-control"> <div class="help-block"></div></div>
                        </div>
                        <div class="form-group">
                            <h5>Review <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <textarea name="review" class="form-control">{{ $review->review }}</textarea>
                                 <div class="help-block"></div></div>
                        </div>
                        <div class="form-group">
                            <div class="controls">
                                <input name="status" {{ $review->status==1 ? "checked" : "" }} type="radio" id="active" class="radio-col-success" value="1">
                                <label for="active">Aprove</label>
                                <input name="status" {{ $review->status==0 ? "checked" : "" }} type="radio" value="0" id="in_active" class="radio-col-danger">
                                <label for="in_active">Reject</label>
                            </div>
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