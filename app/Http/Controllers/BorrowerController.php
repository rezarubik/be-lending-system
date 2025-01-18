<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;

class BorrowerController extends Controller
{
    // Fungsi untuk melihat limit pinjaman Borrower
    public function getLoanLimit()
    {
        // Mendapatkan ID user yang sedang login
        $user = JWTAuth::parseToken()->authenticate();

        // Menghitung limit pinjaman berdasarkan 30% dari penghasilan bulanan
        $loanLimit = $user->monthly_income * 0.3;

        // Mengembalikan response limit pinjaman
        return response()->json([
            'loan_limit' => $loanLimit
        ], 200);
    }
}
