<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Category;
use App\Models\Slider;
use App\Models\Product;
use App\Models\ProductVariation;
use Illuminate\Support\Facades\Hash;

class IndexController extends Controller
{
    public function index(){
        $categories = Category::orderBy('category_name','ASC')->where('status',1)->get();
        $sliders = Slider::where('status',1)->orderBy('id','DESC')->limit(3)->get();
        $products = Product::where('status',1)->orderBy('id','DESC')->get();
        return view("frontend.index",compact('categories','sliders','products'));
    }

    public function productDetails($id, $slug){
        $product = Product::findOrFail($id);
        return view("frontend.product.product_details",compact('product'));
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
    














    /* ================== user related function ============ =========================================*/
    public function userLogout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function userProfile(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_profile',compact('user'));
    }


    /* user profile update */
    public function userProfileStore(Request $request){
        $user = User::find(Auth::user()->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        if($request->hasFile('profile_photo_path')){
            @unlink(public_path('/upload/user_images/'. $user->profile_photo_path));
            $file = $request->file('profile_photo_path');
            $fileName = date('YmdHi').'.'.$file->getClientOriginalExtension();
            $file->move(public_path('upload/user_images'), $fileName);
            $user->profile_photo_path = $fileName;
        }
        $user->save();
        $notification = array(
            'message' => 'User profile Updated Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->route('dashboard')->with($notification);
    } /* // end userProfileStore */


    public function userChangePassword(){
        $id = Auth::user()->id;
        $user = User::find($id);
        return view('frontend.profile.user_change_password',compact('user'));
    }


    public function userUpdatePassword(Request $request){
        $request->validate([
            'oldpassword' => 'required',
            'password' => 'required|confirmed',
        ]);
        //dd("ook");
        $user = User::find(Auth::user()->id);
        $hashedPass = $user->password;
        if(Hash::check($request->oldpassword,$hashedPass)){
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('user.logout');
        }else{
            // Redirect back with a success message
            $notification = array(
                'message' => 'Current password is not matched',
                'alert-type' => 'error'
            );

            return redirect()->back()->with($notification);
        }
    }
}
