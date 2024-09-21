<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

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
            'password' => 'required'
        ]);
        return $user;
    }
    public function register() {}
}