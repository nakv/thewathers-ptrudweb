<?php

namespace App\Http\Controllers;

use Symfony\Component\HttpFoundation\Session\Session;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Product;

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
        $all_product = Product::where('product_status', '1')->orderBy('product_id', 'desc')->paginate(1);
        return view('pages.home', compact('all_product'))->with('category', $cate_product)->with('brand', $brand_product);
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