@extends('admin.admin_master')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">User</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">User</li>
                        <li class="breadcrumb-item active" aria-current="page">All Users</li>
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
                 <h3 class="box-title">User List <span class="badge badge-success">{{ count($users) }}</span></h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">
                     <table id="example1" class="table table-bordered table-striped">
                       <thead>
                           <tr>
                               <th width="" style="padding: 5px">Image</th>
                               <th width="" style="padding: 5px">Name</th>
                               <th width="" style="padding: 5px">Phone</th>
                               <th width="" style="padding: 5px">Email</th>
                               {{-- <th width="" style="padding: 5px">Status</th> --}}
                               <th width="20%" style="padding: 5px">Action</th>
                           </tr>
                       </thead>
                       <tbody>
                        @forelse ($users as $user)
                        <tr>
                            <td width="" style="padding: 5px"><img src="{{ !empty($user->profile_photo_path) ? url('upload/user_images/'.$user->profile_photo_path) : url('upload/noimage.jpg') }}" alt="" width="70px" height="auto"></td>
                            <td width="" style="padding: 5px">{{ $user->name }}</td>
                            <td width="" style="padding: 5px">{{ $user->phone }}</td>
                            <td width="" style="padding: 5px">{{ $user->email }}</td>
                            {{-- <td width="" style="padding: 5px">
                                @if ($user->userOnline())
                                <span class="badge badge-success">Active Now</span>
                                @else
                                <span class="badge badge-danger">{{ Carbon\Carbon::parse($user->last_seen)->diffForHumans() }}</span>
                                @endif
                            </td> --}}
                            
                            <td width="20%" style="padding: 5px" class="text-center">
                             <a href="" class="btn btn-sm mx-1 btn-info" title="Edit Data"><i class="fa fa-pencil "></i></a>
                             <a href="" id="delete" class="btn btn-sm mx-1 btn-danger" title="Delete Data"><i class="fa fa-trash "></i></a>
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
    </div> {{-- end row --}}

</section>






@endsection