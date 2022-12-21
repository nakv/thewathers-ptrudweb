<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Roles;
use Illuminate\Support\Facades\Redirect;

class AuthController extends Controller
{
    public function register_auth()
    {
        return view('admin.auth.register');
    }
    public function register(Request $request)
    {
        $this->validation($request);
        $data = $request->all();
        $admin = new Admin;
        $admin->admin_name = $data['admin_name'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_phone = $data['phone'];
        $admin->admin_password = md5($data['admin_password]']);
        $admin->save();
        return Redirect::to('/register-auth')->with('message', 'Đăng ký thành công!');
    }
    public function validation($request)
    {
        return $this->validation($request, [
            'admin_name' => 'required|max:50',
            'admin_email' => 'required|email|max:60',
            'admin_phone' => 'required|digits:10',
            'admin_password' => 'required|min:6|max:50'
        ]);
    }
}