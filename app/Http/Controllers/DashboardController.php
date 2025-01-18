<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Borrower dashboard - view loan limit
    public function borrowerDashboard()
    {
        $user = auth()->user();

        if ($user->role !== 'borrower') {
            return response()->json(['error' => 'Unauthorized, you are not borrower'], 403);
        }

        $loanLimit = 0.3 * $user->monthly_income;

        return response()->json([
            'name' => $user->name,
            'loan_limit' => $loanLimit,
        ]);
    }

    // Lender dashboard - view total investment
    public function lenderDashboard()
    {
        $user = auth()->user();

        if ($user->role !== 'lender') {
            return response()->json(['error' => 'Unauthorized, you are not lender'], 403);
        }

        $totalInvestment = $user->investments()->sum('amount');

        return response()->json([
            'name' => $user->name,
            'total_investment' => $totalInvestment,
        ]);
    }
}
