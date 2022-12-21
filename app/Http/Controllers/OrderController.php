<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Feeship;
use App\Models\Customer;
use Illuminate\Support\Facades\Session;
use App\Models\Product;
use Illuminate\Support\Facades\Redirect;
use PDO;

session_start();
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
    //USER ORDERS
    public function my_order()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        $customer_id = Session::get('customer_id');
        $order = Order::where('customer_id', $customer_id)->orderby('created_at', 'DESC')->get();

        return view('pages.orders.my_order')->with(compact('order'))->with('category', $cate_product)->with('brand', $brand_product);
    }
    public function my_order_detail($OrderCode)
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        $order = Order::where('order_code', $OrderCode)->first();
        $detail = OrderDetails::where('order_code', $OrderCode)->get();

        $shipping = Shipping::where('shipping_id',  $order->shipping_id)->first();

        $od_details = OrderDetails::with('product')->where('order_code', $OrderCode)->get();

        return view('pages.orders.my_order_detail')->with(compact('order', 'detail', 'shipping', 'od_details',))->with('category', $cate_product)->with('brand', $brand_product);
    }
    public function update_order_status($OrderCode, Request $request)
    {

        $status = $request->od_status;
        Order::where('order_code', $OrderCode)->update(['order_status' => $status]);
        $request->session()->put('message', 'Cập nhật trạng thái đơn hàng thành công');
        return Redirect::to('/manage-order');
    }
}