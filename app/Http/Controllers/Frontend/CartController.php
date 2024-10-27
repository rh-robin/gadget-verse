<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariation;
use App\Models\ProductMultiImage;
use App\Models\Coupon;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Http\Request;

use Gloudemans\Shoppingcart\Facades\Cart;

use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Auth;

class CartController extends Controller
{
    public function addToCart(Request $request, $id){
        $product = Product::findOrFail($id);
        $name = $request->productName;
        $size = $request->size;
        $color = $request->color;
        $qty = $request->qty;
        $variation = $product->variations()->where('size',$size)->where('color_name',$color)->first();
        $image = ProductMultiImage::where('product_variation_id', $variation->id)->first();
        if($image == null){
            $image = $product->product_thumbnail;
        }else{
            $image = $image->image_source;
        }
        $price = 0;
        if($variation->discount_price == null){
            $price = $variation->selling_price;
        }else{
            $price = $variation->discount_price;
        }
        Cart::add([
            'id' => $id,
            'name' => $name, 
            'qty' => $qty, 
            'price' => $price, 
            'weight' => 1, 
            'options' => [
                'size' => $size,
                'color' => $color,
                'image' => $image,
                ]
        ]);
        return response()->json(["success"=>"Added To Cart Successfully"]);
    }


    public function miniCart(){
        $carts = Cart::content();
        $cartCount = Cart::count();
        $cartTotal = Cart::total();

        return response()->json([
            'carts' => $carts,
            'cartCount' => $cartCount,
            'cartTotal' => $cartTotal,
        ]);
    }

    public function removeFromCart($rowId){
        Cart::remove($rowId);
        return response()->json(["success" => "Product Removed From Cart"]);
    }

    public function viewCart(){
        return view("frontend.cart.cart_view");
    }

    public function getCartContent(){
        $carts = Cart::content();
        $cartCount = Cart::count();
        $cartTotal = Cart::total();

        return response()->json([
            'carts' => $carts,
            'cartCount' => $cartCount,
            'cartTotal' => $cartTotal,
        ]);
    }

    public function cartIncrement($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);

        if(Session::has('coupon')){
            $couponCode = Session::get('coupon')['coupon_code'];
            $coupon = Coupon::where('code', $couponCode)->where('validity','>=', Carbon::now()->format('Y-m-d'))->where('status',1)->first();
            if($coupon){
                if($coupon->cart_value > Cart::total()){
                    return response()->json(["error" => "Minimum cart amount is ".$coupon->cart_value."tk for this coupon"]);
                }else{
                    $discountAmount=0;
                    if($coupon->type == 1){
                        $discountAmount = $coupon->value;
                    }else{
                        $discountAmount = round(Cart::total() * $coupon->value / 100);
                    }
                    Session::put('coupon',[
                        'coupon_code' =>$coupon->code,
                        'coupon_discount' => $coupon->value,
                        'discount_amount' => $discountAmount,
                        'total_amount' => round(Cart::total() - $discountAmount),
                    ]);
                }
            }else{
                return response()->json(["error" => "Invalid Coupon"]);
            }
        }

        return response()->json(["success" => "Quantity Incremented"]);
    }

    public function cartDecrement($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);

        if(Session::has('coupon')){
            $couponCode = Session::get('coupon')['coupon_code'];
            $coupon = Coupon::where('code', $couponCode)->where('validity','>=', Carbon::now()->format('Y-m-d'))->where('status',1)->first();
            if($coupon){
                if($coupon->cart_value > Cart::total()){
                    Session::forget('coupon');
                    return response()->json(["error" => "Minimum cart amount is ".$coupon->cart_value."tk for this coupon"]);
                }else{
                    $discountAmount=0;
                    if($coupon->type == 1){
                        $discountAmount = $coupon->value;
                    }else{
                        $discountAmount = round(Cart::total() * $coupon->value / 100);
                    }
                    Session::put('coupon',[
                        'coupon_code' =>$coupon->code,
                        'coupon_discount' => $coupon->value,
                        'discount_amount' => $discountAmount,
                        'total_amount' => round(Cart::total() - $discountAmount),
                    ]);
                }
            }else{
                return response()->json(["error" => "Invalid Coupon"]);
            }
        }
        

        return response()->json(["success" => "Quantity Decremented"]);
    }


    /* ====== coupon function ====== */
    public function couponApply(Request $request){
        if(Session::has('gv-refer')){
            return response()->json(["error" => "A referral code has already been applied."]);
        }
        $coupon = Coupon::where('code', $request->coupon)->where('validity','>=', Carbon::now()->format('Y-m-d'))->where('status',1)->first();
        if($coupon){
            if($coupon->cart_value > Cart::total()){
                return response()->json(["error" => "Minimum cart amount is ".$coupon->cart_value."tk for this coupon"]);
            }else{
                $discountAmount=0;
                if($coupon->type == 1){
                    $discountAmount = $coupon->value;
                }else{
                    $discountAmount = round(Cart::total() * $coupon->value / 100);
                }
                Session::put('gv-coupon',[
                    'coupon_code' =>$coupon->code,
                    'coupon_discount' => $coupon->value,
                    'discount_amount' => $discountAmount,
                    'total_amount' => round(Cart::total() - $discountAmount),
                ]);
                return response()->json(["success" => "Coupon Applied"]);
            }
        }else{
            return response()->json(["error" => "Invalid Coupon"]);
        }
    }

    public function couponCalculation(){
        if(Session::has('gv-coupon')){
            return response()->json([
                'subTotal' => Cart::total(),
                'coupon_code' => Session::get('gv-coupon')['coupon_code'],
                'coupon_discount' => Session::get('gv-coupon')['coupon_discount'],
                'discount_amount' => Session::get('gv-coupon')['discount_amount'],
                'total_amount' => Session::get('gv-coupon')['total_amount'],
            ]);
        }else{
            return response()->json([
                'total' => Cart::total(),
            ]);
        }
    }

    public function couponRemove(){
        if(Session::has('gv-coupon')){
            Session::forget('gv-coupon');
            return response()->json(["success" => "Coupon Removed Successfully"]);
        }
        
    }


    /* ========================== refer code ======================= */
    public function referCodeApply(Request $request){
        if(Session::has('gv-coupon')){
            return response()->json(["error" => "A coupon has already been applied."]);
        }

        $referUser = User::where('refer_code', $request->referCode)->first();
        
        if($referUser){
            $referCode = $referUser->refer_code;
            $setting = Setting::first();

            $discountAmount = round(Cart::total() * $setting->refer_discount / 100);
            
            Session::put('gv-refer',[
                'refer_code' =>$referCode,
                'refer_discount' => $setting->refer_discount,
                'discount_amount' => $discountAmount,
                'total_amount' => round(Cart::total() - $discountAmount),
            ]);
            return response()->json(["success" => "Referral code Applied"]);
            
        }else{
            return response()->json(["error" => "Invalid Refer-code"]);
        } 
    }

    public function referCalculation(){
        if(Session::has('gv-refer')){
            return response()->json([
                'subTotal' => Cart::total(),
                'refer_code' => Session::get('gv-refer')['refer_code'],
                'refer_discount' => Session::get('gv-refer')['refer_discount'],
                'discount_amount' => Session::get('gv-refer')['discount_amount'],
                'total_amount' => Session::get('gv-refer')['total_amount'],
            ]);
        }else{
            return response()->json([
                'total' => Cart::total(),
            ]);
        }
    }


    public function referRemove(){
        if(Session::has('gv-refer')){
            Session::forget('gv-refer');
            return response()->json(["success" => "Referral Code Removed Successfully"]);
        }
        
    }


    
}
