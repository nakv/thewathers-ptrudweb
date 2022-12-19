<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Feeship;
use App\Models\Customer;

class OrderController extends Controller
{
    /**
     * Display a listing of the order.
     * @param  int $OrderCode
     * @return view
     */
    public function view_order($OrderCode)
    {
        $order = Order::where('order_code', $OrderCode)->get();
        $detail = OrderDetails::where('order_code', $OrderCode)->get();
        foreach ($order as $key => $od) {
            $customer_id = $od->customer_id;
            $shipping_id = $od->shipping_id;
        }
        $customer = Customer::where('customer_id', $customer_id)->first();
        $shipping = Shipping::where('shipping_id', $shipping_id)->first();

        $od_details = OrderDetails::with('product')->where('order_code', $OrderCode)->get();

        return view('admin.view_order')->with(compact('order', 'detail', 'customer', 'shipping', 'od_details'));
    }

    public function manage_order()
    {
        $order = Order::orderby('created_at', 'DESC')->get();
        return view('admin.manage_order')->with(compact('order'));
    }
}