<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\{User,investment,plan,wallet,Deposit};
use App\Mail\WelcomeMail;
use Str;
use Auth;
class DepositController extends Controller
{
    //

    public function index()
    {
        $wallets = Wallet::all();

        return response()->json([
            'success' => true,
            'data' => $wallets,
        ]);
    }

    public function getUserDeposits()
    {
        // Fetch deposits for the authenticated user, including wallet details
        $deposits = Deposit::with('wallet')
            ->where('user_id', Auth::id())
            ->orderBy('created_at', 'desc')
            ->get();
    
        return response()->json($deposits);
    }
    
    public function Deposit(Request $request)
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:1',
            'wallet_id' => 'required|exists:wallets,id',
        ]);

        $deposit = Deposit::create([
            'user_id' => auth()->id(),
            'transaction_number' => $this->generateTransactionNumber(),
            'amount' => $validated['amount'],
            'wallet_id' => $validated['wallet_id'],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Deposit created successfully.',
            'data' => [
                'amount' => $deposit->amount,
                'transaction_number' => $deposit->transaction_number,
                'wallet_address' => $deposit->wallet->address,
                'coin' => $deposit->wallet->coin,
                'network' => $deposit->wallet->network,
            ],
        ]);
    }

    private function generateTransactionNumber()
    {
        do {
            $transactionNumber = strtoupper(Str::random(10));
        } while (Deposit::where('transaction_number', $transactionNumber)->exists());

        return $transactionNumber;
    }
}
