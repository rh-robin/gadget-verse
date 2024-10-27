<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Setting;

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    public function siteSetting(){
        
        $setting = Setting::find(1);
        return view('backend.setting.setting_edit', compact('setting'));
    }

    public function settingUpdate(Request $request){
        $setting = Setting::find(1);
        if($request->file('logo')){
            $img = $request->file('logo');
            $img_name = hexdec(uniqid()) .'.'. $request->file('logo')->getClientOriginalExtension();
            $img_url = 'upload/logo/'.$img_name;
            $img->move(public_path('upload/logo'), $img_name);
            $setting->logo = $img_url;
        }
        $setting->company_name = $request->company_name;
        $setting->address = $request->address;
        $setting->phone_one = $request->phone_one;
        $setting->phone_two = $request->phone_two;
        $setting->email = $request->email;
        $setting->facebook = $request->facebook;
        $setting->twitter = $request->twitter;
        $setting->linkedin = $request->linkedin;
        $setting->youtube = $request->youtube;
        $setting->instagram = $request->instagram;
        $setting->refer_discount = $request->refer_discount;
        $setting->inside_dhaka = $request->inside_dhaka;
        $setting->outside_dhaka = $request->outside_dhaka;
        $setting->save();

        $notification = array(
            'message' => 'Setting Updated Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }
}
