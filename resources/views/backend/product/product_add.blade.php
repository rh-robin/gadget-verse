@extends('admin.admin_master')

@section('content')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="d-flex align-items-center">
        <div class="mr-auto">
            <h3 class="page-title">Product</h3>
            <div class="d-inline-block align-items-center">
                <nav>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#"><i class="mdi mdi-home-outline"></i></a></li>
                        <li class="breadcrumb-item" aria-current="page">Product</li>
                        <li class="breadcrumb-item active" aria-current="page">Add Product</li>
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
                 <h3 class="box-title">Fill The Form To Add Product</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                    <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row"> {{-- start 1st row --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Select Brand <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="brand_id" id="select" class="form-control" aria-invalid="false">
                                            <option value="" selected disabled>Select Brand</option>
                                            @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}">{{ $brand->brand_name_en }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('category_id')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div> {{-- end form group --}}
                            </div>{{-- end col-md-4 --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Select Category <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="category_id" id="select" class="form-control" aria-invalid="false">
                                            <option value="" selected disabled>Select Category</option>
                                            @foreach ($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('category_id')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div> {{-- end form group --}}
                            </div>{{-- end col-md-4 --}}
                            <div class="col-md-4">
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
                                </div> {{-- end form group --}}
                            </div>{{-- end col-md-4 --}}
                        </div> {{-- end 1st row --}}

                        <div class="row"> {{-- start 2nd row --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Select Sub Sub-Category <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="subsubcategory_id" id="select" class="form-control" aria-invalid="false">
                                            <option value="" selected disabled>Select Sub Sub-Category</option>
                                        </select>
                                    </div>
                                    @error('subsubcategory_id')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div> {{-- end form group --}}
                            </div> {{-- end col-md-4 --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Name <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input type="text" name="product_name" value="" class="form-control"> <div class="help-block"></div></div>
                                    @error('product_name')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div> {{-- end form group --}}
                            </div>{{-- end col-md-4 --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Tags <span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input name="product_tags" class="form-control" type="text" value="Lorem,Ipsum,Amet" data-role="tagsinput" placeholder="add tags" /> <div class="help-block"></div>
                                    </div>
                                    @error('product_tags')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div> {{-- end form group --}}
                            </div> {{-- end col-md-4 --}}
                        </div> {{-- end 2nd row --}}

                        <div class="row"> {{-- start 3rd row --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Thumbnail <span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input type="file" name="product_thumbnail" value="" class="form-control" onChange="mainThumbUrl(this)"> <div class="help-block"></div>
                                    </div>
                                    <img src="" alt="" id="mainThumb">
                                    @error('product_thumbnail')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div> {{-- end form group --}}
                            </div>{{-- end col-md-4 --}}
                            <div class="col-md-8">
                                <div class="form-group">
                                    <h5>Short Description <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="short_desc" id="textarea" class="form-control"></textarea> <div class="help-block"></div>
                                    </div>
                                    @error('short_desc')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div> {{-- end form group --}}
                            </div>{{-- end col-md-4 --}}
                        </div> {{-- end 3rd row --}}

                        <div class="row"> {{-- start 4th row --}}
                            <div class="col-md-12">
                                <div class="form-group">
                                    <h5>Long Description<span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea id="editor1" name="long_desc" rows="10" cols="80">
                                            Long Description 
                                        </textarea> <div class="help-block"></div>
                                    </div>
                                    @error('long_desc')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div> {{-- end form group --}}
                            </div> {{-- end col-md-12 --}}
                        </div> {{-- end 4th row --}}


                        <div class="row"> {{-- start 4th row --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Sizes <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input id="product_sizes" name="product_sizes" class="form-control" type="text" value="s,m" data-role="tagsinput" placeholder="add sizes" /> <div class="help-block"></div>
                                    </div>
                                    @error('product_sizes')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div> {{-- end form group --}}
                            </div>{{-- end col-md-4 --}}
                        </div> {{-- end 4th row --}}

                        <div class="color-container">
                            <div class="row"> {{-- start 6th row --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Color Name <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input id="color_name" type="text" name="color_names[]" value="" class="form-control"> <div class="help-block"></div>
                                        </div>
                                    </div> {{-- end form group --}}
                                </div>{{-- end col-md-4 --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Color Code <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input id="color_code" type="text" name="color_codes[]" value="" class="form-control"> <div class="help-block"></div>
                                        </div>
                                    </div> {{-- end form group --}}
                                </div>
                                <div class="col-md-4 d-flex flex-column justify-content-end">
                                    <div class="form-group">
                                        <a type="button" class="btn btn-rounded btn-warning add-color-row">Add more</a>

                                    </div>
                                </div>
                            </div> {{-- end 6th row --}}
                        </div> {{-- end color-container --}}
                        

                        <div class="row"> {{-- start 7th row --}}
                            <div class="col-md-4 d-flex flex-column justify-content-end">
                                <div class="form-group">
                                    <a id="add_prices_btn" class="btn btn-rounded btn-warning">Add Prices</a>
                                    
                                </div>
                            </div>
                        </div> {{-- end 7th row --}}

                        <div class="combination-wise-price">
                            
                        </div> {{-- end combination-wise-price --}}



                        <div class="row"> {{-- start 9th row --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <fieldset>
											<input type="checkbox" id="checkbox_2" name="hot_deals" value="1">
											<label for="checkbox_2">Hot Deals</label>
										</fieldset>
										<fieldset>
											<input type="checkbox" id="checkbox_3" value="1" name="featured">
											<label for="checkbox_3">Featured</label>
										</fieldset> <div class="help-block"></div>
                                    </div>
                                </div> {{-- end form group --}}
                            </div> {{-- end col-md-6 --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <fieldset>
											<input type="checkbox" id="checkbox_4" value="1" name="special_offer">
											<label for="checkbox_4">Special Offers</label>
										</fieldset>
										<fieldset>
											<input type="checkbox" id="checkbox_5" value="1" name="special_deals">
											<label for="checkbox_5">Special Deals</label>
										</fieldset> <div class="help-block"></div>
                                    </div>
                                </div> {{-- end form group --}}
                            </div>{{-- end col-md-6 --}}
                        </div> {{-- end 9th row --}}
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



<script type="text/javascript">
    $(document).ready(function(){
        /* scripts to get category wise subcategory */
        $('select[name="category_id"]').on('change', function(){
            var category_id = $(this).val();
            if(category_id){
                $.ajax({
                    url: "{{ url('/admin/category/subcategory/ajax') }}/"+category_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data){
                        var d = $('select[name="subcategory_id"]').empty();
                        d = d.append('<option value="" selected disabled>Select Sub-Category</option>')
                        $.each(data, function(key, value){
                            d.append('<option value="'+value.id+'">'+value.subcategory_name+'</option>');
                        });
                    }
                });
            }else{
                alert('danger');
            }
        });

        /* scripts to get subcategory wise subsubcategory */
        $('select[name="subcategory_id"]').on('change', function(){
            var subcategory_id = $(this).val();
            if(subcategory_id){
                $.ajax({
                    url: "{{ url('/admin/category/subsubcategory/ajax') }}/"+subcategory_id,
                    type: "GET",
                    dataType: "json",
                    success: function(data){
                        console.log(data);
                        var d = $('select[name="subsubcategory_id"]').empty();
                        d = d.append('<option value="" selected disabled>Select Sub Sub-Category</option>')
                        $.each(data, function(key, value){
                            d.append('<option value="'+value.id+'">'+value.subsubcategory_name+'</option>');
                        });
                    }
                });
            }else{
                alert('danger');
            }
        });
    });
</script>


{{-- sripts to preview selected image --}}
<script type="text/javascript">
    function mainThumbUrl(input){
        if(input.files && input.files[0]){
            var reader =  new FileReader();
            reader.onload = function(e){
                $('#mainThumb').attr('src',e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>


{{-- scripts to add color row on click "add more" button --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const colorContainer = document.querySelector('.color-container');
        const addColorRowButtons = document.querySelectorAll('.add-color-row');

        addColorRowButtons.forEach(button => {
            button.addEventListener('click', function () {
                const colorRow = document.createElement('div');
                colorRow.classList.add('color-row');
                colorRow.innerHTML = `
                    <div class="row color"> {{-- start 6th row --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>Color Name <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="color_names[]" value="" class="form-control"> <div class="help-block"></div>
                                </div>
                            </div> {{-- end form group --}}
                        </div>{{-- end col-md-4 --}}
                        <div class="col-md-4">
                            <div class="form-group">
                                <h5>Color Code <span class="text-danger">*</span></h5>
                                <div class="controls">
                                    <input type="text" name="color_codes[]" value="" class="form-control"> <div class="help-block"></div>
                                </div>
                            </div> {{-- end form group --}}
                        </div>
                        <div class="col-md-4 d-flex flex-column justify-content-end">
                            <div class="form-group">
                                <button type="button" class="btn btn-rounded btn-danger remove-color-row">Remove</button>
                            </div>
                        </div>
                    </div> {{-- end 6th row --}}
                `;

                const removeButton = colorRow.querySelector('.remove-color-row');
                removeButton.addEventListener('click', function () {
                    colorRow.remove();
                });

                colorContainer.appendChild(colorRow);
            });
        });
    });
</script>




<script>
    document.getElementById("add_prices_btn").addEventListener("click", function() {
        var productSizesValue = document.getElementById("product_sizes").value;
        // Split product sizes into an array
        var productSizesArray = productSizesValue.split(",");
        var productColors = []; // Example colors
        var combinations = [];
        console.log(productSizesValue);
        console.log(productSizesArray);

        // Select all color rows
        var colorRows = document.querySelectorAll(".color-container .row");

        // Iterate through each color row
        colorRows.forEach(function(colorRow) {
            // Find color name and color code inputs within the current row
            var colorNameInput = colorRow.querySelector('input[name="color_names[]"]');
            var colorCodeInput = colorRow.querySelector('input[name="color_codes[]"]');

            // Retrieve values from color name and color code inputs
            var colorName = colorNameInput.value;
            var colorCode = colorCodeInput.value;

            // Create array of color name
            productColors.push(colorName);

            // Log values to the console
            console.log("Color Name:", colorName);
            console.log("Color Code:", colorCode);
        });

        // Generate combinations for each size-color pair
        productSizesArray.forEach(function(size) {
            productColors.forEach(function(color) {
                combinations.push({ size: size.trim(), color: color.trim() });
            });
        });

        // Generate rows for each combination
        var combinationRows = combinations.map(function(combination) {
            var variation = document.createElement("div");
            variation.classList.add("variation");
            variation.innerHTML = `
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <h5>Size <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="size" value="${combination.size}" class="form-control">
                                <div class="help-block"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <h5>Color Name <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="color" value="${combination.color}" class="form-control">
                                <div class="help-block"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <h5>Quantity <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="number" name="quantity[]" value="" class="form-control">
                                <div class="help-block"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <h5>Selling Price <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="number" name="selling_price[]" value="" class="form-control">
                                <div class="help-block"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <h5>Discount Price <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="number" name="discount_price[]" value="" class="form-control">
                                <div class="help-block"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <h5>Images <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="file" name="${combination.size}_${combination.color}[]" class="form-control" multiple onchange="previewImages(this, '${combination.size}-${combination.color}');">
                                <div class="help-block"></div>
                            </div>
                            <div id="preview_${combination.size}-${combination.color}" class="preview-images"></div>
                        </div>
                    </div>
                </div>
                <hr>
                `;
            return variation;
        });

        // Append rows to the container
        var container = document.querySelector(".combination-wise-price");
        container.innerHTML="";
        combinationRows.forEach(function(variation) {
            container.appendChild(variation);
        });
    });

    function previewImages(input, id) {
        var preview = document.getElementById('preview_' + id);
        while (preview.firstChild) {
            preview.removeChild(preview.firstChild);
        }
        if (input.files) {
            var filesAmount = input.files.length;
            for (i = 0; i < filesAmount; i++) {
                var reader = new FileReader();
                reader.onload = function(event) {
                    var img = document.createElement('img');
                    img.setAttribute('src', event.target.result);
                    img.setAttribute('style', 'max-width:100px;max-height:100px;margin:2px;');
                    preview.appendChild(img);
                }
                reader.readAsDataURL(input.files[i]);
            }
        }
    }
</script>






@endsection