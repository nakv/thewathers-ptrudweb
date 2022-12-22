<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Console\View\Components\Alert;
use Illuminate\Console\View\Components\Warn;
use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Shipping;
use App\Models\Customer;
use App\Models\Product;
use Illuminate\Auth\Events\Validated;
use Illuminate\Support\Facades\Validator;
use Symfony\Component\HttpFoundation\Session\SessionBagProxy;
use App\Http\Controllers\ProductController;
use GuzzleHttp\Handler\Proxy;

session_start();


class CheckoutController extends Controller
{
    public function AuthLogin()
    {
        $admin_id =   Session::get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }

    /**
     *
     */
    public function login_checkout()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();

        return view('pages.checkout.login_checkout')->with('category', $cate_product)->with('brand', $brand_product);
    }

    public function add_customer(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'customer_name' => 'required',
                'customer_email' => 'required|email|unique:tbl_customers,customer_email',
                'customer_password' => 'required|min:6|max:20',
                'customer_phone' => 'required|digits:10',
            ]
        );

        if ($validator->fails()) {
            Session::flash('error', 'Đăng ký không thành công.');
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = array();
        $data['customer_name'] = $request->customer_name;
        $data['customer_email'] = $request->customer_email;
        $data['customer_password'] = md5($request->customer_password);
        $data['customer_phone'] = $request->customer_phone;
        $customer_id = DB::table('tbl_customers')->insertGetId($data);
        Session::put('customer_id',  $customer_id);
        Session::put('customer_name', $request->customer_name);
        return Redirect::to('/');
    }

    public function checkout()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        $city = City::orderby('name_city', 'ASC')->get();
        return view('pages.checkout.show_checkout')->with('category', $cate_product)->with('brand', $brand_product)->with('city', $city);
    }

    public function save_checkout_customer(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'shipping_name' => 'required',
            'shipping_email' => 'required|email',
            'shipping_phone' => 'required|digits:10',
            'shipping_address' => 'required',
        ]);
        if ($validator->fails()) {
            $request->session->put('massage', 'Tạo shipping không thành công');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = array();
        $data['shipping_name'] = $request->shipping_name;
        $data['shipping_email'] = $request->shipping_email;
        $data['shipping_note'] = $request->shipping_note;
        $data['shipping_address'] = $request->shipping_address;
        $data['shipping_phone'] = $request->shipping_phone;

        $inserted_Id = DB::table('tbl_shipping')->insertGetId($data);
        Session::put('shipping_id',  $inserted_Id);
        return Redirect::to('/payment');
    }

    public function logout_checkout()
    {
        Session::flush();
        return Redirect('/login-checkout');
    }

    public function login_customer(Request $request)
    {
        $email = $request->email_account;
        $password = md5($request->password_account);
        $result = DB::table('tbl_customers')->where('customer_email', $email)->where('customer_password', $password)->first();
        if ($result) {
            Session::put('customer_id',  $result->customer_id);
            Session::put('customer_name',  $result->customer_name);
            return Redirect::to('/checkout');
        } else {
            Session::put('message', 'Đăng nhập không thành công, sai email hoặc mật khẩu!');
            return Redirect::to('/login-checkout');
        }
    }

    public function payment()
    {
        $customer_id = Session::get('customer_id');
        $order = Order::where('customer_id', $customer_id)->where('order_status', 2)->orWhere('order_status', 3)->orderby('created_at', 'DESC')->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        return view('pages.checkout.payment')->with(compact('order'))->with('category', $cate_product)->with('brand', $brand_product);
    }

    public function order_place(Request $request)
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();

        $data = array();
        $data['payment_method'] = $request->payment_option;
        $data['payment_status'] = 'Đang chờ xử lý';
        $payment_id = DB::table('tbl_payment')->insertGetId($data);
        //
        $order_data = array();
        $order_data['customer_id'] =  Session::get('customer_id');
        $order_data['shipping_id'] =   Session::get('shipping_id');
        $order_data['payment_id'] = $payment_id;
        $order_data['order_total'] = Cart::total(0, '', '');
        $order_data['order_status'] = 'Đang hàng đang chờ xử lý';
        $order_id = DB::table('tbl_order')->insertGetId($order_data);
        //
        $content = Cart::content();
        foreach ($content as $value) {
            $details = array();
            $details['order_id'] =  $order_id;
            $details['product_id'] = $value->id;
            $details['product_name'] = $value->name;
            $details['product_price'] = $value->price;
            $details['product_sales_quantity'] = $value->qty;
            DB::table('tbl_order_details')->insert($details);
        }
        switch ($data['payment_method']) {
            case (1):
                Cart::destroy();
                return view('pages.checkout.bankcash')->with('category', $cate_product)->with('brand', $brand_product);
                break;
            case (2):
                Cart::destroy();
                return view('pages.checkout.handcash')->with('category', $cate_product)->with('brand', $brand_product);
                break;

            case (3):
                Cart::destroy();
                return view('pages.checkout.creditcash')->with('category', $cate_product)->with('brand', $brand_product);
                break;
            default:
                echo ('something went wrong!');
        }
    }

    public function manage_order()
    {
        $this->AuthLogin();
        $all_order = DB::table('tbl_order')
            ->join('tbl_customers', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
            ->select('tbl_order.*', 'tbl_customers.customer_name')
            ->orderby('tbl_order.order_id', 'desc')->get();
        $manager_order = view('admin.manage_order')->with('all_order', $all_order);
        return view('admin_layout')->with('admin.manage_order', $manager_order);
    }

    public function view_order($orderId)
    {
        $this->AuthLogin();
        $products = DB::table('tbl_order_details')
            ->where('order_id', $orderId)
            ->get();
        $order_by_id = DB::table('tbl_order')
            ->join('tbl_customers', 'tbl_order.customer_id', '=', 'tbl_customers.customer_id')
            ->join('tbl_shipping', 'tbl_order.shipping_id', '=', 'tbl_shipping.shipping_id')
            ->join('tbl_order_details', 'tbl_order.order_id', '=', 'tbl_order_details.order_id')
            ->select('tbl_order.*', 'tbl_customers.*', 'tbl_shipping.*', 'tbl_order_details.*')->where('tbl_order.order_id', $orderId)->first();

        $manage_order_by_id = view('admin.view_order')->with('order_by_id', $order_by_id)->with('products', $products);
        return view('admin_layout')->with('admin.view_order', $manage_order_by_id);
    }

    public function select_delivery_user(Request $request)
    {

        $data = $request->all();
        if ($data['action'] == true) {
            $output = '';
            if ($data['action'] == "city") {
                $select_province = Province::where('matp', $data['ma_id'])->orderby('maqh', 'ASC')->get();
                $output .= '<option>--- Chọn quận huyện ---</option>';
                foreach ($select_province as $key => $province) {
                    $output .= '<option value="' . $province->maqh . '">' . $province->name_qh . '</option>';
                }
            } else {
                $select_wards = Wards::where('maqh', $data['ma_id'])->orderby('xaid', 'ASC')->get();
                $output .= '<option>--- Chọn xã phường ---</option>';
                foreach ($select_wards as $key => $ward) {
                    $output .= '<option value="' . $ward->xaid . '">' . $ward->name_xa . '</option>';
                }
            }
        }
        echo $output;
    }

    public function calculate_fee(Request $request)
    {
        $data = $request->all();
        $address_delivery = '';
        if ($data['matp']) {
            $feeship = Feeship::where('fee_matp', $data['matp'])->where('fee_maqh', $data['maqh'])->where('fee_xaid', $data['xaid'])->first();
            $city = City::where('matp', $data['matp'])->first();
            $province = Province::where('maqh', $data['maqh'])->first();
            $wards = Wards::where('xaid', $data['xaid'])->first();
            $address_delivery .= $city->name_city . ', ' . $province->name_qh . ', ' . $wards->name_xa;
            if ($feeship != null) {
                Session::put('fee', $feeship->fee_feeship);
                Session::put('address_delivery',  $address_delivery);
                Session::save();
            } else {
                $df_fee = 81500;
                Session::put('fee', $df_fee);
                Session::put('address_delivery',  $address_delivery);
                Session::save();
            }
        }
    }

    public function del_fee(Request $request)
    {
        Session::forget('fee');
        Session::forget('address_delivery');
        return Redirect::back();
    }

    /**
     * Confirm order and save to database
     * @param Request $request
     */
    public function confirm_order(Request $request)
    {
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $data = $request->all();
        $validator = Validator::make($data, [
            'shipping_name' => 'required|string|max:255',
            'shipping_email' => 'required|email',
            'shipping_phone' => 'required|digits:10',
            'shipping_address' => 'required',
            'payment_select' => 'required',
        ]);

        if ($validator->fails()) {
            Session::put('masseage', 'Vui lòng nhập đầy đủ thông tin');
            return Redirect::back()->withErrors($validator)->withInput();
        }

        $shipping = new Shipping;
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_email = $data['shipping_email'];
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_address = $data['shipping_address'];
        $shipping->shipping_note = $data['shipping_note'];
        $shipping->payment_method = $data['payment_select'];
        $shipping->addressdelivery = $data['addressdelivery'];
        $shipping->save();

        $checkout_code = substr(md5(microtime()), rand(0, 26), 10);
        $shipping_id = $shipping->shipping_id;
        $order = new Order;
        $order->customer_id = Session::get('customer_id');
        $order->shipping_id =  $shipping_id;
        $order->order_status = $shipping->payment_method;
        $order->order_code =    $checkout_code;
        $order->created_at =  now();
        $order->save();
        if (Session::get('cart')) {
            foreach (Session::get('cart') as $key => $cart) {
                $detail = new OrderDetails;
                $detail->order_code =  $checkout_code;
                $detail->product_id = $cart['product_id'];
                $detail->product_name = $cart['product_name'];
                $detail->product_price =  $cart['product_price'];
                $detail->product_sales_quantity = $cart['product_qty'];
                $detail->order_feeship = $data['order_fee'];
                $detail->order_id = $order->order_id;
                $detail->save();
                ProductController::reduceProduct($cart['product_id'], $cart['product_qty']);
            }
        }

        Session::forget('cart');
        Session::forget('fee');
    }
}