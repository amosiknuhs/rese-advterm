<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReserveRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'date' => 'required',
            'time' => 'required',
            'number' => 'required',
        ];
    }
    public function messages()
    {
        return [
            'date.required' => '※来店日を選択してください',
            'time.required' => '※時間を選択してください',
            'number.required' => '※人数を選択してください',
        ];
    }
}
