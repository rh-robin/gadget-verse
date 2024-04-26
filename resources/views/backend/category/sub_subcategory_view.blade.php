@extends('admin.admin_master')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Category</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Category</li>
                        <li class="breadcrumb-item active" aria-current="page">All Sub Sub-Categories</li>
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
                 <h3 class="box-title">Sub Sub-Category List</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <div class="table-responsive">
                     <table id="example1" class="table table-bordered table-striped">
                       <thead>
                           <tr>
                               <th width="15%" style="padding: 5px">Sub Sub-Category Name </th>
                               <th width="15%" style="padding: 5px">Parent Category</th>
                               <th width="15%" style="padding: 5px">Parent Sub-Category</th>
                               <th width="20%" style="padding: 5px">Status</th>
                               <th width="35%" style="padding: 5px">Action</th>
                           </tr>
                       </thead>
                       <tbody>
                        @forelse ($subsubcategories as $subsubcategory)
                        <tr>
                            <td width="15%" style="padding: 5px">{{ $subsubcategory->subsubcategory_name }}</td>
                            <td width="15%" style="padding: 5px">{{ $subsubcategory['category']['category_name'] }}</td>
                            <td width="15%" style="padding: 5px">{{ $subsubcategory['subcategory']['subcategory_name'] }}</td>
                            <td width="20%" style="padding: 5px">
                                @if($subsubcategory->status == 1)
                                <span class="badge badge-pill badge-success"> Active </span>
                                @else
                                <span class="badge badge-pill badge-danger"> InActive </span>
                                @endif
                            </td>
                            <td width="35%" style="padding: 5px" class="text-center">
                             <a href="{{ route('subsubcategory.edit',$subsubcategory->id) }}" class="btn btn-sm mx-1 btn-info" title="Edit Data"><i class="fa fa-pencil "></i></a>
                             <a href="{{ route('subsubcategory.delete',$subsubcategory->id) }}" id="delete" class="btn btn-sm mx-1 btn-danger" title="Delete Data"><i class="fa fa-trash "></i></a>
                             @if($subsubcategory->status == 1)
                                <a href="{{ route('subsubcategory.inactive',$subsubcategory->id) }}" class="btn btn-sm mx-1 btn-danger" title="Inactive Now"><i class="fa fa-arrow-down"></i> </a>
                            @else
                                <a href="{{ route('subsubcategory.active',$subsubcategory->id) }}" class="btn btn-sm mx-1 btn-success" title="Active Now"><i class="fa fa-arrow-up"></i> </a>
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
                 <h3 class="box-title">Add Sub Sub-Category</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <form method="POST" action="{{ route('subsubcategory.store') }}">
                    @csrf
                        <div class="form-group">
                            <h5>Sub Sub-Category Name <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="subsubcategory_name" value="{{ old('subsubcategory_name') }}" class="form-control"> <div class="help-block"></div></div>
                            @error('subsubcategory_name')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Select Category <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="category_id" id="select" class="form-control" aria-invalid="false">
                                    <option value="" selected disabled>Select Category</option>
                                    @foreach ($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            @error('category_id')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <h5>Select Sub-Category <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="subcategory_id" id="select" class="form-control" aria-invalid="false">
                                    <option value="" selected disabled>Select Sub-Category</option>
                                </select>
                            </div>
                            @error('subcategory_id')
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


{{-- scripts to get category wise subcategory --}}
<script type="text/javascript">
    $(document).ready(function(){
        $('select[name="category_id"]').on('change', function(){
            var category_id = $(this).val();
            if(category_id){
                $.ajax({
                    url: "{{ url('/admin/category/subcategory/ajax') }}/"+category_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data){
                        var d = $('select[name="subcategory_id"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="subcategory_id"]').append('<option value="'+value.id+'">'+value.subcategory_name+'</option>');
                        });
                    }
                });
            }else{
                alert('danger');
            }
        });
    });
</script>





@endsection