@extends('admin.admin_master')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Slider</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Slider</li>
                        <li class="breadcrumb-item active" aria-current="page">Add Slider Items</li>
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
                 <h3 class="box-title">Add Slider Items</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <form method="POST" action="{{ route('slider.store') }}" enctype="multipart/form-data">
                    @csrf
                        <input type="hidden" name="id" value="{{ $slider->id }}">
                        <div class="form-group">
                            <h5>Title <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="text" name="title" value="{{ old('title') }}" class="form-control"> <div class="help-block"></div></div>
                            @error('title')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>


                        <div class="form-group">
                            <h5>Sub Title <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="text" name="sub_title" value="{{ old('sub_title') }}" class="form-control"> <div class="help-block"></div></div>
                            @error('sub_title')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <h5>Image <span class="text-danger">*</span></h5>
                            <img id="showImage" class="avatar-bordered mb-3" style="width: 200px; height:auto" src="{{ !empty($slider->slider_image) ? url($slider->slider_image) : url('upload/noimage.jpg') }}" alt="">
                            <div class="controls">
                                <input type="file" name="slider_image" id="slider_image" class="form-control"> <div class="help-block"></div></div>
                            @error('slider_image')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Button Link <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="text" name="button_link" value="{{ old('button_link') }}" class="form-control"> <div class="help-block"></div></div>
                            @error('button_link')
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


{{-- show selected image with jquery --}}
<script type="text/javascript">
    $(document).ready(function(){
        $('#slider_image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>





@endsection