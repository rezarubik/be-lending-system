<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class BorrowerController extends Controller
{
    public function getLoanLimit()
    {
        $user = JWTAuth::parseToken()->authenticate();

        $loanLimit = $user->monthly_income * 0.3;

        return response()->json([
            'loan_limit' => $loanLimit
        ], 200);
    }
}
