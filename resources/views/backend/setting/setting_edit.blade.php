@extends('admin.admin_master')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Setting</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Setting</li>
                        <li class="breadcrumb-item active" aria-current="page">Site Setting</li>
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
                 <h3 class="box-title">Edit Setting</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <form method="POST" action="{{ route('setting.update') }}" enctype="multipart/form-data">
                    @csrf
                        <input type="hidden" name="id" value="{{ $setting->id }}">
                        <input type="hidden" name="old_image" value="{{ $setting->logo }}">
                        <div class="form-group">
                            <h5>Logo <span class="text-danger">*</span></h5>
                            <img id="showImage" class="avatar-bordered mb-3" style="width: 200px; height:auto" src="{{ !empty($setting->logo) ? url($setting->logo) : url('upload/noimage.jpg') }}" alt="">
                            <div class="controls">
                                <input type="file" id="logo" name="logo" class="form-control"> <div class="help-block"></div></div>
                            @error('logo')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <h5>Company Name <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="text" name="company_name" value="{{ old('company_name') ?? $setting->company_name }}" class="form-control"> <div class="help-block"></div></div>
                            @error('company_name')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <h5>Address <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="text" name="address" value="{{ old('address') ?? $setting->address }}" class="form-control"> <div class="help-block"></div></div>
                            @error('address')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <h5>Phone One <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="text" name="phone_one" value="{{ old('phone_one') ?? $setting->phone_one }}" class="form-control"> <div class="help-block"></div></div>
                            @error('phone_one')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <h5>Phone Two <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="text" name="phone_two" value="{{ old('phone_two') ?? $setting->phone_two }}" class="form-control"> <div class="help-block"></div></div>
                            @error('phone_two')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <h5>Email <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="email" value="{{ old('email') ?? $setting->email }}" class="form-control"> <div class="help-block"></div></div>
                            @error('email')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <h5>Facebook <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="text" name="facebook" value="{{ old('facebook') ?? $setting->facebook }}" class="form-control"> <div class="help-block"></div></div>
                            @error('facebook')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <h5>Twitter <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="text" name="twitter" value="{{ old('twitter') ?? $setting->twitter }}" class="form-control"> <div class="help-block"></div></div>
                            @error('twitter')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <h5>Linked-in <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="text" name="linkedin" value="{{ old('linkedin') ?? $setting->linkedin }}" class="form-control"> <div class="help-block"></div></div>
                            @error('linkedin')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <h5>Youtube <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="text" name="youtube" value="{{ old('youtube') ?? $setting->youtube }}" class="form-control"> <div class="help-block"></div></div>
                            @error('youtube')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <h5>Instagram <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="text" name="instagram" value="{{ old('instagram') ?? $setting->instagram }}" class="form-control"> <div class="help-block"></div></div>
                            @error('instagram')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <h5>Referral Code Discount(%) <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="number" name="refer_discount" value="{{ old('refer_discount') ?? $setting->refer_discount }}" class="form-control"> <div class="help-block"></div></div>
                            @error('refer_discount')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <h5>Delivery Charge Inside Dhaka City(tk)<span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="number" name="inside_dhaka" value="{{ old('inside_dhaka') ?? $setting->inside_dhaka }}" class="form-control"> <div class="help-block"></div></div>
                            @error('inside_dhaka')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <h5>Delivery Charge Outside Dhaka City(tk) <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="number" name="outside_dhaka" value="{{ old('outside_dhaka') ?? $setting->outside_dhaka }}" class="form-control"> <div class="help-block"></div></div>
                            @error('outside_dhaka')
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
        $('#logo').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        });
    });
</script>




@endsection