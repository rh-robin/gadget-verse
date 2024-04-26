var combinationRows = combinations.map(function(combination) {
    // Find corresponding variation from PHP data
    var matchingVariation = variationsData.find(function(variation) {
        /* console.log("v " +variation.size);
        console.log(combination.size);
        console.log("v " +variation.color_name);
        console.log(combination.color);
        console.log("v " +variation.stock.quantity);
        console.log("pk"); */
        //console.log(variation);
        return variation.size === combination.size && variation.color_name === combination.color;
    });
    //console.log(matchingVariation.images);

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
                    <div id="preview_${combination.size}-${combination.color}" class="preview-images">

                    </div> {{-- end preview-images --}}
                </div> {{-- end form-group --}}
            </div> {{-- end col-md-4 --}}
        </div> {{-- end row --}}
        <hr>
        `;
    if (matchingVariation) {
        var previewDiv = document.getElementById(`preview_${combination.size}-${combination.color}`);
        
        matchingVariation.images.forEach(function(image) {
            var img = document.createElement('img');
            var path = "{{ asset("") }}";
            path += image.image_source;
            img.src = path;
            img.className = 'preview-image';
            img.style.maxWidth = '100px';
            img.style.maxHeight = '100px';
            img.style.margin = '2px';
            //console.log(img);
            //console.log(path);
            previewDiv.appendChild(img);
        });
        console.log(previewDiv);
    }
    return variation;
}); 














@foreach ($variations as $variation)
                                
                            <div class="variation">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Size <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="size" value="{{$variation->size}}" class="form-control">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Color Name <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="text" name="color" value="{{$variation->color_name}}" class="form-control">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Quantity <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="number" name="quantity[]" value="{{ $variation->stock->quantity }}" class="form-control">
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
                                                <input type="number" name="selling_price[]" value="{{$variation->selling_price}}" class="form-control">
                                                <div class="help-block"></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5>Discount Price <span class="text-danger">*</span></h5>
                                            <div class="controls">
                                                <input type="number" name="discount_price[]" value="{{$variation->discount_price}}" class="form-control">
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