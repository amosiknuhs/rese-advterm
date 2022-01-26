<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EvaluationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'comment' => 'max:140',
        ];
    }
    public function messages()
    {
        return [
            'comment.max' => '※口コミは140文字以内で入力してください'
        ];
    }
}
