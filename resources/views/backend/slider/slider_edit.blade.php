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
                        <li class="breadcrumb-item active" aria-current="page">Edit Slider Items</li>
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
                    <form method="POST" action="{{ route('slider.update') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $slider->id }}">
                        <div class="row">
                            @foreach(range(0, 2) as $index)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Title <span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input type="text" name="title[{{ $index }}]" value="{{ old('title.'.$index, $sliderItems[$index]->title ?? '') }}" class="form-control">
                                        <div class="help-block"></div>
                                    </div>
                                    @error('title.'.$index)
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div>
                    
                                <div class="form-group">
                                    <h5>Sub Title <span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input type="text" name="sub_title[{{ $index }}]" value="{{ old('sub_title.'.$index, $sliderItems[$index]->sub_title ?? '') }}" class="form-control">
                                        <div class="help-block"></div>
                                    </div>
                                    @error('sub_title.'.$index)
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div>
                    
                                <div class="form-group">
                                    <h5>Image <span class="text-danger">*</span></h5>
                                    <img id="showImage{{ $index+1 }}" class="avatar-bordered mb-3" style="width: 100px; height:auto" src="{{ !empty($sliderItems[$index]->image_source) ? url($sliderItems[$index]->image_source) : url('upload/noimage.jpg') }}" alt="">
                                    <div class="controls">
                                        <input type="file" name="slider_image[{{ $index }}]" id="slider_image{{ $index+1 }}" class="form-control">
                                        <div class="help-block"></div>
                                    </div>
                                    @error('slider_image.'.$index)
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <h5>Button Link <span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input type="text" name="button_link[{{ $index }}]" value="{{ old('button_link.'.$index, $sliderItems[$index]->button_link ?? '') }}" class="form-control">
                                        <div class="help-block"></div>
                                    </div>
                                    @error('button_link.'.$index)
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div>
                            </div>
                            @endforeach
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
        $('#slider_image1').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage1').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });

        $('#slider_image2').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage2').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });

        $('#slider_image3').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage3').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>





@endsection