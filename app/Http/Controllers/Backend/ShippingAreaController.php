<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ShipDivision;
use App\Models\ShipDistrict;

class ShippingAreaController extends Controller
{
    public function divisionView(){
        $divisions = ShipDivision::all();

        return view('backend.shipping.division_view',compact('divisions'));
    }

    public function divisionStore(Request $request){
        $request->validate([
            'division_name' => 'required|unique:ship_divisions,division_name',
        ]);

        $division = new ShipDivision();
        $division->division_name = strtolower($request->division_name);
        $division->save();

        $notification = [
            'message' => 'Division Inserted Successfully',
            'alert-type'=> 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function divisionEdit($id){
        $division = ShipDivision::findOrFail($id);
        return view('backend.shipping.division_edit',compact('division'));
    }


    public function divisionUpdate(Request $request, $id){
        $division = ShipDivision::findOrFail($id);
        $request->validate([
            'division_name' => 'required|unique:ship_divisions,division_name,'. $division->id,
        ]);

        
        $division->division_name = strtolower($request->division_name);
        $division->save();

        $notification = [
            'message' => 'Division Updated Successfully',
            'alert-type'=> 'success'
        ];

        return redirect()->back()->with($notification);
    }


    public function divisionDelete($id){
    	ShipDivision::findOrFail($id)->delete();

    	$notification = array(
			'message' => 'Division Deleted Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

    } // end method

    public function divisionInactive($id){
    	ShipDivision::findOrFail($id)->update(['status' => 0]);

    	$notification = array(
			'message' => 'Division Inactive Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

    } // end method 


    public function divisionActive($id){
    	ShipDivision::findOrFail($id)->update(['status' => 1]);

    	$notification = array(
			'message' => 'Division Active Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

    } // end method 




    /* ================== district related function =============== */
    public function districtView(){
        $divisions = ShipDivision::all();
        $districts = ShipDistrict::all();

        return view('backend.shipping.district_view',compact('districts','divisions'));
    }

    public function districtStore(Request $request){
        $request->validate([
            'district_name' => 'required|unique:ship_districts,district_name',
            'division_id' => 'required',
        ],[
            'division_id.required' => 'Division name is required'
        ]);

        $district = new ShipDistrict();
        $district->district_name = strtolower($request->district_name);
        $district->division_id = $request->division_id;
        $district->shipping_charge = $request->shipping_charge;
        $district->save();

        $notification = [
            'message' => 'District Inserted Successfully',
            'alert-type'=> 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function districtEdit($id){
        $divisions = ShipDivision::all();
        $district = ShipDistrict::findOrFail($id);
        return view('backend.shipping.district_edit',compact('district', 'divisions'));
    }

    public function districtUpdate(Request $request, $id){
        $district = ShipDistrict::findOrFail($id);
        $request->validate([
            'district_name' => 'required|unique:ship_districts,district_name,'. $district->id,
            'division_id' => 'required',
        ],[
            'division_id.required' => 'Division Name is Required'
        ]);

        $district->district_name = strtolower($request->district_name);
        $district->division_id = $request->division_id;
        $district->shipping_charge = $request->shipping_charge;
        $district->save();

        $notification = [
            'message' => 'District Updated Successfully',
            'alert-type'=> 'success'
        ];

        return redirect()->back()->with($notification);
    }

    public function districtDelete($id){
    	ShipDistrict::findOrFail($id)->delete();

    	$notification = array(
			'message' => 'District Deleted Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

    } // end method

    public function districtInactive($id){
    	ShipDistrict::findOrFail($id)->update(['status' => 0]);

    	$notification = array(
			'message' => 'District Inactive Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

    } // end method 


    public function districtActive($id){
    	ShipDistrict::findOrFail($id)->update(['status' => 1]);

    	$notification = array(
			'message' => 'District Active Successfully',
			'alert-type' => 'info'
		);

		return redirect()->back()->with($notification);

    } // end method 
}
