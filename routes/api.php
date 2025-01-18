<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BorrowerController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\LenderController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    // Borrower Dashboard
    Route::get('borrower/dashboard', [DashboardController::class, 'borrowerDashboard']);
    Route::get('/borrower/loan-limit', [BorrowerController::class, 'getLoanLimit']);

    // Lender Dashboard
    Route::get('lender/dashboard', [DashboardController::class, 'lenderDashboard']);
    Route::get('/lender/investments/total', [LenderController::class, 'getInvestmentTotal']);

    // Investments
    Route::post('lender/investments', [InvestmentController::class, 'addInvestment']);
    Route::get('lender/investments', [InvestmentController::class, 'listInvestments']);
});
