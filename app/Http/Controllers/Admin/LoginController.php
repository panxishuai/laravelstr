<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use App\Libs\org\Vcode;
use App\Model\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    //
    public function login()
    {
        return view('admin.login');
    }
    /**
     * 验证码
     */
    public function code()
    {
        $vcode = new Vcode();
        return $vcode->aaa();
    }
    public function doLogin(Request $request)
    {
        $data = $request->except('_token');
        $rule = [
            'username' => 'required|alpha|max:10',
            'password' => 'required'
        ];
        $msg = [
            'username.required' => '用户名称必须输入',
            'username.alpha' => '用户名只能包含字母',
            'username.max' => '用户名长度不能大于10个字符',
            'password.required' => '密码必须填写'
        ];
        $validate = Validator::make($data, $rule, $msg); //手动验证
        if ($validate->fails()) {
            return redirect('admin/login')
                ->withErrors($validate)
                ->withInput();
        }
        $user =  User::where('user_name', $data['username'])->first();
        if (!$user) {
            return redirect('admin/login')->with('errors', '用户不存在');
        }
        if ($data['username'] != Crypt::decrypt($user->user_name)) {
            return redirect('admin/login')->with('errors', '密码不正确！');
        }
    }
    public function jiami()
    {
        // 1、md5加密
        // $a = '123456';
        // return md5($a);
        // 2、哈希加密
        // $str = '123456';
        // $hash =  Hash::make($str);
        // if (Hash::check($str, "$2y$10$8Jy5jnbabaYZ/CKpL2ljiOC.zYOO7xr06rhgzQvu0w1.erXyUGfYi1")) {
        //     return "密码正确";
        // } else {
        //     return "密码错误";
        // }
        // 3、crypt加密
        $str = '123456';
        $crypt = Crypt::encrypt($str);
        // $crypt_str = "eyJpdiI6IjNcL3BrZm5wQWNoNWhETGh6RE1vSXNRPT0iLCJ2YWx1ZSI6IjIycE1zRmFLK3NjUkR4d2pcL29ZMkh3PT0iLCJtYWMiOiIwZTBkM2M3ZGRjZjA5MjQ4OTE0OTE3ODQxYTI0MDU1ZjRhODUwODRmODYzZGUwNWQ1ZTM5NmZiMTE1MzIxYTAzIn0=";
        // return  Crypt::decrypt($crypt);
        return $crypt;
    }
}
