<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Coupon;
use Carbon\Carbon;

class CouponController extends Controller
{
    public function view(){
        $coupons = Coupon::orderBy('id','DESC')->get();

        return view('backend.coupon.coupon_view',compact('coupons'));
    }

    public function store(Request $request){
        $request->validate([
            'code' => 'required|unique:coupons,code',
            'value' => 'required',
            'type' => 'required',
            'validity' => 'required',
        ],[
            'value.required' => 'The amount field is required'
        ]);

        $coupon = new Coupon();
        $coupon->code = strtoupper($request->code);
        $coupon->value = $request->value;
        $coupon->type = $request->type;
        $coupon->validity = $request->validity;
        $coupon->cart_value = $request->cart_value;
        $coupon->created_at = Carbon::now();
        $coupon->save();

        $notification = [
            'message' => 'Coupon Inserted Successfully',
            'alert-type'=> 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function edit($id){
        $coupon = Coupon::findOrFail($id);
        return view('backend.coupon.coupon_edit',compact('coupon'));
    }

    public function update(Request $request, $id){
        $coupon = Coupon::findOrFail($id);
        $request->validate([
            'code' => 'required|unique:coupons,code,' .$coupon->id,
            'value' => 'required',
            'type' => 'required',
            'validity' => 'required',
        ],[
            'value.required' => 'The amount field is required'
        ]);

        $coupon->code = strtoupper($request->code);
        $coupon->value = $request->value;
        $coupon->type = $request->type;
        $coupon->validity = $request->validity;
        $coupon->cart_value = $request->cart_value;
        $coupon->created_at = Carbon::now();
        $coupon->save();

        $notification = [
            'message' => 'Coupon Updated Successfully',
            'alert-type'=> 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function delete($id){
    	Coupon::findOrFail($id)->delete();

    	$notification = array(
			'message' => 'Coupon Delectd Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

    } // end method

    public function inactive($id){
    	Coupon::findOrFail($id)->update(['status' => 0]);

    	$notification = array(
			'message' => 'Coupon Inactive Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

    } // end method 


    public function active($id){
    	Coupon::findOrFail($id)->update(['status' => 1]);

    	$notification = array(
			'message' => 'Coupon Active Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

    } // end method 
}
