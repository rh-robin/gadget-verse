<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ProductReview;

class ReviewController extends Controller
{
    public function view(){
        $reviews = ProductReview::latest()->get();
        
        return view('backend.review.review_view',compact('reviews'));
    }

    public function edit($id){
        $review = ProductReview::findOrFail($id);
        return view('backend.review.review_edit', compact('review'));
    }

    public function update(Request $request){
        // Validate the request data
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required',
        ]);

        $id = $request->id;
        $review = ProductReview::findOrFail($id);
        $review->rating = $request->rating;
        $review->review = $request->review;
        $review->status = $request->status;

        $review->update();

        $notification = array(
			'message' => 'Review Updated',
			'alert-type' => 'success'
		);

		return redirect()->back()->with($notification);
    }

    public function delete($id){
        $review = ProductReview::findOrFail($id);
        $review->delete();
        $notification = array(
            'message' => 'Review Deleted Successfully',
            'alert-type'=> 'success'
        );
        return redirect()->back()->with($notification);
    }


    /* active on click */
    public function reject($id){
		$review = ProductReview::findOrFail($id);
        $review->status = 0;
        $review->save();
		$notification = array(
		   'message' => 'Review Rejected',
		   'alert-type' => 'success'
	   );

	   return redirect()->back()->with($notification);
	}

    /* inactive on click */
 	public function approve($id){
        $review = ProductReview::findOrFail($id);
        $review->status = 1;
        $review->save();
		$notification = array(
		   'message' => 'Review Approved',
		   'alert-type' => 'success'
	    );

	   return redirect()->back()->with($notification);
		
	}

    public function submitReview(Request $request)
    {
        // Validate the request data
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required',
        ]);

        // Create a new review
        $review = new ProductReview();
        $review->rating = $request->rating;
        $review->review = $request->review;
        $review->product_id = $request->product_id;
        $review->user_id = auth()->id(); // Assuming the user is authenticated

        // Save the review to the database
        $review->save();

        // Return a success response
        return response()->json(["success" => "Review Added"]);
    }
}
