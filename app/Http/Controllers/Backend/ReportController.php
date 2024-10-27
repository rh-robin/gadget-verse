<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use DateTime;
use Illuminate\Http\Request;


use App\Models\Order;

class ReportController extends Controller
{
    public function searchReport(){
        return view('backend.report.search_report');
    }
    public function reportByDate(Request $request){
        $date = new DateTime($request->date);
        $formatDate = $date->format('d-F-Y');
        
        $orders = Order::where('order_date',$formatDate)->orderBy('id','DESC')->get();

        return view('backend.report.orders_view', compact('orders'));
    }

    public function reportByMonth(Request $request){
        
        $orders = Order::where('order_month',$request->month)->where('order_year',$request->year)->orderBy('id','DESC')->get();

        return view('backend.report.orders_view', compact('orders'));
    }

    public function reportByYear(Request $request){
        
        $orders = Order::where('order_year',$request->year)->orderBy('id','DESC')->get();

        return view('backend.report.orders_view', compact('orders'));
    }

    
    
}
