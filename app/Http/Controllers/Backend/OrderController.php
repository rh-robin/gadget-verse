<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\ShipDivision;
use App\Models\ShipDistrict;
use App\Models\ShippingDetail;
use App\Models\Order;
use App\Models\OrderItem;

use Barryvdh\DomPDF\Facade\Pdf;

class OrderController extends Controller
{
    public function pendingOrders(){
        $orders = Order::where('status','pending')->orderBy('id','DESC')->get();

        return view('backend.order.pending_orders', compact('orders'));
    }

    public function orderDetails($order_id){
        $order = Order::where('id', $order_id)->first();
        $orderItems = OrderItem::where('order_id', $order_id)->get();
        return view('backend.order.order_details', compact('order', 'orderItems'));
    }

    public function acceptedOrders(){
        $orders = Order::where('status','accepted')->orderBy('id','DESC')->get();

        return view('backend.order.accepted_orders', compact('orders'));
    }

    public function processingOrders(){
        $orders = Order::where('status','processing')->orderBy('id','DESC')->get();

        return view('backend.order.processing_orders', compact('orders'));
    }

    public function pickedOrders(){
        $orders = Order::where('status','picked')->orderBy('id','DESC')->get();

        return view('backend.order.picked_orders', compact('orders'));
    }

    public function shippedOrders(){
        $orders = Order::where('status','shipped')->orderBy('id','DESC')->get();

        return view('backend.order.shipped_orders', compact('orders'));
    }

    public function deliveredOrders(){
        $orders = Order::where('status','delivered')->orderBy('id','DESC')->get();

        return view('backend.order.delivered_orders', compact('orders'));
    }

    public function canceledOrders(){
        $orders = Order::where('status','canceled')->orderBy('id','DESC')->get();

        return view('backend.order.canceled_orders', compact('orders'));
    }



    /* =========== update status ============== */
    public function pendingToAccept($order_id){
        $order = Order::findOrFail($order_id);
        $order->status = "accepted";
        $order->save();

        $notification = [
            'message' => 'Order Accepted Successfully',
            'alert-type'=> 'success'
        ];

        return redirect()->route('order.pending.view')->with($notification);
    }


    public function acceptToProcessing($order_id){
        $order = Order::findOrFail($order_id);
        $order->status = "processing";
        $order->save();

        $notification = [
            'message' => 'Order Procesing',
            'alert-type'=> 'success'
        ];

        return redirect()->route('order.accepted.view')->with($notification);
    }

    public function processingToPicked($order_id){
        $order = Order::findOrFail($order_id);
        $order->status = "picked";
        $order->save();

        $notification = [
            'message' => 'Order Picked Successfully',
            'alert-type'=> 'success'
        ];

        return redirect()->route('order.processing.view')->with($notification);
    }

    public function pickedToShipped($order_id){
        $order = Order::findOrFail($order_id);
        $order->status = "shipped";
        $order->save();

        $notification = [
            'message' => 'Order Shipped Successfully',
            'alert-type'=> 'success'
        ];

        return redirect()->route('order.picked.view')->with($notification);
    }

    public function shippedToDelivered($order_id){
        $order = Order::findOrFail($order_id);
        $order->status = "delivered";
        $order->save();

        $notification = [
            'message' => 'Order Delivered Successfully',
            'alert-type'=> 'success'
        ];

        return redirect()->route('order.shipped.view')->with($notification);
    }

    public function pendingToCancel($order_id){
        $order = Order::findOrFail($order_id);
        $order->status = "canceled";
        $order->save();

        $notification = [
            'message' => 'Order Canceled Successfully',
            'alert-type'=> 'success'
        ];

        return redirect()->route('order.pending.view')->with($notification);
    }

    /* ====== invoice download */
    public function invoiceDownload($order_id){
        $order = Order::where('id', $order_id)->first();
        $orderItems = OrderItem::where('order_id', $order_id)->get();
        //return view('backend.order.order_invoice', compact('order', 'orderItems'));
        $data = [
            'order' => $order,
            'orderItems' => $orderItems
        ];
        $pdf = Pdf::loadView('backend.order.order_invoic', $data)->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('gadget-verse-invoice.pdf');
    }
    
}
