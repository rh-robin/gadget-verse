@extends('admin.admin_master')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Review</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Review</li>
                        <li class="breadcrumb-item active" aria-current="page">All Reviews</li>
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
                 <h3 class="box-title">Review List</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">
                     <table id="example1" class="table table-bordered table-striped">
                       <thead>
                           <tr>
                               <th width="" style="padding: 5px">Product Name</th>
                               <th width="" style="padding: 5px">User Name </th>
                               <th width="" style="padding: 5px">Rating</th>
                               <th width="" style="padding: 5px">Review</th>
                               <th width="" style="padding: 5px">Status</th>
                               <th width="25%" style="padding: 5px">Action</th>
                           </tr>
                       </thead>
                       <tbody>
                        @forelse ($reviews as $review)
                        <tr>
                            <td width="" style="padding: 5px">{{ $review->product->product_name }}</td>
                            <td width="" style="padding: 5px">{{ $review->user->name }}</td>
                            <td width="" style="padding: 5px">{{ $review->rating }}</td>
                            <td width="" style="padding: 5px">{{ $review->review }}</td>
                            <td width="" style="padding: 5px">
                                @if($review->status == 1)
                                <span class="badge badge-pill badge-success"> Approved </span>
                                @else
                                <span class="badge badge-pill badge-danger"> Not Approved </span>
                                @endif
                            </td>
                            <td width="25%" style="padding: 5px" class="text-center">
                             <a href="{{ route('review.edit',$review->id) }}" class="btn btn-sm mx-1 btn-info" title="Edit Data"><i class="fa fa-pencil "></i></a>
                             <a href="{{ route('review.delete',$review->id) }}" id="delete" class="btn btn-sm mx-1 btn-danger" title="Delete Data"><i class="fa fa-trash "></i></a>
                             @if($review->status == 1)
                                <a href="{{ route('review.reject',$review->id) }}" class="btn btn-sm mx-1 btn-danger" title="Reject"><i class="fa-regular fa-thumbs-down"></i> </a>
                                    @else
                                <a href="{{ route('review.approve',$review->id) }}" class="btn btn-sm mx-1 btn-success" title="Approve"><i class="fa-regular fa-thumbs-up"></i> </a>
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

                      
        </div> {{-- end col-12 --}}
    </div> {{-- end row --}}

</section>






@endsection