<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Slider;
use App\Models\SliderItem;
 

use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;

class SliderController extends Controller
{
    public function view(){
		$sliders = Slider::latest()->get();
		return view('backend.slider.slider_view',compact('sliders'));
	}


	public function add(){
        
        return view('backend.slider.slider_add',compact());
    }


    public function store(Request $request){
        // Validate the request
		$validatedData = $request->validate([
			'slider_name' => 'required'
		]);
        $slider = new Slider();
        
        $slider->slider_name = $request->slider_name;
        $slider->save();

		foreach(range(0, 2) as $index){
			$sliderItem = new SliderItem();
			$sliderItem->slider_id = $slider->id;
			$sliderItem->save();
		}

        // Redirect back with a success message
		$notification = array(
			'message' => 'Slider Created Successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);
    }


    public function edit($id){
        $slider = Slider::findOrFail($id);
		$sliderItems = SliderItem::where('slider_id', $id)->get();
        return view('backend.slider.slider_edit',compact('slider', 'sliderItems'));
    }

    public function update(Request $request){
        //dd($request->all());
		$validatedData = $request->validate([
			'slider_image.*' => 'mimes:jpeg,png,jpg'
		],[
			'slider_image.*' => 'Slider image must be a file of type: jpeg, png, jpg.'
		]);
		
        $sliderId = $request->id;
		$sliderItems = SliderItem::where('slider_id', $sliderId)->get();
        //dd($sliderItem);

		foreach (range(0, 2) as $index) {
			if (isset($sliderItems[$index])) {
				$sliderItem = $sliderItems[$index];
			
				if($request->title[$index]){
					$sliderItem->title = $request->title[$index];
				}
				if($request->sub_title[$index]){
					$sliderItem->sub_title = $request->sub_title[$index];
				}
				if($request->button_link[$index]){
					$sliderItem->button_link = $request->button_link[$index];
				}
				if ($request->hasFile('slider_image') && isset($request->file('slider_image')[$index])) {
					if($sliderItem->image_source){
						unlink($sliderItem->image_source);
					}
					
					$manager = new ImageManager(new Driver());
					$fileName = hexdec(uniqid()) . '.' . $request->file('slider_image')[$index]->getClientOriginalExtension();

					$image = $manager->read($request->file('slider_image')[$index]);
					$image = $image->resize(442, 645);

					$thumbnailDirectory = public_path('upload/sliders');
					File::makeDirectory($thumbnailDirectory, $mode = 0777, true, true);
					$image->toJpeg(80)->save($thumbnailDirectory . '/' . $fileName);

					$save_url = 'upload/sliders/' . $fileName;
					$sliderItem->image_source = $save_url;
				}
				$sliderItem->update();
			}
		}
		$notification = array(
			'message' => 'Slider Items Updated Successfully',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);
    }


    public function delete($id){
    	Slider::findOrFail($id)->delete();

    	$notification = array(
			'message' => 'Slider Deleted Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

    } // end method


    public function inactive($id){
    	Slider::findOrFail($id)->update(['status' => 0]);

    	$notification = array(
			'message' => 'Slider Inactive Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

    } // end method 


    public function active($id){
    	Slider::findOrFail($id)->update(['status' => 1]);

    	$notification = array(
			'message' => 'Slider Active Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

    } // end method 
}
