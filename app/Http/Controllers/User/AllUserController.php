<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ShipDivision;
use App\Models\ShipDistrict;
use App\Models\ShippingDetail;
use App\Models\Order;
use App\Models\OrderItem;

use Gloudemans\Shoppingcart\Facades\Cart;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf;

class AllUserController extends Controller
{
    public function userAllOrders(){
        $orders = Order::where('user_id', Auth::id())->orderBy('id','DESC')->get();
        
        return view('frontend.profile.user_orders', compact('orders'));
    }

    public function orderDetails($order_id){
        $order = Order::where('id', $order_id)->where('user_id', Auth::id())->first();
        $orderItems = OrderItem::where('order_id', $order_id)->get();
        return view('frontend.profile.user_order_details', compact('order', 'orderItems'));
    }

    public function invoiceDownload($order_id){
        $order = Order::where('id', $order_id)->where('user_id', Auth::id())->first();
        $orderItems = OrderItem::where('order_id', $order_id)->get();
        //return view('frontend.profile.user_order_invoice', compact('order', 'orderItems'));
        $data = [
            'order' => $order,
            'orderItems' => $orderItems
        ];
        $pdf = Pdf::loadView('frontend.profile.user_order_invoice', $data)->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('gadget-verse-invoice.pdf');
    }
}
