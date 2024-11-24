<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{investment,Deposit,Withdrawal,wallet};
class HomeController extends Controller
{
    //

    public function getLatestTransactions()
{
    $deposits = Deposit::with('wallet')->latest()->take(6)->get();
    $withdrawals = Withdrawal::latest()->take(6)->get();

    return response()->json([
        'deposits' => $deposits,
        'withdrawals' => $withdrawals,
    ]);
}

}
