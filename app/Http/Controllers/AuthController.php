<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    private function getUser(string $name)
    {
        // 获取当前用户
        $user = User::orWhere('name', $name);
        foreach (['email', 'mobile'] as $field) {
            $user->orWhere($field, $name);
        }
        return $user->first();
    }
    public function login(Request $request)
    {
        $user = $this->getUser($request->input('name'));
        $request->validate([
            'name' => ['required', function ($attr, $value, $fail) use ($user) {
                if (!$user) {
                    $fail('用户不存在，请检查账号');
                }
            }],
            'password' => ['required', function ($attr, $value, $fail) use ($user, $request) {
                if (!$user || !Hash::check($request->input('password'), $user->password)) {
                    $fail('密码错误，请确认密码');
                }
            }]
        ]);
        Auth::login($user, true); // 用户登录
        return ['code' => 0, 'msg' => '恭喜你，登录成功'];
    }

    public function logout()
    {
        Auth::logout(); // 退出登录
        return ['code' => 0, 'msg' => '退出登录成功'];
    }
    public function register(RegisterRequest $request, User $user)
    {
        // 用户注册
        $user->name = $request->input('name');
        $user->password = Hash::make($request->input('password'));
        $user->save();
        return ['code' => 0, 'msg' => '恭喜你，注册成功', 'data' => $user];
    }
}