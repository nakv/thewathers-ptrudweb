<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the prdduct.
     *
     * @return view
     */
    public function index()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        // $all_product = DB::table('tbl_product')
        //     ->join('tbl_category_product', 'tbl_category_product.category_id', '=', 'tbl_product.category_id')
        //     ->join('tbl_brand', 'tbl_brand.brand_id', '=', 'tbl_product.brand_id')
        //     ->orderby('tbl_product.product_id', 'desc')->get();
        // $manager_product = view('admin.all_product')->with('all_product', $all_product);
        $all_product = DB::table('tbl_product')->where('product_status', '1')->orderby('product_id', 'desc')->limit(8)->get();
        return view('pages.home')->with('category', $cate_product)->with('brand', $brand_product)->with('all_product', $all_product);
    }

    /**
     * Search product by keyword
     * @param  Request $request
     * @return view
     */
    public function search(Request $request)
    {
        $keyword = $request->keyword_submit;
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderby('category_id', 'desc')->get();
        $search_product = DB::table('tbl_product')->where('product_name', 'like', '%' . $keyword . '%')->get();
        $brand_product = DB::table('tbl_brand')->where('brand_status', '1')->orderby('brand_id', 'desc')->get();
        return view('pages.product.search')->with('category', $cate_product)->with('brand', $brand_product)->with('search_product', $search_product);
    }
}