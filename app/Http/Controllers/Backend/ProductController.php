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
        // Validate incoming request
        $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:sub_categories,id',
            'subsubcategory_id' => 'required|exists:sub_sub_categories,id',
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
            'brand_id' => 'required|exists:brands,id',
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:sub_categories,id',
            'subsubcategory_id' => 'required|exists:sub_sub_categories,id',
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
		
		$product_sizes = explode(",", $request->product_sizes);
		$product_colors = $request->color_names;

		// Delete variations with sizes not included in $product_sizes
		$variationsToDelete = ProductVariation::whereNotIn('size', $product_sizes)->get();
		foreach ($variationsToDelete as $variation) {
			foreach ($variation->images as $image) {
				unlink($image->image_source); // Unlink associated multi-images
			}
			//$variation->images()->delete(); // Delete associated multi-images
			$variation->delete(); // Delete the variation
		}

		// Delete variations with color names not included in $product_colors
		$variationsToDelete = ProductVariation::whereNotIn('color_name', $product_colors)->get();
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
				
				$variation = ProductVariation::where("size",$size)->where("color_name",$colorName)->first();

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


	/// Multiple Image Update
	public function multiImgUpdate(Request $request){
		if ($request->hasFile('multi_img')) {
			$imgs = $request->multi_img;

			foreach ($imgs as $id => $img) {
				$imgDel = MultiImg::findOrFail($id);
				unlink($imgDel->image_name);
				$manager = new ImageManager(new Driver());
				$fileName = hexdec(uniqid()) . '.' . $img->getClientOriginalExtension();

				$image = $manager->read($img);
				$image = $image->resize(917, 1000);

				$multiImgDirectory = public_path('upload/products/multi-img');
				File::makeDirectory($multiImgDirectory, $mode = 0777, true, true);
				$image->toJpeg(80)->save($multiImgDirectory . '/' . $fileName);

				$save_url_multi = 'upload/products/multi-img/' . $fileName;

				$multiImg = MultiImg::findOrFail($id);
				$multiImg->image_name = $save_url_multi;
				$multiImg->save();

			} // end foreach

			$notification = array(
					'message' => 'Product Multi Image Updated Successfully',
					'alert-type' => 'info'
			);
		} else{
			$notification = array(
				'message' => 'Please Select New Image To Update',
				'alert-type' => 'warning'
			);
		}/* end if */

		
		return redirect()->back()->with($notification);

	} // end mehtod 


	/// Product Main Thambnail Update /// 
	public function thumbnailUpdate(Request $request){
		$pro_id = $request->id;
		$oldImage = $request->old_img;
		
		if ($request->hasFile('product_thumbnail')) {
			$manager = new ImageManager(new Driver());
			$fileName = hexdec(uniqid()) . '.' . $request->file('product_thumbnail')->getClientOriginalExtension();

			$image = $manager->read($request->file('product_thumbnail'));
			$image = $image->resize(917, 1000);

			$thumbnailDirectory = public_path('upload/products/thumbnail');
			File::makeDirectory($thumbnailDirectory, $mode = 0777, true, true);
			$image->toJpeg(80)->save($thumbnailDirectory . '/' . $fileName);

			$save_url = 'upload/products/thumbnail/' . $fileName;
			$product = Product::findOrFail($pro_id);
			$product->product_thumbnail = $save_url;
			$product->save();
			unlink($oldImage);

			$notification = array(
				'message' => 'Product Thumbnail Image Updated Successfully',
				'alert-type' => 'info'
			);
		}else{
			$notification = array(
				'message' => 'Please Select New Image To Update',
				'alert-type' => 'warning'
			);
		} /* end if */
		return redirect()->back()->with($notification);
   
	} // end method


	//// Multi Image Delete ////
	public function multiImgDelete($id){
		$oldimg = MultiImg::findOrFail($id);
		unlink($oldimg->image_name);
		MultiImg::findOrFail($id)->delete();

		$notification = array(
		   'message' => 'Product Image Deleted Successfully',
		   'alert-type' => 'success'
	   );

	   return redirect()->back()->with($notification);

	} // end method 


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
		Product::findOrFail($id)->delete();

		$images = MultiImg::where('product_id',$id)->get();
		foreach ($images as $img) {
			unlink($img->image_name);
		}
		MultiImg::where('product_id',$id)->delete();

		$notification = array(
		   'message' => 'Product Deleted Successfully',
		   'alert-type' => 'success'
	   );

	   return redirect()->back()->with($notification);

	}// end method 

}
