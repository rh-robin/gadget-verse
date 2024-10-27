<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Brand;

use App\Models\ProductVariation;
use App\Models\ProductStock;
use App\Models\ProductMultiImage;
use App\Models\Product3dImage;
use App\Models\ProductVideo;
use Carbon\Carbon;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;


class ProductController extends Controller
{
    public function add(){
		$categories = Category::latest()->get();
		$brands = Brand::latest()->get();
		return view('backend.product.product_add',compact('categories','brands'));

	}




	public function store(Request $request){
		//dd($request->product_3d);
        // Validate incoming request
        $request->validate([
            /* 'brand_id' => 'required|exists:brands,id', */
            'category_id' => 'required|exists:categories,id',
            /* 'subcategory_id' => 'required|exists:sub_categories,id',
            'subsubcategory_id' => 'required|exists:sub_sub_categories,id', */
            'product_name' => 'required|string',
            'product_tags' => 'nullable|string',
            'short_desc' => 'nullable|string',
            'long_desc' => 'nullable|string',
            /* 'product_sizes' => 'required|string',
            'color_names.*' => 'string',
            'color_codes.*' => 'string',
            'quantity.*' => 'integer',
            'selling_price.*' => 'nullable|numeric',
            'discount_price.*' => 'nullable|numeric', */
            'hot_deals' => 'nullable|boolean',
            'featured' => 'nullable|boolean',
            'special_offer' => 'nullable|boolean',
            'special_deals' => 'nullable|boolean',
            'product_thumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
			'video' =>'mimes:mp4'
        ]);

        // Save product data
        $product = new Product();
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->subcategory_id;
        $product->sub_sub_category_id = $request->subsubcategory_id;
        $product->product_name = $request->product_name;
		$product->product_slug = strtolower(str_replace(' ', '-', $request->product_name));
		$product->product_sku = $request->product_name;
        $product->product_tags = $request->product_tags;
        $product->short_desc = $request->short_desc;
        $product->long_desc = $request->long_desc;

        
		// Process the product thumbnail
		if ($request->hasFile('product_thumbnail')) {
			$manager = new ImageManager(new Driver());
			$fileName = hexdec(uniqid()) . '.' . $request->file('product_thumbnail')->getClientOriginalExtension();
	
			$image = $manager->read($request->file('product_thumbnail'));
			$image = $image->resize(917, 1000);
	
			$thumbnailDirectory = public_path('upload/products/thumbnail');
			File::makeDirectory($thumbnailDirectory, $mode = 0777, true, true);
			$image->toJpeg(80)->save($thumbnailDirectory . '/' . $fileName);
	
			$save_url = 'upload/products/thumbnail/' . $fileName;
			$product->product_thumbnail = $save_url;
		}

		

        // Save product flags
        $product->hot_deals = $request->has('hot_deals');
        $product->featured = $request->has('featured');
        $product->special_offer = $request->has('special_offer');
        $product->special_deals = $request->has('special_deals');
		
		$product->save();

		/* process the product 3d image */
		if ($request->hasFile('product_3d')) {
			$product3DFile = $request->file('product_3d');
			$fileName = hexdec(uniqid()) . '.' . $request->file('product_3d')->getClientOriginalExtension();
			$file_url = 'upload/products/3d_model/'.$fileName;
            $product3DFile->move(public_path('upload/products/3d_model'), $fileName);
			$product3dImage = new Product3dImage();
			$product3dImage->product_id = $product->id;
			$product3dImage->image_source = $file_url;
			$product3dImage->save();
		}

		/* process the product video */
		if ($request->hasFile('video') || $request->embed_code) {
			$productVideo = new ProductVideo();
			$productVideo->product_id = $product->id;
			if($request->hasFile('video')){
				$videoFile = $request->file('video');
				$fileName = hexdec(uniqid()) . '.' . $request->file('video')->getClientOriginalExtension();
				$file_url = 'upload/products/video/'.$fileName;
				$videoFile->move(public_path('upload/products/video'), $fileName);
				$productVideo->video_source = $file_url;
			}
			if($request->embed_code){
				$productVideo->embed_code = $request->embed_code;
			}
			$productVideo->video_priority = $request->video_priority;
			$productVideo->save();
		}
		
		
		$product_sizes = explode(",",$request->product_sizes);

        // Save product variations and stock
		$i=0;
		foreach ($product_sizes as $size) {
			foreach	($request->color_names as $index => $color_name) {
				$colorName = $color_name;
				$colorCode = $request->color_codes[$index];
				
				$variation = new ProductVariation();
				$variation->product_id = $product->id;
				$variation->size = $size;
				$variation->color_name = $colorName;
				$variation->color_code = $colorCode;
				$variation->selling_price = $request->selling_price[$i];
				$variation->discount_price = $request->discount_price[$i];
				
				$variation->save();

				$stock = new ProductStock();
				$stock->product_id = $product->id;
				$stock->product_variation_id = $variation->id;
				$stock->quantity = $request->quantity[$i];

				$stock->save();
				// Process multiple images
				if ($request->hasFile("{$size}_{$colorName}")) {
					//dd(true);
					$images = $request->file("{$size}_{$colorName}");
					//dd($images);
					foreach ($images as $img) {
						$manager = new ImageManager(new Driver());
						$fileName = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
			
						$image = $manager->read($img);
						$image = $image->resize(917, 1000);
			
						$multiImgDirectory = public_path('upload/products/multi_images');
						File::makeDirectory($multiImgDirectory, $mode = 0777, true, true);
						$image->toJpeg(80)->save($multiImgDirectory . '/' . $fileName);
			
						$save_url_multi = 'upload/products/multi_images/' . $fileName;
			
						$multiImg = new ProductMultiImage();
						$multiImg->product_id = $product->id;
						$multiImg->product_variation_id = $variation->id;
						$multiImg->image_source = $save_url_multi;
						$multiImg->save();
					} 
				} /* end if */
				$i++;
			} /* end foreach color_names */
			
			
		} /* end foreach product_sizes */


		$notification = array(
			'message' => 'Product Added Successfully',
			'alert-type' => 'success'
		);

        // Redirect or return response as per your requirement
        return redirect()->back()->with($notification);
    }






	

