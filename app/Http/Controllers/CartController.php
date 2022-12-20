<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Gloudemans\Shoppingcart\Facades\Cart;

session_start();

class CartController extends Controller
{
    public function gio_hang()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        return view('pages.cart.cart_ajax')->with('category', $cate_product)->with('brand', $brand_product);
    }

    public function add_to_cartajax(Request $request)
    {
        $data = $request->all();
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $cart = Session::get('cart');
        if ($cart == true) {
            $is_available = 0;
            foreach ($cart as $key => $value) {
                if ($value['product_id'] == $data['cart_product_id']) {
                    $is_available++;
                    $cart[$key] = array(
                        'session_id' => $value['session_id'],
                        'product_name' => $value['product_name'],
                        'product_id' => $value['product_id'],
                        'product_image' => $value['product_image'],
                        'product_qty' => $value['product_qty'] + $data['cart_product_qty'],
                        'product_price' => $value['product_price'],
                    );
                    Session::put('cart', $cart);
                }
            };
            if ($is_available == 0) {
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_id' => $data['cart_product_id'],
                    'product_name' => $data['cart_product_name'],
                    'product_price' => $data['cart_product_price'],
                    'product_image' => $data['cart_product_image'],
                    'product_qty' => $data['cart_product_qty'],
                );
                Session::put('cart', $cart);
            }
        } else {
            $cart[] = array(
                'session_id' => $session_id,
                'product_id' => $data['cart_product_id'],
                'product_name' => $data['cart_product_name'],
                'product_price' => $data['cart_product_price'],
                'product_image' => $data['cart_product_image'],
                'product_qty' => $data['cart_product_qty'],
            );
        }
        Session::put('cart', $cart);
        Session::save();
    }

    public function delete_product_cart($sessionID)
    {
        $cart = Session::get('cart');
        if ($cart) {
            foreach ($cart as $key => $val) {
                if ($val['session_id'] == $sessionID) {
                    unset($cart[$key]);
                }
            }
            Session::put('cart', $cart);
            return Redirect()->back()->with('message', 'Xóa sản phẩm thành công!');
        }
        return Redirect()->back()->with('message', 'Xóa sản phẩm thất bại!');
    }

    public function update_cart(Request $request)
    {
        $data = $request->all();
        $cart = Session::get('cart');
        if ($cart == true) {
            foreach ($data['cart_qty'] as $key => $qty) {
                foreach ($cart as $session_ => $val) {
                    if ($val['session_id'] == $key) {
                        $cart[$session_]['product_qty'] = $qty;
                    }
                }
            }
            Session::put('cart', $cart);
            return Redirect()->back()->with('message', 'Cập nhật số lượng sản phẩm thành công!');
        }
        return Redirect()->back()->with('message', 'Cập nhật số lượng thất bại!');
    }

    public function save_cart(Request $request)
    {
        $productId = $request->productid_hidden;
        $quantity = $request->quanty;
        $product_info = DB::table('tbl_product')->where('product_id', $productId)->first();
        $product['id'] = $product_info->product_id;
        $product['qty'] = $quantity;
        $product['name'] = $product_info->product_name;
        $product['price'] = $product_info->product_price;
        $product['image'] = $product_info->product_image;
        //ADD cart
        $session_id = substr(md5(microtime()), rand(0, 26), 5);
        $cart = Session::get('cart');
        if ($cart == true) {
            $is_available = 0;
            foreach ($cart as $key => $value) {
                if ($value['product_id'] == $product_info->product_id) {
                    $is_available++;
                    $cart[$key] = array(
                        'session_id' => $value['session_id'],
                        'product_name' => $value['product_name'],
                        'product_id' => $value['product_id'],
                        'product_image' => $value['product_image'],
                        'product_qty' => $value['product_qty'] +    $quantity,
                        'product_price' => $value['product_price'],
                    );
                    Session::put('cart', $cart);
                }
            };
            if ($is_available == 0) {
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_id' => $product_info->product_id,
                    'product_name' => $product_info->product_name,
                    'product_price' =>  $product_info->product_price,
                    'product_image' => $product_info->product_image,
                    'product_qty' =>    $quantity,
                );
                Session::put('cart', $cart);
            }
        } else {
            $cart[] = array(
                'session_id' => $session_id,
                'product_id' => $product_info->product_id,
                'product_name' => $product_info->product_name,
                'product_price' =>  $product_info->product_price,
                'product_image' => $product_info->product_image,
                'product_qty' =>    $quantity,
            );
        }
        Session::put('cart', $cart);
        Session::save();

        return Redirect::to('/gio-hang');
    }

    public function show_cart()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        return view('pages.cart.show_cart')->with('category', $cate_product)->with('brand', $brand_product);
    }

    public function delete_to_cart($rowId)
    {
        Cart::remove($rowId);
        return Redirect::to('/show-cart');
    }

    public function update_cart_quantity(Request $request, $rowId)
    {
        $qty = $request->cart_quantity;
        Cart::update($rowId, $qty);
        return Redirect::to('/show-cart');
    }
}