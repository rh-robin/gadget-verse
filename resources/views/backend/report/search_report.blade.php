@extends('admin.admin_master')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Report</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Report</li>
                        <li class="breadcrumb-item active" aria-current="page">All Reports</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="row">
        <div class="col-4">
            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Search By Date</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <form method="POST" action="{{ route('report-by-date') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <h5>Select Date <span class="text-danger"></span></h5>
                            <div class="controls">
                                <input type="date" name="date" value="{{ old('date') }}" class="form-control" max="{{ Carbon\Carbon::now()->format('Y-m-d') }}"> <div class="help-block"></div></div>
                            @error('date')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Search">
                        </div>
                   </form>
               </div>
               <!-- /.box-body -->
             </div>
             <!-- /.box -->
        </div> {{-- end col-4 --}}

        <div class="col-4">
            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Search By Month</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <form method="POST" action="{{ route('report-by-month') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <h5>Select Month <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="month" class="form-control" aria-invalid="false">
                                    <option value="" selected disabled>Select Month</option>
                                    <option value="January">January</option>
                                    <option value="February">February</option>
                                    <option value="March">March</option>
                                    <option value="April">April</option>
                                    <option value="May">May</option>
                                    <option value="June">June</option>
                                    <option value="July">July</option>
                                    <option value="August">August</option>
                                    <option value="September">September</option>
                                    <option value="October">October</option>
                                    <option value="November">November</option>
                                    <option value="December">December</option>
                                </select>
                            </div>
                            @error('month')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <h5>Select Year <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="year" class="form-control" aria-invalid="false">
                                    <option value="" selected disabled>Select Year</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                    <option value="2029">2029</option>
                                    <option value="2030">2030</option>
                                </select>
                            </div>
                            @error('year')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Search">
                        </div>
                   </form>
               </div>
               <!-- /.box-body -->
             </div>
             <!-- /.box -->
        </div> {{-- end col-4 --}}

        <div class="col-4">
            <div class="box">
               <div class="box-header with-border">
                 <h3 class="box-title">Search By Year</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                   <form method="POST" action="{{ route('report-by-year') }}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group">
                            <h5>Select Year <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <select name="year" class="form-control" aria-invalid="false">
                                    <option value="" selected disabled>Select Year</option>
                                    <option value="2024">2024</option>
                                    <option value="2025">2025</option>
                                    <option value="2026">2026</option>
                                    <option value="2027">2027</option>
                                    <option value="2028">2028</option>
                                    <option value="2029">2029</option>
                                    <option value="2030">2030</option>
                                </select>
                            </div>
                            @error('year')
                            <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <input type="submit" class="btn btn-rounded btn-primary mb-5" value="Search">
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