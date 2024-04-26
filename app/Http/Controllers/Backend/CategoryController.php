<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function view(){
        $categories = Category::all();
        return view("backend.category.category_view", compact("categories"));
    }


    /* store category */
    public function store(Request $request){
        
        $request->validate([
            'category_name' => 'required'
        ],[
            'category_name.required' => 'Category name is required',
        ]);

        
        Category::insert([
            'category_name' => $request->category_name,
            'category_slug' => strtolower(str_replace(' ','-', $request->category_name)),
            'category_icon' => $request->category_icon,
        ]);
        $notification = array(
            'message' => 'Category inserted Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    } // end store

    public function edit($id){
        $category = Category::findOrFail($id);
        return view('backend.category.category_edit', compact('category'));
    }


    /* update category */
    public function update(Request $request){
        $id = $request->id;
        $request->validate([
            'category_name' => 'required'
        ],[
            'category_name.required' => 'Category name is required',
        ]);

        $category = Category::findOrFail($id);
        $category->category_name = $request->category_name;
        $category->category_slug = strtolower(str_replace(' ', '-', $request->category_name));
        $category->category_icon = $request->category_icon;
        $category->status = $request->status;
        

        // Save the changes
        $category->save();

        $notification = [
            'message' => 'Category Updated Successfully',
            'alert-type'=> 'success'
        ];

        return redirect()->back()->with($notification);
    } // end update


    public function delete($id){
        $category = Category::findOrFail($id);
        Category::findOrFail($id)->delete();
        $notification = array(
            'message' => 'Category Deleted Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }


    /* active on click */
    public function inactive($id){
		$category = Category::findOrFail($id);
        $category->status = 0;
        $category->save();
		$notification = array(
		   'message' => 'Category Inactive',
		   'alert-type' => 'success'
	   );

	   return redirect()->back()->with($notification);
	}

    /* inactive on click */
 	public function active($id){
        $category = Category::findOrFail($id);
        $category->status = 1;
        $category->save();
		$notification = array(
		   'message' => 'Category Active',
		   'alert-type' => 'success'
	    );

	   return redirect()->back()->with($notification);
		
	}


    

}



