<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SubSubCategory;
use App\Models\SubCategory;
use App\Models\Category;

class SubSubCategoryController extends Controller
{
    public function view(){
        $categories = Category::orderBy('category_name','ASC')->get();
        //dd($categories);
        $subsubcategories = SubSubCategory::all();
        return view("backend.category.sub_subcategory_view", compact("subsubcategories","categories"));
    }


    
    /* store category */
    public function store(Request $request){
        $request->validate([
            'subsubcategory_name' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
        ],[
            'subsubcategory_name.required' => 'Sub Sub-Category name is required',
            'category_id.required' => 'Please select a category',
            'subcategory_id.required' => 'Please select a Sub-category',
        ]);
        $subsubcategory = new SubSubCategory;
        $subsubcategory->subsubcategory_name = $request->subsubcategory_name;
        $subsubcategory->subsubcategory_slug = strtolower(str_replace(' ', '-', $request->subsubcategory_name));
        $subsubcategory->category_id = $request->category_id;
        $subsubcategory->subcategory_id = $request->subcategory_id;
        $subsubcategory->save();
        $notification = array(
            'message' => 'Sub Sub-Category inserted Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    } // end store


    // edit sub sub-category
    public function edit($id){
        $categories = Category::orderBy('category_name','ASC')->get();
        //$subcategories = SubCategory::orderBy('subcategory_name_en','ASC')->get();
        $subsubcategory = SubSubCategory::findOrFail($id);
        $subcategories = Subcategory::where('category_id',$subsubcategory->category_id)->get();
        return view('backend.category.sub_subcategory_edit', compact('subsubcategory', 'subcategories','categories'));
    } //end edit


    /* update subcategory */
    public function update(Request $request){
        $id = $request->id;
        $request->validate([
            'subsubcategory_name' => 'required',
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'status' => 'required',
        ],[
            'subsubcategory_name.required' => 'Sub Sub-Category name is required',
            'category_id.required' => 'Please select a category',
            'subcategory_id.required' => 'Please select a Sub-category',
        ]);
        $subsubcategory = SubSubCategory::findOrFail($id);
        $subsubcategory->subsubcategory_name = $request->subsubcategory_name;
        $subsubcategory->subsubcategory_slug = strtolower(str_replace(' ', '-', $request->subsubcategory_name));
        $subsubcategory->category_id = $request->category_id;
        $subsubcategory->subcategory_id = $request->subcategory_id;
        $subsubcategory->status = $request->status;
        $subsubcategory->save();
        $notification = array(
            'message' => 'Sub Sub-Category Updated Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    } // end update


    // delete sub sub-category
    public function delete($id){
        SubSubCategory::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Sub Sub-Category Deleted Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }


    /* get category wise sub-category */
    public function getSubCategory($category_id){
        $subcategory = SubCategory::where('category_id',$category_id)->orderBy('subcategory_name', 'ASC')->get();
        //dd($subcategory);
        return json_encode($subcategory);
    }

    /* get subcategory wise sub sub-category */
    public function getSubSubCategory($subcategory_id){
        $subsubcategory = SubSubCategory::where('subcategory_id',$subcategory_id)->orderBy('subsubcategory_name', 'ASC')->get();
        //dd($subsubcategory);
        return json_encode($subsubcategory);
    }
}
