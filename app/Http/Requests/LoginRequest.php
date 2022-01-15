<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => 'required|email|string|max:191',
            'password' => 'required|min:8|max:191',
        ];
    }

    public function messages()
    {
        return [
            'email.required' => '※メールアドレスを入力してください',
            'email.email' => '※メールアドレスの形式で入力してください',
            'email.string' => '※メールアドレスは文字列で入力してください',
            'email.max' => '※メールアドレスは191文字以内で入力してください',
            'password.required' => '※パスワードを入力してください',
            'password.min' => '※パスワードは8文字以上で入力してください',
            'password.max' => '※パスワードは191文字以内で入力してください',
        ];
    }
}
