<?php

namespace App\Http\Controllers;

use App\Models\Investment;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class LenderController extends Controller
{
    // Fungsi untuk melihat jumlah total investasi Lender
    public function getInvestmentTotal()
    {
        // Mendapatkan ID user yang sedang login
        $user = JWTAuth::parseToken()->authenticate();

        // Mengambil total investasi yang dilakukan oleh lender
        $totalInvestment = Investment::where('user_id', $user->id)->sum('amount');

        // Mengembalikan response total investasi
        return response()->json([
            'total_investment' => $totalInvestment
        ], 200);
    }
}
