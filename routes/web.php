<?php

use Illuminate\Support\Facades\Route;
Route::get('/api/transactions/latest', [App\Http\Controllers\frontend\HomeController::class, 'getLatestTransactions']);

Route::get('/api/verify', [App\Http\Controllers\auth\authCheckController::class, 'verify']);
Route::get('/api/checkUser', [App\Http\Controllers\auth\authCheckController::class, 'checkUser']);
Route::get('/api/checkAdmin', [App\Http\Controllers\auth\authCheckController::class, 'checkAdmin']);
Route::post('/api/register', [App\Http\Controllers\auth\registerController::class, 'register']);
Route::get('api/register/{username}', [App\Http\Controllers\auth\registerController::class, 'handleReferral'])->name('referral');
Route::post('/api/login', [App\Http\Controllers\auth\loginController::class, 'login']);
Route::post('/api/user-verification', [App\Http\Controllers\auth\loginController::class, 'activateAccount']);
Route::post('/api/logout', [App\Http\Controllers\auth\loginController::class, 'logout']);

//User Routes
Route::get('/api/user/dashboard', [App\Http\Controllers\user\DashboardController::class, 'getUserMetrics']);
Route::put('/api/user/change-password', [App\Http\Controllers\user\DashboardController::class, 'updatePassword']);
Route::get('/api/plans', [App\Http\Controllers\user\investmentController::class, 'index']);
Route::post('/api/invest', [App\Http\Controllers\user\investmentController::class, 'makeInvestment']);
Route::get('/api/wallets', [App\Http\Controllers\user\DepositController::class, 'index']);
Route::get('/api/deposits', [App\Http\Controllers\user\DepositController::class, 'getUserDeposits']);
Route::post('/api/deposits', [App\Http\Controllers\user\DepositController::class, 'Deposit']);
Route::get('/api/transactions', [App\Http\Controllers\user\TransferController::class, 'index']);
Route::post('/api/transfer', [App\Http\Controllers\user\TransferController::class, 'store']);
Route::get('/api/user/balance', [App\Http\Controllers\user\WithdrawalController::class, 'getUserBalance']);
Route::get('/api/user/withdrawals', [App\Http\Controllers\user\WithdrawalController::class, 'getWithdrawals']);
Route::post('/api/user/withdraw', [App\Http\Controllers\user\WithdrawalController::class, 'submitWithdrawal']);

Route::get('/{pathMatch}', function() {
    return view('welcome');
})->where('pathMatch',".*");