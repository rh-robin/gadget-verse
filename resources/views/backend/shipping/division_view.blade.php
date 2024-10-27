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
                        <li class="breadcrumb-item active" aria-current="page">All Divisions</li>
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
                  <h3 class="box-title">Division List</h3>
                </div>
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="table-responsive">
                      <table id="example1" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th style="padding: 5px">Division Name</th>
                                <th style="padding: 5px">Status</th>
                                <th width="30%" style="padding: 5px">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                         @forelse ($divisions as $division)
                         <tr>
                             <td style="padding: 5px">{{ ucfirst($division->division_name) }}</td>
                             <td style="padding: 5px">
                                 @if($division->status ==1)
                                 <span class="badge badge-pill badge-success"> Active </span>
                                 @else
                                 <span class="badge badge-pill badge-danger"> InActive </span>
                                 @endif
                             </td>
                             <td width="30%" style="padding: 5px" class="text-center">
                              <a href="{{ route('division.edit',$division->id) }}" class="btn btn-sm mx-1 btn-info" title="Edit Data"><i class="fa fa-pencil "></i></a>
                              <a href="{{ route('division.delete',$division->id) }}" id="delete" class="btn btn-sm mx-1 btn-danger" title="Delete Data"><i class="fa fa-trash "></i></a>
                              @if($division->status == 1)
                              <a href="{{ route('division.inactive',$division->id) }}" class="btn btn-sm mx-1 btn-danger" title="Inactive Now"><i class="fa fa-arrow-down"></i> </a>
                                 @else
                              <a href="{{ route('division.active',$division->id) }}" class="btn btn-sm mx-1 btn-success" title="Active Now"><i class="fa fa-arrow-up"></i> </a>
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
                 <h3 class="box-title">Add Division</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                <form method="POST" action="{{ route('division.store') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <h5>Division Name <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="text" name="division_name" value="{{ old('division_name') }}" class="form-control"> <div class="help-block"></div></div>
                            @error('division_name')
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