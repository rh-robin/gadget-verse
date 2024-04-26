@extends('admin.admin_master')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Color</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Color</li>
                        <li class="breadcrumb-item active" aria-current="page">All Colors</li>
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
                 <h3 class="box-title">Color List</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">
                     <table id="example1" class="table table-bordered table-striped">
                       <thead>
                           <tr>
                               <th style="padding: 5px">Color Name English</th>
                               <th style="padding: 5px">Color Name Bangla</th>
                               <th style="padding: 5px">Color Code</th>
                               <th style="padding: 5px">Color</th>
                               <th style="padding: 5px">Status</th>
                               <th width="30%" style="padding: 5px">Action</th>
                           </tr>
                       </thead>
                       <tbody>
                        @forelse ($colors as $color)
                        <tr>
                            <td style="padding: 5px">{{ $color->color_name_en }}</td>
                            <td style="padding: 5px">{{ $color->color_name_bn }}</td>
                            <td style="padding: 5px">{{ $color->color_code }}</td>
                            <td style="padding: 5px">{{ $color->color_code }}</td>
                            <td style="padding: 5px">
                                @if($color->color_status == 1)
                                <span class="badge badge-pill badge-success"> Active </span>
                                @else
                                <span class="badge badge-pill badge-danger"> InActive </span>
                                @endif
                            </td>
                            <td width="30%" style="padding: 5px" class="text-center">
                             <a href="{{ route('color.edit',$color->id) }}" class="btn btn-sm mx-1 btn-info" title="Edit Data"><i class="fa fa-pencil "></i></a>
                             <a href="{{ route('color.delete',$color->id) }}" id="delete" class="btn btn-sm mx-1 btn-danger" title="Delete Data"><i class="fa fa-trash "></i></a>
                             @if($color->color_status == 1)
                             <a href="{{ route('color.inactive',$color->id) }}" class="btn btn-sm mx-1 btn-danger" title="Inactive Now"><i class="fa fa-arrow-down"></i> </a>
                                @else
                             <a href="{{ route('color.active',$color->id) }}" class="btn btn-sm mx-1 btn-success" title="Active Now"><i class="fa fa-arrow-up"></i> </a>
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
                 <h3 class="box-title">Add Color</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <form method="POST" action="{{ route('slider.store') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <h5>Color Name English <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="title_en" value="{{ old('color_name_en') }}" class="form-control"> <div class="help-block"></div></div>
                            @error('color_name_bn')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Color Name Bangla <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="text" name="title_bn" value="{{ old('color_name_bn') }}" class="form-control"> <div class="help-block"></div></div>
                            @error('color_name_bn')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Color Code <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="description_en" value="{{ old('description_en') }}" class="form-control"> <div class="help-block"></div></div>
                            @error('description_en')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Description Bangla <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="text" name="description_bn" value="{{ old('description_bn') }}" class="form-control"> <div class="help-block"></div></div>
                            @error('description_bn')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Slider Image <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="file" name="slider_image" class="form-control"> <div class="help-block"></div></div>
                            @error('slider_image')
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