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
                        <li class="breadcrumb-item active" aria-current="page">Edit Product</li>
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
                 <h3 class="box-title">Edit The Products Value Where you need</h3>
               </div>
               <!-- /.box-header -->
               <div class="box-body">
                    <form method="POST" action="{{ route('product.dataUpdate') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="id" value="{{ $product->id }}">
                        <div class="row"> {{-- start 1st row --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Select Brand <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <select name="brand_id" id="select" class="form-control" aria-invalid="false">
                                            <option value="" selected disabled>Select Brand</option>
                                            @foreach ($brands as $brand)
                                            <option value="{{ $brand->id }}" {{ $brand->id== $product->brand_id ? 'selected' : '' }}>{{ $brand->brand_name_en }}</option>
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
                                            <option value="{{ $category->id }}" {{ $category->id== $product->category_id ? 'selected' : '' }}>{{ $category->category_name }}</option>
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
                                            @foreach ($subcategories as $subcategory)
                                            <option value="{{ $subcategory->id }}" {{ $subcategory->id== $product->sub_category_id ? 'selected' : '' }}>{{ $subcategory->subcategory_name }}</option>
                                            @endforeach
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
                                            @foreach ($subsubcategories as $subsubcategory)
                                            <option value="{{ $subsubcategory->id }}" {{ $subsubcategory->id== $product->sub_sub_category_id ? 'selected' : '' }}>{{ $subsubcategory->subsubcategory_name }}</option>
                                            @endforeach
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
                                        <input type="text" name="product_name" value="{{ $product->product_name }}" class="form-control"> <div class="help-block"></div></div>
                                    @error('product_name')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div> {{-- end form group --}}
                            </div>{{-- end col-md-4 --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Tags <span class="text-danger"></span></h5>
                                    <div class="controls">
                                        <input name="product_tags" class="form-control" type="text" value="{{ $product->product_tags }}" data-role="tagsinput" placeholder="add tags" /> <div class="help-block"></div>
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
                                        <input type="file" name="product_thumbnail" value="" class="form-control" onChange="mainThumbUrl(this)"> 
                                        <input type="hidden" name="old_thumbnail" value="{{ $product->product_thumbnail }}"> <div class="help-block"></div>
                                    </div>
                                    <img src="{{ !empty($product->product_thumbnail) ? url($product->product_thumbnail) : url('upload/noimage.jpg') }}" width="100x" height="auto" alt="" id="mainThumb">
                                    @error('product_thumbnail')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div> {{-- end form group --}}
                            </div>{{-- end col-md-4 --}}
                            <div class="col-md-8">
                                <div class="form-group">
                                    <h5>Short Description <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <textarea name="short_desc" id="textarea" class="form-control">{{ $product->short_desc }}</textarea> <div class="help-block"></div>
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
                                            {{ $product->long_desc }}
                                        </textarea> <div class="help-block"></div>
                                    </div>
                                    @error('long_desc')
                                    <div class="form-control-feedback"><small class="text-danger">{{ $message }}</small></div>
                                    @enderror
                                </div> {{-- end form group --}}
                            </div> {{-- end col-md-12 --}}
                        </div> {{-- end 4th row --}}

                    @php
                        $allSizes = "";
                        $colors = [];
                        foreach ($variations as $variation) {
                            $allSizes .= $variation->size . ",";
                            
                            // Check if the color exists in the $colors array
                            $colorExists = false;
                            foreach ($colors as $color) {
                                if ($color['color_name'] === $variation->color_name && $color['color_code'] === $variation->color_code) {
                                    $colorExists = true;
                                    break;
                                }
                            }
                            // If the color is not found, add it to the $colors array
                            if (!$colorExists) {
                                $colors[] = [
                                    'color_name' => $variation->color_name,
                                    'color_code' => $variation->color_code
                                ];
                            }
                        }
                    @endphp
                    

                        <div class="row"> {{-- start 4th row --}}
                            <div class="col-md-4">
                                <div class="form-group">
                                    <h5>Product Sizes <span class="text-danger">*</span></h5>
                                    <div class="controls">
                                        <input id="product_sizes" name="product_sizes" class="form-control" type="text" value="{{ $allSizes }}" data-role="tagsinput" placeholder="add sizes" /> <div class="help-block"></div>
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
                                            <input id="color_name" type="text" name="color_names[]" value="{{ $colors[0]['color_name'] ?? '' }}" class="form-control"> <div class="help-block"></div>
                                        </div>
                                    </div> {{-- end form group --}}
                                </div>{{-- end col-md-4 --}}
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h5>Color Code <span class="text-danger">*</span></h5>
                                        <div class="controls">
                                            <input id="color_code" type="text" name="color_codes[]" value="{{ $colors[0]['color_code'] ?? '' }}" class="form-control"> <div class="help-block"></div>
                                        </div>
                                    </div> {{-- end form group --}}
                                </div>
                                <div class="col-md-4 d-flex flex-column justify-content-end">
                                    <div class="form-group">
                                        <a type="button" class="btn btn-rounded btn-warning add-color-row">Add more</a>
                                    </div>
                                </div>
                            </div> {{-- end 6th row --}}
                        
                            @php $colors = array_slice($colors, 1); @endphp
                        
                            @foreach ($colors as $color)
                                <div class="row"> {{-- start 6th row --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Color Name <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input id="color_name" type="text" name="color_names[]" value="{{ $color['color_name'] }}" class="form-control"> <div class="help-block"></div>
                                            </div>
                                        </div> {{-- end form group --}}
                                    </div>{{-- end col-md-4 --}}
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Color Code <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input id="color_code" type="text" name="color_codes[]" value="{{ $color['color_code'] }}" class="form-control"> <div class="help-block"></div>
                                            </div>
                                        </div> {{-- end form group --}}
                                    </div>
                                    <div class="col-md-4 d-flex flex-column justify-content-end">
                                        <div class="form-group">
                                            <a type="button" class="btn btn-rounded btn-danger remove-color-row" onclick="removeThisRow(this)">Remove</a>
                                        </div>
                                    </div>
                                </div> {{-- end 6th row --}}
                            @endforeach
                        </div> {{-- end color-container --}}
                        






                        <div class="row"> {{-- start 7th row --}}
                            <div class="col-md-4 d-flex flex-column justify-content-end">
                                <div class="form-group">
                                    <a id="add_prices_btn" class="btn btn-rounded btn-warning">Create Variation</a>
                                    
                                </div>
                            </div>
                        </div> {{-- end 7th row --}}
                        
                        <div class="combination-wise-price">

                            @foreach ($variations as $variation)
                                
                            <div class="variation">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Size <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="size" value="{{$variation->size}}" class="form-control" readonly>
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Color Name <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="color" value="{{$variation->color_name}}" class="form-control" readonly>
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Quantity <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="number" name="quantity[]" value="{{ $variation->stock->quantity }}" class="form-control" readonly>
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
                                                <input type="number" name="selling_price[]" value="{{$variation->selling_price}}" class="form-control" readonly>
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Discount Price <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="number" name="discount_price[]" value="{{$variation->discount_price}}" class="form-control" readonly>
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Images <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="file" name="${combination.size}_${combination.color}[]" class="form-control" multiple onchange="previewImages(this, '${combination.size}-${combination.color}');" readonly>
                                                <div class="help-block"></div>
                                            </div>
                                    
                                        <div id="preview_${combination.size}-${combination.color}" class="preview-images">

                                        @foreach ($variation->images as $image)
                                            <img src="{{ asset($image->image_source) }}" class="preview-image" style="max-width:100px; max-height:100px; margin:2px">
                                        
                                        @endforeach

                                        </div> {{-- end preview-images --}}
                                    
                                            
                                        </div> {{-- end form-group --}}
                                    </div> {{-- end col-md-4 --}}
                                </div>
                                <hr>
                            </div>
                            @endforeach
                        </div> {{-- end combination-wise-price --}}



                        <div class="row"> {{-- start 9th row --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <fieldset>
											<input type="checkbox" id="checkbox_2" name="hot_deals" value="1" {{$product->hot_deals==1 ? "checked" : ""}}>
											<label for="checkbox_2">Hot Deals</label>
										</fieldset>
										<fieldset>
											<input type="checkbox" id="checkbox_3" value="1" name="featured" {{$product->featured==1 ? "checked" : ""}}>
											<label for="checkbox_3">Featured</label>
										</fieldset> <div class="help-block"></div>
                                    </div>
                                </div> {{-- end form group --}}
                            </div> {{-- end col-md-6 --}}
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div class="controls">
                                        <fieldset>
											<input type="checkbox" id="checkbox_4" value="1" name="special_offer" {{$product->special_offer==1 ? "checked" : ""}}>
											<label for="checkbox_4">Special Offers</label>
										</fieldset>
										<fieldset>
											<input type="checkbox" id="checkbox_5" value="1" name="special_deals" {{$product->special_deals==1 ? "checked" : ""}}>
											<label for="checkbox_5">Special Deals</label>
										</fieldset> <div class="help-block"></div>
                                    </div>
                                </div> {{-- end form group --}}
                            </div>{{-- end col-md-6 --}}
                        </div> {{-- end 9th row --}}
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
                $('#mainThumb').attr('src',e.target.result).width(100).height(auto);
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
                colorRow.classList.add('row');
                colorRow.innerHTML = `
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
                                <button type="button" class="btn btn-rounded btn-danger remove-color-row">Remove</button>
                            </div>
                        </div>
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

{{-- remove color row on click remove button --}}
<script>
    function removeThisRow(btn) {
        // Traverse up the DOM to find the parent row and remove it
        var row = btn.closest('.row');
        row.parentNode.removeChild(row);
    }
</script>


<script>
    var variationsData = <?php echo json_encode($variations); ?>;
</script>


{{-- create combination onclick add_prices_btn --}}
<script>
    document.getElementById("add_prices_btn").addEventListener("click", function() {
        var productSizesValue = document.getElementById("product_sizes").value;
        // Split product sizes into an array
        var productSizesArray = productSizesValue.split(",");
        var productColors = []; // Example colors
        var combinations = [];
        //console.log(productSizesValue);
        //console.log(productSizesArray);
        //console.log(variationsData);

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
            //console.log("Color Name:", colorName);
            //console.log("Color Code:", colorCode);
        });

        // Generate combinations for each size-color pair
        productSizesArray.forEach(function(size) {
            productColors.forEach(function(color) {
                combinations.push({ size: size.trim(), color: color.trim() });
            });
        });

        // Generate rows for each combination
        /* var combinationRows = combinations.map(function(combination) {
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
                                <input type="number" name="quantity[]" value="{{$variation->size ?? ""}}" class="form-control">
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
        }); */

        var combinationRows = combinations.map(function(combination) {
            // Find corresponding variation from PHP data
            var matchingVariation = variationsData.find(function(variation) {
                
                return variation.size === combination.size && variation.color_name === combination.color;
            });
            
            var variation = document.createElement("div");
            variation.classList.add("variation");
            variation.innerHTML = `
                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group">
                            <h5>Size <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="size" value="${combination.size}" class="form-control" readonly>
                                <div class="help-block"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <h5>Color Name <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="text" name="color" value="${combination.color}" class="form-control" readonly>
                                <div class="help-block"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <h5>Quantity <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="number" name="quantity[]" value="${matchingVariation ? matchingVariation.stock.quantity : ''}" class="form-control">
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
                                <input type="number" name="selling_price[]" value="${matchingVariation ? matchingVariation.selling_price : ''}" class="form-control">
                                <div class="help-block"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <h5>Discount Price <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="number" name="discount_price[]" value="${matchingVariation ? matchingVariation.discount_price : ''}" class="form-control">
                                <div class="help-block"></div>
                            </div>
                        </div>
                    </div> {{-- end col-md-4 --}}
                    <div class="col-md-4">
                        <div class="form-group">
                            <h5>Images <span class="text-danger">*</span></h5>
                            <div class="controls">
                                <input type="file" name="${combination.size}_${combination.color}[]" class="form-control" multiple onchange="previewImages(this, '${combination.size}-${combination.color}');">
                                <div class="help-block"></div>
                            </div>
                            
                            <div id="" class="preview-images d-flex flex-wrap">
                            ${matchingVariation ? `
                                <!-- HTML code to show images if matchingVariation exists -->
                                ${matchingVariation.images.map(function(image) {
                                    return `<div class="single_image text-center" style="max-width:100px; max-height:125px; margin:2px">
                                    <img src="{{ asset('${image.image_source}')}}" class="preview-image d-block" style="max-width:100px; max-height:100px;">
                                    <a class="text-danger" href="#" onclick="toggleHiddenInput(event, '${image.id}')"><i class="fa-solid fa-trash"></i></a>
                                    </div>
                                    `;
                                }).join('')}
                            ` : ''}
                            </div> {{-- end preview-images from database --}}

                            {{-- preview selected images --}}
                            <div id="preview_${combination.size}-${combination.color}" class="preview-images"></div> {{-- end preview selected images --}}
                        </div> {{-- end form-group --}}
                    </div> {{-- end col-md-4 --}}
                </div> {{-- end row --}}
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


/* when the delete icon of image will be clicked */
<script>
    function toggleHiddenInput(event, id) {
        event.preventDefault(); // Prevent default behavior of anchor tag

        var anchor = event.currentTarget;
        var input = anchor.nextElementSibling;

        if (input && input.tagName.toLowerCase() === 'input' && input.getAttribute('type') === 'hidden') {
            // Remove the hidden input element
            input.parentNode.removeChild(input);
            // Change the icon to trash
            anchor.innerHTML = '<i class="fa-solid fa-trash"></i>';
        } else {
            // Create a new hidden input element
            var newInput = document.createElement('input');
            newInput.setAttribute('type', 'hidden');
            newInput.setAttribute('name', 'dltImages[]');
            newInput.setAttribute('value', id);

            // Insert the input element after the anchor element
            anchor.parentNode.insertBefore(newInput, anchor.nextSibling);
            // Change the icon to 'x'
            anchor.innerHTML = '<i class="fa-solid fa-x"></i>';
        }
    }
</script>






@endsection