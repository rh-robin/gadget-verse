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
                        <li class="breadcrumb-item active" aria-current="page">All Sliders</li>
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
                 <h3 class="box-title">Slider List</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">
                     <table id="example1" class="table table-bordered table-striped">
                       <thead>
                           <tr>
                               <th style="padding: 5px">#</th>
                               <th style="padding: 5px">Slider Name</th>
                               <th width="30%" style="padding: 5px">Action</th>
                           </tr>
                       </thead>
                       <tbody>
                        @forelse ($sliders as $index => $slider)
                        <tr>
                            <td style="padding: 5px">{{ $index+1 }}</td>
                            <td style="padding: 5px">{{ $slider->slider_name }}</td>
                            <td width="30%" style="padding: 5px" class="text-center">
                             <a href="{{ route('slider.edit',$slider->id) }}" class="btn btn-sm mx-1 btn-info" title="Edit Data"><i class="fa fa-pencil "></i></a>
                             <a href="{{ route('slider.delete',$slider->id) }}" id="delete" class="btn btn-sm mx-1 btn-danger" title="Delete Data"><i class="fa fa-trash "></i></a>
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
                 <h3 class="box-title">Add Slider</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <form method="POST" action="{{ route('slider.store') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <h5>Slider Name <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="text" name="slider_name" value="{{ old('slider_name') }}" class="form-control"> <div class="help-block"></div></div>
                            @error('slider_name')
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