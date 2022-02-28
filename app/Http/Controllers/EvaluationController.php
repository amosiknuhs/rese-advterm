<?php

namespace App\Http\Controllers;

use App\Models\Evaluation;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\EvaluationRequest;

class EvaluationController extends Controller
{
    public function evaluate(EvaluationRequest $request)
    {
        $evaluation = $request->all();
        $evaluation['user_id'] = Auth::id();
        Evaluation::create($evaluation);
    }
}
