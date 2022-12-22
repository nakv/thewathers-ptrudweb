<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Session\Session;

use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Category;

session_start();

class CategoryProduct extends Controller
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

    public function add_category_product()
    {
        $this->AuthLogin();
        return view('admin.add_category_product');
    }

    public function index()
    {
        $this->AuthLogin();
        $all_category_product = Category::orderby('category_id')->paginate(8);
        return view('admin.all_category_product', compact('all_category_product'));
    }

    public function save_category_product(Request $request)
    {
        $this->AuthLogin();
        $validator = Validator::make($request->all(), [
            'category_product_name' => 'required',
            'category_product_desc' => 'required',
            'category_product_status' => 'required',
        ], [
            'category_product_name.required' => 'Tên danh mục không được để trống',
            'category_product_desc.required' => 'Mô tả danh mục không được để trống',
            'category_product_status.required' => 'Trạng thái danh mục không được để trống',
        ]);
        if ($validator->fails()) {
            $request->session->put('message', 'Thêm danh mục sản phẩm thất bại');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [];
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;
        DB::table('tbl_category_product')->insert($data);
        $request->session()->put('message', 'Thêm danh mục sản phẩm thành công');
        return Redirect::to('/add-category-product');
    }

    public function unactive_category_product($category_id)
    {
        $this->AuthLogin();
        DB::table('tbl_category_product')
            ->where('category_id', $category_id)
            ->update(['category_status' => 0]);
        session()->put('message', 'Đã ẩn danh mục');
        return Redirect::to('/all-category-product');
    }

    public function active_category_product($category_id)
    {
        $this->AuthLogin();
        DB::table('tbl_category_product')
            ->where('category_id', $category_id)
            ->update(['category_status' => 1]);
        session()->put('message', 'Đã hiện danh mục');
        return Redirect::to('/all-category-product');
    }

    public function edit_category_product($category_id)
    {
        $this->AuthLogin();
        $edit_category_product = DB::table('tbl_category_product')
            ->where('category_id', $category_id)
            ->get();
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product', $edit_category_product);
        return view('admin_layout')->with('admin.edit_category_product', $manager_category_product);
    }

    public function update_category_product(Request $request, $category_id)
    {
        $this->AuthLogin();
        $validator = Validator::make($request->all(), [
            'category_product_name' => 'required',
            'category_product_desc' => 'required',
        ], [
            'category_product_name.required' => 'Tên danh mục không được để trống',
            'category_product_desc.required' => 'Mô tả danh mục không được để trống',
        ]);

        if ($validator->fails()) {
            $request->session->put('message', 'Cập nhật danh mục sản phẩm thất bại');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = [];
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        DB::table('tbl_category_product')
            ->where('category_id', $category_id)
            ->update($data);
        $request->session()->put('message', 'Cập nhật danh mục sản phẩm thành công');
        return Redirect::to('/all-category-product');
    }

    public function delete_category_product($category_id)
    {
        $this->AuthLogin();
        DB::table('tbl_category_product')
            ->where('category_id', $category_id)
            ->delete();
        session()->put('message', 'Xóa danh mục sản phẩm thành công');
        return Redirect::to('/all-category-product');
    }

    // Home display category product
    public function show_category_home($category_id)
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        $category_by_id = DB::table('tbl_product')
            ->join('tbl_category_product', 'tbl_product.category_id', '=', 'tbl_category_product.category_id')
            ->where('tbl_product.category_id', $category_id)->where('tbl_product.product_status', '1')->get();
        $category_name = DB::table('tbl_category_product')->where('tbl_category_product.category_id', $category_id)->get();
        return view('pages.category.show_category')->with('category', $cate_product)->with('brand', $brand_product)->with('category_by_id', $category_by_id)->with('category_name', $category_name);
    }
}