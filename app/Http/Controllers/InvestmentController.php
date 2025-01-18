<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Investment;

class InvestmentController extends Controller
{
    // Add a new investment
    public function addInvestment(Request $request)
    {
        $user = auth()->user();

        if ($user->role !== 'lender') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $request->validate([
            'amount' => 'required|numeric|min:1',
            'bank' => 'required|in:BCA,BRI,BNI,Mandiri',
        ]);

        $bankCodes = [
            'BCA' => '1123',
            'BRI' => '1124',
            'BNI' => '1125',
            'Mandiri' => '1126',
        ];

        $virtualAccount = $bankCodes[$request->bank] . $user->phone_number;

        // return [
        //     'user_id' => $user->id,
        //     'amount' => $request->amount,
        //     'bank' => $request->bank,
        //     'virtual_account' => $virtualAccount,
        // ];


        $investment = Investment::create([
            'user_id' => $user->id,
            'amount' => $request->amount,
            'bank' => $request->bank,
            'virtual_account' => $virtualAccount,
        ]);

        return response()->json([
            'message' => 'Investment added successfully',
            'investment' => $investment,
        ]);
    }

    // List all investments
    public function listInvestments()
    {
        $user = auth()->user();

        if ($user->role !== 'lender') {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

        $investments = Investment::where('user_id', $user->id)->get();

        return response()->json(['investments' => $investments]);
    }
}
