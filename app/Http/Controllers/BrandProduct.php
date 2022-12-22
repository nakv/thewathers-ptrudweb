<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Brand;

session_start();

class BrandProduct extends Controller
{
    public function AuthLogin()
    {
        $admin_id = Session()->get('admin_id');
        if ($admin_id) {
            return Redirect::to('dashboard');
        } else {
            return Redirect::to('admin')->send();
        }
    }
    public function index()
    {
        $this->AuthLogin();
        $all_brand_product = Brand::orderBy('brand_id')->paginate(8);
        return view('admin.all_brand_product', compact('all_brand_product'));
    }
    public function add_brand_product()
    {
        $this->AuthLogin();
        return view('admin.add_brand_product');
    }



    public function save_brand_product(Request $request)
    {
        $this->AuthLogin();
        $validator = Validator::make($request->all(), [
            'brand_product_name' => 'required',
            'brand_product_desc' => 'required',
            'brand_product_status' => 'required|numeric',
        ], [
            'brand_product_name.required' => 'Tên thương hiệu không được để trống',
            'brand_product_desc.required' => 'Mô tả thương hiệu không được để trống',
            'brand_product_status.required' => 'Trạng thái thương hiệu không được để trống',
        ]);

        if ($validator->fails()) {
            $request->session->put('massage', 'Thêm thương hiệu sản phẩm thất bại');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [];
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;
        DB::table('tbl_brand')->insert($data);
        $request->session()->put('message', 'Thêm thương hiệu sản phẩm thành công');
        return Redirect::to('/add-brand-product');
    }

    public function unactive_brand_product($brand_id)
    {
        $this->AuthLogin();
        DB::table('tbl_brand')
            ->where('brand_id', $brand_id)
            ->update(['brand_status' => 0]);
        session()->put('message', 'Đã hủy kích hoạt thương hiệu');
        return Redirect::to('/all-brand-product');
    }

    public function active_brand_product($brand_id)
    {
        $this->AuthLogin();
        DB::table('tbl_brand')
            ->where('brand_id', $brand_id)
            ->update(['brand_status' => 1]);
        session()->put('message', 'Đã kích hoạt thương hiệu');
        return Redirect::to('/all-brand-product');
    }

    public function edit_brand_product($brand_id)
    {
        $this->AuthLogin();
        $edit_brand_product = DB::table('tbl_brand')
            ->where('brand_id', $brand_id)
            ->get();
        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product', $edit_brand_product);
        return view('admin_layout')->with('admin.edit_brand_product', $manager_brand_product);
    }

    public function update_brand_product(Request $request, $brand_id)
    {
        $this->AuthLogin();
        $validator = Validator::make($request->all(), [
            'brand_product_name' => 'required|string',
            'brand_product_desc' => 'required',
        ], [
            'brand_product_name.required' => 'Tên thương hiệu không được để trống',
            'brand_product_desc.required' => 'Mô tả thương hiệu không được để trống',
        ]);

        if ($validator->fails()) {
            $request->session->put('massage', 'Cập nhật thương hiệu thất bại');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [];
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        DB::table('tbl_brand')
            ->where('brand_id', $brand_id)
            ->update($data);
        $request->session()->put('message', 'Cập nhật thương hiệu thành công');
        return Redirect::to('/all-brand-product');
    }

    public function delete_brand_product($brand_id)
    {
        $this->AuthLogin();
        DB::table('tbl_brand')
            ->where('brand_id', $brand_id)
            ->delete();
        session()->put('message', 'Xóa thương hiệu thành công');
        return Redirect::to('/all-brand-product');
    }

    //Home display
    public function show_brand_home($brand_id)
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        $brand_by_id = DB::table('tbl_product')
            ->join('tbl_brand', 'tbl_product.brand_id', '=', 'tbl_brand.brand_id')
            ->where('tbl_product.brand_id', $brand_id)->get();
        $brand_name = DB::table('tbl_brand')->where('tbl_brand.brand_id', $brand_id)->limit(1)->get();
        return view('pages.brand.show_brand')->with('category', $cate_product)->with('brand', $brand_product)->with('brand_by_id', $brand_by_id)->with('brand_name', $brand_name);
    }
}