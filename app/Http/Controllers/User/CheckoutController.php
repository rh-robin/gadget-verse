<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Mail\OrderMail;
use Illuminate\Http\Request;

use App\Models\ShipDivision;
use App\Models\ShipDistrict;
use App\Models\ShippingDetail;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Setting;
use App\Models\Product;

use Gloudemans\Shoppingcart\Facades\Cart;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Auth;
use Mail;

class CheckoutController extends Controller
{
    public function createCheckout(){
        //dd("ok");
        if(Auth::check()){
            if(Cart::total() > 0){
                $cartContents = Cart::content();
                $cartCount = Cart::count();
                $cartTotal = Cart::total();
                $divisions = ShipDivision::orderBy('division_name','ASC')->where('status',1)->get();
                return view('frontend.checkout.checkout_view', compact('cartContents','cartCount','cartTotal', 'divisions'));
            }else{
                $notification = array(
                    'message' => 'Add at least one item in your cart',
                    'alert-type' => 'info'
                );
                return redirect()->to('/')->with($notification);
            }
        }else{
            $notification = array(
                'message' => 'You need to login first',
                'alert-type' => 'info'
            );
    
            return redirect()->route('login')->with($notification);
        }
    }

    public function getDistrict($division_id){
        $districts = ShipDistrict::where('division_id',$division_id)->where('status',1)->orderBy('district_name', 'ASC')->get();
        //dd($subcategory);
        return json_encode($districts);
    }

    /* public function getShippingCharge($district_id){
        $district = ShipDistrict::findOrFail($district_id);
        if($district->shipping_charge == null){
            $shippingCharge = 200;
        }else{
            $shippingCharge = $district->shipping_charge;
        }
        $total = 0;
        if(Session::has('coupon')){
            $total = Session::get('coupon')['total_amount'] + $shippingCharge;
        }else{
            $total = Cart::total() + $shippingCharge;
        }

        Session::put('gv_total',[
            'shipping_charge' => $shippingCharge,
            'total' => $total
        ]);

        return json_encode([
            'shipping_charge' => $shippingCharge,
            'total' => $total,
        ]);
    } */


    public function getShippingCharge($value){
        $setting = Setting::first();
        if($value == 'inside'){
            $shippingCharge = $setting->inside_dhaka;
        }
        if($value == 'outside'){
            $shippingCharge = $setting->outside_dhaka;
        }
        $total = 0;
        if(Session::has('gv-coupon')){
            $total = Session::get('gv-coupon')['total_amount'] + $shippingCharge;
        }else if(Session::has('gv-refer')){
            $total = Session::get('gv-refer')['total_amount'] + $shippingCharge;
        }else{
            $total = Cart::total() + $shippingCharge;
        }

        Session::put('gv-total',[
            'shipping_charge' => $shippingCharge,
            'total' => $total
        ]);

        return json_encode([
            'shipping_charge' => $shippingCharge,
            'total' => $total,
        ]);
    }


    public function orderCreate(Request $request){
        //dd($request->all());
        $request->validate([
            /* 'division_id' => 'required',
            'district_id' => 'required', */
            'inOutDhaka' => 'required',
            'address' => 'required',
            'shipping_name' => 'required',
            'shipping_email' => 'required',
            'shipping_phone' => 'required',
            'payment_method' => 'required',
        ],[
            /* 'division_id.required' => 'Division is required',
            'district_id.required' => 'District is required', */
            'inOutDhaka.required' => 'Select inside dhaka or outside dhaka is required.',
        ]);

        $order = new Order();
        $order->user_id = Auth::id();
        $order->invoice_no = 'GV'. mt_rand(10000000, 99999999);
        $order->order_date = Carbon::now()->format('d-F-Y');
        $order->order_month = Carbon::now()->format('F');
        $order->order_year = Carbon::now()->format('Y');
        $order->payment_method = $request->payment_method;
        $order->shipping_charge = Session::get('gv-total')['shipping_charge'];
        $order->amount = Session::get('gv-total')['total'];
        $order->subtotal_amount = Cart::total();
        if(Session::has('gv-coupon')){
            $order->coupon = Session::get('gv-coupon')['coupon_code'];
            $order->discount_amount = Session::get('gv-coupon')['discount_amount'];
        }
        if(Session::has('gv-refer')){
            $order->refer_code = Session::get('gv-refer')['refer_code'];
            $order->discount_amount = Session::get('gv-refer')['discount_amount'];
        }
        $order->status = 'pending';
        $order->save();

        $shipping = new ShippingDetail();
        $shipping->user_id = Auth::id();
        $shipping->order_id = $order->id;
        $shipping->division_id = $request->division_id;
        $shipping->district_id = $request->district_id;
        $shipping->address = $request->address;
        $shipping->shipping_name = $request->shipping_name;
        $shipping->shipping_email = $request->shipping_email;
        $shipping->shipping_phone = $request->shipping_phone;
        $shipping->post_code = $request->post_code;
        $shipping->notes = $request->notes;
        $shipping->save();

        $carts = Cart::content();
        foreach ($carts as $cart) {
            $orderItem = new OrderItem();
            $orderItem->order_id = $order->id;
            $orderItem->product_id = $cart->id;
            $orderItem->product_image = $cart->options->image;
            $orderItem->product_name = $cart->name;
            $orderItem->qty = $cart->qty;
            $orderItem->price = $cart->price;
            $orderItem->color = $cart->options->color;
            $orderItem->size = $cart->options->size;
            $orderItem->save();
        }
        
        if($request->payment_method == "cashon"){
            return redirect()->route('order.completion', $order->id);
        }
        
    }

    public function orderCompletion($orderId){
        $order = Order::findOrFail($orderId);
        $cartContents = Cart::content();
        $cartCount = Cart::count();
        $cartTotal = Cart::total();
        $shippingCharge = Session::get('gv-total')['shipping_charge'];
        $totalAmount = Session::get('gv-total')['total'];
        return view('frontend.checkout.order_confirmation', compact('cartContents','cartCount','cartTotal', 'order', 'shippingCharge', 'totalAmount'));
    }

    public function orderConfirm($orderId){
        $order = Order::findOrFail($orderId);
        $order->order_confirmation = 'confirmed';
        $order->save();

        /* email */
        /* $data = [
            'invoice' => $order->invoice_no,
            'amount' => $order->amount,
            'name' => $order->shippingDetails->shipping_name,
            'email' => $order->shippingDetails->shipping_email,
        ];
        Mail::to($order->shippingDetails->shipping_email)->send(new OrderMail($data)); */
        /* end email */

        if(Session::has('gv-coupon')){
            Session::forget('gv-coupon');
        }
        if(Session::has('gv-refer')){
            Session::forget('gv-refer');
        }
        if(Session::has('gv-total')){
            Session::forget('gv-total');
        }
        Cart::destroy();

        $notification = array(
            'message' => 'Your order has placed successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('user.orders')->with($notification);
    }


}
