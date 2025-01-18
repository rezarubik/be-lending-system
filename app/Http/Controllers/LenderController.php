<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class LenderController extends Controller
{
    public function getInvestmentTotal()
    {
        $user = JWTAuth::parseToken()->authenticate();

        $totalInvestment = Investment::where('user_id', $user->id)->sum('amount');

        return response()->json([
            'total_investment' => $totalInvestment
        ], 200);
    }
}
