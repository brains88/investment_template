<?php

namespace App\Http\Controllers\admin;;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\{User,investment,plan,wallet,Deposit,transfer,Balance,withdrawal};
use App\Mail\WithdrawalSubmittedMail;
use Str;
use Auth;

class WithdrawalController extends Controller
{
    //


    public function getUserBalance(Request $request)
{
    $user = $request->user();
    $balance = Balance::where('user_id', $user->id)->value('balance');
    return response()->json(['balance' => $balance], 200);
}

//Get The authenticated user withdrawals
public function getWithdrawals(Request $request)
{
    $user = $request->user();
    $withdrawals = Withdrawal::paginate(6); // Example pagination
    return view('admin.payout-history', compact('withdrawals'));
}



}