	public function view(){

		$products = Product::with('stocks')->get();

		//dd($products);
		return view('backend.product.product_view',compact('products'));
	}

	
	public function edit($id){


		$categories = Category::latest()->get();
		$brands = Brand::latest()->get();
		$subcategories = SubCategory::latest()->get();
		$subsubcategories = SubSubCategory::latest()->get();
		$product = Product::findOrFail($id);
		$variations = $product->variations;
		$stocks = $product->stocks;
		return view('backend.product.product_edit',compact('categories','brands','subcategories','subsubcategories','product','variations','stocks'));

	}

	public function dataUpdate(Request $request){
		//dd($request->all());
        // Validate incoming request
        $request->validate([
            /* 'brand_id' => 'required|exists:brands,id', */
            'category_id' => 'required|exists:categories,id',
            /* 'subcategory_id' => 'exists:sub_categories,id',
            'subsubcategory_id' => 'exists:sub_sub_categories,id', */
            'product_name' => 'required|string',
            'product_tags' => 'nullable|string',
            'short_desc' => 'nullable|string',
            'long_desc' => 'nullable|string',
            /* 'product_sizes' => 'required|string',
            'color_names.*' => 'string',
            'color_codes.*' => 'string',
            'quantity.*' => 'integer',
            'selling_price.*' => 'nullable|numeric',
            'discount_price.*' => 'nullable|numeric', */
            'hot_deals' => 'nullable|boolean',
            'featured' => 'nullable|boolean',
            'special_offer' => 'nullable|boolean',
            'special_deals' => 'nullable|boolean',
            'product_thumbnail' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
			'video' => 'mimes:mp4',
        ]);

        // Save product data
		$id = $request->id;
        $product = Product::findOrFail($id);
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $product->sub_category_id = $request->subcategory_id;
        $product->sub_sub_category_id = $request->subsubcategory_id;
        $product->product_name = $request->product_name;
		$product->product_slug = strtolower(str_replace(' ', '-', $request->product_name));
		$product->product_sku = $request->product_name;
        $product->product_tags = $request->product_tags;
        $product->short_desc = $request->short_desc;
        $product->long_desc = $request->long_desc;

        
		// Process the product thumbnail
		if ($request->hasFile('product_thumbnail')) {
			if($request->old_thumbnail){
				unlink($request->old_thumbnail);
			}
			$manager = new ImageManager(new Driver());
			$fileName = hexdec(uniqid()) . '.' . $request->file('product_thumbnail')->getClientOriginalExtension();
	
			$image = $manager->read($request->file('product_thumbnail'));
			$image = $image->resize(917, 1000);
	
			$thumbnailDirectory = public_path('upload/products/thumbnail');
			File::makeDirectory($thumbnailDirectory, $mode = 0777, true, true);
			$image->toJpeg(80)->save($thumbnailDirectory . '/' . $fileName);
	
			$save_url = 'upload/products/thumbnail/' . $fileName;
			$product->product_thumbnail = $save_url;
		}
		

        // Save product flags
        $product->hot_deals = $request->has('hot_deals');
        $product->featured = $request->has('featured');
        $product->special_offer = $request->has('special_offer');
        $product->special_deals = $request->has('special_deals');
		
		$product->save();

		/* process the product 3d image */
		$oldProduct3dId = $request->old_product_3d;
		$product3dImage = Product3dImage::find($oldProduct3dId);
		if ($request->hasFile('product_3d')) {
			$product3DFile = $request->file('product_3d');
			//dd($product3DFile);
			$fileName = hexdec(uniqid()) . '.' . $request->file('product_3d')->getClientOriginalExtension();
			$file_url = 'upload/products/3d_model/'.$fileName;
            $product3DFile->move(public_path('upload/products/3d_model'), $fileName);
			
			if($product3dImage){
				//dd("ok");
				unlink($product3dImage->image_source);
			}else{
				$product3dImage = new Product3dImage();
			}
			
			$product3dImage->product_id = $product->id;
			$product3dImage->image_source = $file_url;
			
			
		}
		if ($product3dImage !== null) {
			$product3dImage->background =  $request->filled('background') ? $request->background : '0xffffff';
			$product3dImage->scale_x = $request->filled('scale_x') ? $request->scale_x : 0.04;
			$product3dImage->scale_y = $request->filled('scale_y') ? $request->scale_y : 0.04;
			$product3dImage->scale_z = $request->filled('scale_z') ? $request->scale_z : 0.04;
			$product3dImage->directional_light_color = $request->filled('directional_light_color') ? $request->directional_light_color : '0xffffff';
			$product3dImage->directional_light_opacity = $request->filled('directional_light_opacity') ? $request->directional_light_opacity : 5;
			$product3dImage->ambient_light_color = $request->filled('ambient_light_color') ? $request->ambient_light_color : '0xffffff';
			$product3dImage->ambient_light_opacity = $request->filled('ambient_light_opacity') ? $request->ambient_light_opacity : 3;
			$product3dImage->target_x = $request->filled('target_x') ? $request->target_x : 0;
			$product3dImage->target_y = $request->filled('target_y') ? $request->target_y : 1;
			$product3dImage->target_z = $request->filled('target_z') ? $request->target_z : 0;
			$product3dImage->save();
		}
		


		/* process the product vide0 */
		$productVideo = ProductVideo::where('product_id', $product->id)->first();
		
		if ($request->hasFile('video')) {
			$videoFile = $request->file('video');
			$fileName = hexdec(uniqid()) . '.' . $request->file('video')->getClientOriginalExtension();
			$file_url = 'upload/products/video/'.$fileName;
            $videoFile->move(public_path('upload/products/video'), $fileName);
			if($productVideo){
				if($productVideo->video_source){
					unlink($productVideo->video_source);
				}
			}
			if($productVideo == null){
				$productVideo = new ProductVideo();
				$productVideo->product_id = $product->id;
			}
			$productVideo->video_source = $file_url;
			$productVideo->update();
		}
		if($request->embed_code){
			if($productVideo == null){
				$productVideo = new ProductVideo();
				$productVideo->product_id = $product->id;
			}
			if(trim($request->embed_code) == ''){
				$productVideo->embed_code = null;
			}else{
				$productVideo->embed_code = $request->embed_code;
			}
		}
		if($productVideo !== null){
			$productVideo->video_priority = $request->video_priority;
			$productVideo->update();
		}
		

		
		$product_sizes = explode(",", $request->product_sizes);
		$product_colors = $request->color_names;

		// Delete variations with sizes not included in $product_sizes
		$variationsToDelete = ProductVariation::whereNotIn('size', $product_sizes)->where("product_id", $product->id)->get();
		
		foreach ($variationsToDelete as $variation) {
			foreach ($variation->images as $image) {
				unlink($image->image_source); // Unlink associated multi-images
			}
			//$variation->images()->delete(); // Delete associated multi-images
			$variation->delete(); // Delete the variation
		}

		// Delete variations with color names not included in $product_colors
		$variationsToDelete = ProductVariation::whereNotIn('color_name', $product_colors)->where("product_id", $product->id)->get();
		//dd($variationsToDelete);
		foreach ($variationsToDelete as $variation) {
			foreach ($variation->images as $image) {
				unlink($image->image_source); // Unlink associated multi-images
			}
			//$variation->images()->delete(); // Delete associated multi-images
			$variation->delete(); // Delete the variation
		}



		


        // Save product variations and stock
		$i=0;
		foreach ($product_sizes as $size) {
			foreach	($request->color_names as $index => $color_name) {
				$colorName = $color_name;
				$colorCode = $request->color_codes[$index];
				
				$variation = ProductVariation::where("size",$size)->where("color_name",$colorName)->where("product_id", $product->id)->first();

				/* check the variation is already exist or not */
				if($variation){
					$variation->color_code = $colorCode;
					$variation->selling_price = $request->selling_price[$i];
					$variation->discount_price = $request->discount_price[$i];
					$variation->save();

					$stock = ProductStock::where("product_variation_id", $variation->id)->first();
					$stock->quantity = $request->quantity[$i];
					$stock->save();

					
				}else{
					$variation = new ProductVariation();
					$variation->product_id = $product->id;
					$variation->size = $size;
					$variation->color_name = $colorName;
					$variation->color_code = $colorCode;
					$variation->selling_price = $request->selling_price[$i];
					$variation->discount_price = $request->discount_price[$i];
					$variation->save();

					$stock = new ProductStock();
					$stock->product_id = $product->id;
					$stock->product_variation_id = $variation->id;
					$stock->quantity = $request->quantity[$i];
					$stock->save();
				} /* end  if  */

				// Process multiple images
				if ($request->hasFile("{$size}_{$colorName}")) {
					//dd(true);
					$images = $request->file("{$size}_{$colorName}");
					//dd($images);
					foreach ($images as $img) {
						$manager = new ImageManager(new Driver());
						$fileName = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();
			
						$image = $manager->read($img);
						$image = $image->resize(917, 1000);
			
						$multiImgDirectory = public_path('upload/products/multi_images');
						File::makeDirectory($multiImgDirectory, $mode = 0777, true, true);
						$image->toJpeg(80)->save($multiImgDirectory . '/' . $fileName);
			
						$save_url_multi = 'upload/products/multi_images/' . $fileName;
			
						$multiImg = new ProductMultiImage();
						$multiImg->product_id = $product->id;
						$multiImg->product_variation_id = $variation->id;
						$multiImg->image_source = $save_url_multi;
						$multiImg->save();
					} /* end foreach */
				} /* end if */
				$i++;
			} /* end foreach color_names */
			
		} /* end foreach product_sizes */

		/* delete multiimages */
		if ($request->dltImages) {
			$ids=$request->dltImages;
			foreach ($ids as $id) {
				$image = ProductMultiImage::findOrFail($id);
				unlink($image->image_source);
				$image->delete();
			}
		}

		$notification = array(
			'message' => 'Product Updated Successfully',
			'alert-type' => 'success'
		);

        // Redirect or return response as per your requirement
        return redirect()->back()->with($notification);
    }




	public function inactive($id){
		Product::findOrFail($id)->update(['status' => 0]);
		$notification = array(
		   'message' => 'Product Inactive',
		   'alert-type' => 'success'
	   );

	   return redirect()->back()->with($notification);
	}


 	public function active($id){
	 	Product::findOrFail($id)->update(['status' => 1]);
		$notification = array(
		   'message' => 'Product Active',
		   'alert-type' => 'success'
	    );

	   return redirect()->back()->with($notification);
		
	}


	public function delete($id){
		$product = Product::findOrFail($id);
		unlink($product->product_thumbnail);
		

		
		$video = $product->productVideo;
		if ($video) {
			if ($video->video_source) {
				unlink($video->video_source);
			}
		}

		$images = $product->productImages;
		foreach ($images as $key => $image) {
			unlink($image->image_source);
		}
		Product::findOrFail($id)->delete();
		$notification = array(
		   'message' => 'Product Deleted Successfully',
		   'alert-type' => 'success'
	   );

	   return redirect()->back()->with($notification);

	}// end method 

}
