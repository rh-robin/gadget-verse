<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\SubSubCategory;
use App\Models\Slider;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\ProductVideo;


class IndexController extends Controller
{
    public function index(){
        
        $categories = Category::orderBy('category_name','ASC')->where('status',1)->get();
        $sliders = Slider::orderBy('id','DESC')->limit(3)->get();

        $featureds = Product::where('status',1)->where('featured',1)->orderBy('id','DESC')->get();

        $hotDeals = Product::where('status',1)->where('hot_deals',1)->orderBy('id','DESC')->get();

        $specialOffer = Product::where('status',1)->where('special_offer',1)->orderBy('id','DESC')->get();

        $specialDeals = Product::where('status',1)->where('special_deals',1)->orderBy('id','DESC')->get();

        return view("frontend.index",compact('categories','featureds', 'hotDeals', 'specialOffer', 'specialDeals', 'sliders'));
    }

    public function productDetails($id, $slug){
        
        //$product = Product::findOrFail($id);
        $product = Product::with(['reviews' => function ($query) {
            $query->where('status', 1)->with('user');
        }])->find($id);

        $url = url()->current();
        $shareButtons = \Share::page($url, $product->product_name)
        ->facebook()
        ->twitter()
        ->linkedin('Extra linkedin summary can be passed here')
        ->whatsapp();
    
        // Get the filtered reviews
        $reviews = $product->reviews;

        return view("frontend.product.product_details",compact('product', 'reviews', 'shareButtons'));
    }

    public function fetchVariation($id, $size, $color){
        
        
        // Fetch variation data from the database
        $variation = ProductVariation::with('images')->where('product_id',$id)->where('size',$size)->where('color_name',$color)->first(); 

        return response()->json($variation);
    }


    public function productQuickview($id){
        $product = Product::findOrFail($id);
        $category = $product->category->category_name;
        $variations = $product->variations;
        $sizes = [];
        $colors = [];
        foreach ($variations as $variation) {
            // Check if the size exists in the $colors array
            $sizeExists = false;
            foreach ($sizes as $size) {
                if ($size === $variation->size) {
                    $sizeExists = true;
                    break;
                }
            }
            // If the color is not found, add it to the $colors array
            if (!$sizeExists) {
                $sizes[] = $variation->size;
            }

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
        $lowestSellingPrice = $product->variations()->min('selling_price');
        $highestSellingPrice = $product->variations()->max('selling_price');
        $lowestDiscountPrice = $product->variations()->min('discount_price');
        $highestDiscountPrice = $product->variations()->max('discount_price');

        $lowestPrice = 0;
        $highestPrice = 0;
        if ($lowestDiscountPrice>0) {
            $lowestPrice = $lowestDiscountPrice;
        }else{
            $lowestPrice = $lowestSellingPrice;
        }
        if ($highestDiscountPrice>0) {
            $highestPrice = $highestDiscountPrice;
        }
        return response()->json(array(
            'product' => $product,
            'sizes' => $sizes,
            'colors' => $colors,
            'lowestPrice' => $lowestPrice,
            'highestPrice' => $highestPrice,
            'category' => $category,
        ));
    }


    public function categoryWiseProduct($id, $slug){
        $categoryId = $id;
        $categories = Category::orderBy('category_name','ASC')->where('status',1)->get();
        //$products = Product::where('category_id',$id)->get();

        $products = Product::where('category_id', $id)->with(['variations' => function ($query) {
            $query->orderBy('discount_price');
        }])->get();

        // Get the first variation with the lowest discount price for each product
        $products->each(function ($product) {
            $product->lowestPriceVariation = $product->variations->first();
        });

        $featureds = Product::where('featured',1)->get();

        return view("frontend.product.category_wise", compact('categories', 'products','categoryId', 'featureds'));
    }


    public function subCategoryWiseProduct($id, $slug){
        $subCategoryId = $id;
        $subCategories = SubCategory::orderBy('subcategory_name','ASC')->where('status',1)->get();
        $products = Product::where('sub_category_id',$id)->get();

        /* $products = Product::where('category_id', $id)->with(['variations' => function ($query) {
            $query->orderBy('discount_price');
        }])->get(); */

        // Get the first variation with the lowest discount price for each product
        $products->each(function ($product) {
            $product->variation = $product->variations->first();
        });

        $featureds = Product::where('featured',1)->get();

        return view("frontend.product.subcategory_wise", compact('subCategories', 'products','subCategoryId', 'featureds'));
    }

    public function subSubCategoryWiseProduct($id, $slug){
        $products = Product::where('sub_sub_category_id',$id)->get();
        $products->each(function ($product) {
            $product->variation = $product->variations->first();
        });
        $featureds = Product::where('featured',1)->get();

        return view("frontend.product.subsubcategory_wise", compact( 'products', 'featureds'));
    }
    














    
}
