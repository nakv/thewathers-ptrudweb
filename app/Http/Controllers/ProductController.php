<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
// session_start();

class ProductController extends Controller
{
    public static function reduceProduct($id, $quantity)
    {
        $product = Product::find($id);
        DB::table('tbl_product')->where('product_id', $id)->update([
            'product_quantity' => $product->product_quantity - $quantity
        ]);
    }
    //Start Admin Page

    /**
     * Check login
     */
    public function AuthLogin()
    {
        $admin_id = Session()->get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }

    /**
     * Dispaly view add product
     */

    public function add_product()
    {
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();
        return view('admin.add_product')->with('cate_product', $cate_product)->with('brand_product', $brand_product);
    }

    /**
     *  Display a listing of product
     */
    public function index()
    {
        $this->AuthLogin();
        $all_product = Product::orderby('product_id', 'desc')->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')->paginate(5);
        return view('admin.all_product', compact('all_product'));
    }

    /**
     * Store a newly created product in storage.
     * @param  \Illuminate\Http\Request  $request
     * @return Redirect
     */
    public function save_product(Request $request)
    {
        $this->AuthLogin();

        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string',
            'product_price' => 'required',
            'product_desc' => 'required|string',
            'product_content' => 'required|string',

        ]);

        if ($validator->fails()) {
            $request->session()->put('message', 'Lỗi! Vui lòng kiểm tra lại thông tin sản phẩm');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [];
        $data['product_name'] = $request->product_name;
        $data['product_price'] = str_replace('.', '', $request->product_price);
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $data['product_quantity'] = 100;
        $get_img = $request->file('product_image');
        if ($get_img) {
            $get_img_name = $get_img->getClientOriginalName();
            $name_img = current(explode('.', $get_img_name));
            $new_img = $name_img . time() . '.' . $get_img->getClientOriginalExtension();
            $get_img->move('public/uploads/product', $new_img);
            $data['product_image'] = $new_img;
            DB::table('tbl_product')->insert($data);
            $request->session()->put('message', 'Thêm sản phẩm thành công');
            return redirect()->back();
        }

        $data['product_image'] = '';
        DB::table('tbl_product')->insert($data);
        $request->session()->put('message', 'Thêm sản phẩm thành công');
        return redirect()->back();
    }

    /**
     * Unactive a product
     */
    public function unactive_product($product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_product')
            ->where('product_id', $product_id)
            ->update(['product_status' => 0]);
        session()->put('message', 'Đã hủy kích hoạt sản phẩm');
        return Redirect::to('/all-product');
    }

    /**
     * Active a product
     */
    public function active_product($product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_product')
            ->where('product_id', $product_id)
            ->update(['product_status' => 1]);
        session()->put('message', 'Đã kích hoạt sản phẩm');
        return Redirect::to('/all-product');
    }

    public function edit_product($product_id)
    {
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->orderby('brand_id', 'desc')->get();
        $edit_product = DB::table('tbl_product')->where('product_id', $product_id)->get();
        $manager_product = view('admin.edit_product')->with('edit_product', $edit_product)->with('cate_product', $cate_product)->with('brand_product', $brand_product);

        return view('admin_layout')->with('admin.edit_product', $manager_product);
    }

    /**
     *  Update the specified product in storage.
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $product_id
     * @return Redirect
     */

    public function update_product(Request $request, $product_id)
    {
        $this->AuthLogin();

        $validator = Validator::make($request->all(), [
            'product_name' => 'required|string',
            'product_quantity' => 'required|integer',
            'product_price' => 'required|numeric',
            'product_desc' => 'required|string',
            'product_content' => 'required|string',
            'product_status' => 'required|integer',
        ]);

        if ($validator->fails()) {
            $request->session()->put('message', 'Lỗi! Vui lòng kiểm tra lại thông tin sản phẩm');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [];
        $data['product_name'] = $request->product_name;
        $data['product_price'] = $request->product_price;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        $data['product_quantity'] = $request->product_quantity;
        $get_img = $request->file('product_image');
        if ($get_img) {
            $get_img_name = $get_img->getClientOriginalName();
            $name_img = current(explode('.', $get_img_name));
            $new_img = $name_img . time() . '.' . $get_img->getClientOriginalExtension();
            $get_img->move('public/uploads/product', $new_img);
            $data['product_image'] = $new_img;
            DB::table('tbl_product')->where('product_id', $product_id)->update($data);
            $request->session()->put('message', 'Cập nhật sản phẩm thành công! ');
            return Redirect::to('all-product');
        }
        DB::table('tbl_product')->where('product_id', $product_id)->update($data);
        $request->session()->put('message', 'Cập nhật sản phẩm thành công!');
        return Redirect::to('all-product');
    }

    /**
     * Remove the specified product from storage.
     * @param  int  $product_id
     * @return Redirect
     */
    public function delete_product($product_id)
    {
        $this->AuthLogin();
        DB::table('tbl_product')
            ->where('product_id', $product_id)
            ->delete();
        session()->put('message', 'Xóa sản phẩm thành công!');
        return Redirect::to('/all-product');
    }

    // End function Admin Page

    /**
     * Show the application dashboard.
     * @return view
     */

    // Home handler
    public function details_product($product_id)
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        $details_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->where('tbl_product.product_id', $product_id)->get();
        foreach ($details_product as $key => $value) {
            $category_id = $value->category_id;
        }
        $related_product = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
            ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
            ->where('tbl_category_product.category_id', $category_id)->whereNotIn('tbl_product.product_id', [$product_id])->get();
        return view('pages.product.show_details')->with('category', $cate_product)->with('brand', $brand_product)->with('product_details', $details_product)->with('related_product', $related_product);
    }
}