<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
            //^[a-z]\w+$/i => 字母开头，'unique:users,name' user表里的name字段是唯一的
            'name' => ['required', 'between:3,20', 'regex:/^[a-z]\w+$/i', 'unique:users,name'],
            'password' => ['required', 'between:5,20', 'confirmed']
        ];
    }
}