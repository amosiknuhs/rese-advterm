<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:128',
            'email' => 'required|email|unique:App\Models\User|max:128',
            'password' => 'required|min:8|max:128|alpha_num',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '※氏名を入力してください',
            'name.string' => '※氏名は文字列で入力してください',
            'name.max' => '※氏名は128文字以内で入力してください',
            'email.required' => '※メールアドレスを入力してください',
            'email.email' => '※メールアドレスの形式で入力してください',
            'email.unique' => '※このメールアドレスは既に登録済みです',
            'email.max' => '※メールアドレスは128文字以内で入力してください',
            'password.required' => '※パスワードを入力してください',
            'password.min' => '※パスワードは8文字以上で入力してください',
            'password.max' => '※パスワードは128文字以内で入力してください',
            'password.alpha_num' => '※パスワードは半角英数字で入力してください',
        ];
    }
}
