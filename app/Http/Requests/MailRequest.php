<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MailRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'user_email' => 'required',
            'subject' => 'required|max:30',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'user_email.required' => '※宛先を選択してください',
            'subject.required' => '※件名を入力してください',
            'subject.max' => '※件名は50文字以内で入力してください',
            'content' => '※本文を入力してください',
        ];
    }
}
