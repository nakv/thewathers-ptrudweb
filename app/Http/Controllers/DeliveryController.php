<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Province;
use App\Models\Wards;
use App\Models\Feeship;
use Illuminate\Http\Request;

// session_start();
class DeliveryController extends Controller
{
    public function delivery(Request $request)
    {
        $city = City::orderby('name_city', 'ASC')->get();

        return view('admin.delivery.add_delivery')->with(compact('city'));
    }
    public function select_delivery(Request $request)
    {
        $data = $request->all();
        if ($data['action'] == true) {
            $output = '';
            if ($data['action'] == "city") {
                $select_province = Province::where('matp', $data['ma_id'])->orderby('maqh', 'ASC')->get();
                $output .= '<option value="">--- Chọn quận huyện ---</option>';
                foreach ($select_province as $key => $province) {
                    $output .= '<option value="' . $province->maqh . '">' . $province->name_qh . '</option>';
                }
            } else {
                $select_wards = Wards::where('maqh', $data['ma_id'])->orderby('xaid', 'ASC')->get();
                $output .= '<option value="">--- Chọn xã phường ---</option>';
                foreach ($select_wards as $key => $ward) {
                    $output .= '<option value="' . $ward->xaid . '">' . $ward->name_xa . '</option>';
                }
            }
        }
        echo $output;
    }
    public function insert_delivery(Request $request)
    {
        $data = $request->all();
        $fee_ship = new Feeship;
        $fee_ship->fee_matp = $data['city'];
        $fee_ship->fee_maqh = $data['province'];
        $fee_ship->fee_xaid = $data['wards'];
        $fee_ship->fee_feeship = $data['fee_ship'];
        $fee_ship->save();
        // session()->put('message', 'Xóa danh mục sản phẩm thành công');
    }
    public function select_feeship()
    {
        $feeship = Feeship::orderby('fee_id', 'DESC')->get();
        $output = '';
        $output .= '<div class="table-responsive">
        <table class="table table-bordered" >
        <thead>
        <tr>
        <th>Tên thành phố</th>
        <th>Tên quận huyện</th>
        <th>Tên xã phường</th>
        <th>Phí ship</th>
        </tr>
        </thead>
        <tbody>';
        foreach ($feeship as $key => $fee) {
            $output .=
                '   <tr>
        <td>' . $fee->city->name_city . '</td>
        <td>' . $fee->province->name_qh . '</td>
        <td>' . $fee->wards->name_xa . '</td>
        <td class="fee_ship_edit" contenteditable data data-feeship_id="' . $fee->fee_id . '">' . number_format($fee->fee_feeship, 0, ',', '.') . '</td>
        </tr>';
        }
        $output .= '
        </tbody>
        </table>
        </div>';
        echo $output;
    }
    public function update_feeship(Request $request)
    {
        $data = $request->all();
        $fee_ship =  Feeship::find($data['feeship_id']);
        $fee_value = rtrim($data['fee_value'], '.');
        $fee_ship->fee_feeship = $fee_value;
        $fee_ship->save();
    }
}