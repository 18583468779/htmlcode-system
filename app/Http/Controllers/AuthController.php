<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
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
        return $user;
    }
    public function register() {}
}