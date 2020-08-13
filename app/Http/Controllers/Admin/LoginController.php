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
    /**
     * 登陆方法
     */
    public function doLogin(Request $request)
    {
        $data = $request->except('_token');
        if ($data['code'] != session()->get('captcha')) {
            return redirect('admin/login')->with('errors', '验证码错误!');
        }
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
        if ($data['password'] != Crypt::decrypt($user->user_pass)) {
            return redirect('admin/login')->with('errors', '密码不正确！');
        }
        session()->put('user', $user);
        return redirect('admin/index');
    }
    /**
     * 退出登陆
     */
    public function logout()
    {
        session()->flush();
        return redirect('admin/login');
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
        $crypt = Crypt::encrypt($str); //加密
        $crypt_str = "eyJpdiI6IjYzVCtVaUFRdmt6OWNscWFBcFpuamc9PSIsInZhbHVlIjoiMXRqb21jdXVNcjR3WGFxSThCYnZRQT09IiwibWFjIjoiZmNhY2JiMjA3N2QxYmI1ZmM2NWRmMWIxNDdkMjdiNWQxZjkzZjg0MGMzMzY1NmI0ZGE2NTllNzE4M2U3YjJiNCJ9=";
        return  Crypt::decrypt($crypt_str); //解密
        // return $crypt;
    }
}
