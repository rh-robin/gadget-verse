<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubCategory;
use App\Models\Category;

class SubCategoryController extends Controller
{
    public function view(){
        $categories = Category::orderBy('category_name','ASC')->get();
        //dd($categories);
        $subcategories = SubCategory::all();
        return view("backend.category.subcategory_view", compact("subcategories","categories"));
    }

    /* store category */
    public function store(Request $request){
        $request->validate([
            'subcategory_name' => 'required',
            'category_id' => 'required',
        ],[
            'subcategory_name.required' => 'Sub Category name is required',
            'category_id.required' => 'Please select a category',
        ]);
        $subcategory = new SubCategory;
        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->subcategory_slug = strtolower(str_replace(' ', '-', $request->subcategory_name));
        $subcategory->category_id = $request->category_id;
        $subcategory->save();
        $notification = array(
            'message' => 'Sub Category inserted Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    } // end store


    // edit sub category
    public function edit($id){
        $categories = Category::orderBy('category_name','ASC')->get();
        $subcategory = SubCategory::findOrFail($id);
        return view('backend.category.subcategory_edit', compact('subcategory','categories'));
    } //end edit

    /* update subcategory */
    public function update(Request $request){
        $id = $request->id;
        $request->validate([
            'subcategory_name' => 'required',
            'category_id' => 'required',
            'status' => 'required',
        ],[
            'subcategory_name.required' => 'Sub Category name is required',
            'category_id.required' => 'Please select a category',
        ]);
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->subcategory_name = $request->subcategory_name;
        $subcategory->subcategory_slug = strtolower(str_replace(' ', '-', $request->subcategory_name));
        $subcategory->category_id = $request->category_id;
        $subcategory->status = $request->status;
        $subcategory->save();
        $notification = array(
            'message' => 'Sub Category Updated Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    } // end update


    // delete subcategory
    public function delete($id){
        SubCategory::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Sub Category Deleted Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }

    /* active on click */
    public function inactive($id){
		$subcategory = SubCategory::findOrFail($id);
        $subcategory->status = 0;
        $subcategory->save();
		$notification = array(
		   'message' => 'Sub Category Inactive',
		   'alert-type' => 'success'
	   );

	   return redirect()->back()->with($notification);
	}

    /* inactive on click */
 	public function active($id){
        $subcategory = SubCategory::findOrFail($id);
        $subcategory->status = 1;
        $subcategory->save();
		$notification = array(
		   'message' => 'Sub Category Active',
		   'alert-type' => 'success'
	    );

	   return redirect()->back()->with($notification);
		
	}

}
