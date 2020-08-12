<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * 获取一个添加页面
     * @param null
     * @return 返回一个添加页面
     */
    public function add()
    {
        return view('user/add');
    }
    public function store(Request $request)
    {
        $input = $request->except('_token');
        // 2、表单验证
        $input['password'] = md5($input['password']);
        $res = User::create($input);
        if ($res->id) {
            return redirect('user/index');
        } else {
            return back();
        }
    }
    public function index()
    {
        $user = User::get();
        return view('user.list', compact('user'));
    }
    /**
     * 修改
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('user.edit', compact('user'));
    }
    /***
     * 修改方法
     */
    public function update(Request $request)
    {
        $input = $request->except(['_token']);
        $user = User::find($input['id']);
        $data = array(
            'password' => md5($input['password']),
            'username' => $input['username']
        );
        $res = $user->update($data);
        if ($res) {
            return redirect('user/index');
        } else {
            return back();
        }
    }
    public function del($id)
    {
        $user = User::find($id);
        if ($user->delete()) {
            return [
                'status' => 0,
                'message' => '删除成功'
            ];
        } else {
            return json_encode([
                'status' => 1,
                'message' => '删除失败'
            ]);
        }
    }
}
