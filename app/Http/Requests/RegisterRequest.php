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
            'name' => 'required|string|max:191',
            'email' => 'required|email|unique:App\Models\User|string|max:191',
            'password' => 'required|min:8|max:191',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => '※氏名を入力してください',
            'name.string' => '※氏名は文字列で入力してください',
            'name.max' => '※氏名は191文字以内で入力してください',
            'email.required' => '※メールアドレスを入力してください',
            'email.email' => '※メールアドレスの形式で入力してください',
            'email.unique' => '※このメールアドレスは既に登録済みです',
            'email.string' => '※メールアドレスは文字列で入力してください',
            'email.max' => '※メールアドレスは191文字以内で入力してください',
            'password.required' => '※パスワードを入力してください',
            'password.min' => '※パスワードは8文字以上で入力してください',
            'password.max' => '※パスワードは191文字以内で入力してください',
        ];
    }
}
