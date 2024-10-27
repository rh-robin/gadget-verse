@extends('admin.admin_master')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Shipping Area</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Shipping Area</li>
                        <li class="breadcrumb-item" aria-current="page">Division</li>
                        <li class="breadcrumb-item active" aria-current="page">Edit Division</li>
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
                 <h3 class="box-title">Edit Division</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                <form method="POST" action="{{ route('division.update', $division->id) }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <h5>Division Name <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="text" name="division_name" value="{{ old('division_name') ? old('division_name') : ucfirst($division->division_name) }}" class="form-control"> <div class="help-block"></div></div>
                            @error('division_name')
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