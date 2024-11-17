<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
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


public function getWithdrawals(Request $request)
{
    $user = $request->user();
    $withdrawals = Withdrawal::where('user_id', $user->id)->latest()->get();
    return response()->json($withdrawals, 200);
}


public function submitWithdrawal(Request $request)
{
    // Validate common fields
    $validated = $request->validate([
        'amount' => 'required|numeric|min:1',
        'method' => 'required|in:crypto,bank,zelle,paypal',
    ]);

    // Dynamically validate based on withdrawal method
    if ($validated['method'] === 'crypto') {
        $request->validate([
            'cryptoWalletAddress' => 'required|string|max:255',
            'cryptoNetwork' => 'required|string|max:255',
            'coinType' => 'required|string|max:255',
        ]);
    } elseif ($validated['method'] === 'bank') {
        $request->validate([
            'bankName' => 'required|string|max:255',
            'bankAccountNumber' => 'required|string|max:20',
            'routingNumber' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ]);
    } elseif ($validated['method'] === 'zelle') {
        $request->validate([
            'zelleEmail' => 'required|email|max:255',
        ]);
    } elseif ($validated['method'] === 'paypal') {
        $request->validate([
            'paypalEmail' => 'required|email|max:255',
        ]);
    }

    $user = $request->user();
    $balance = Balance::where('user_id', $user->id)->value('balance');

    // Check if the user has sufficient balance
    if ($validated['amount'] > $balance) {
        return response()->json(['error' => 'Insufficient balance, Please fund Your Account'], 400);
    }

    // Generate a unique 10-digit transaction ID
    $transactionId = $this->generateTransactionId();

    // Create a withdrawal request
    Withdrawal::create([
        'user_id' => $user->id,
        'transaction_number' => $transactionId,
        'amount' => $validated['amount'],
        'method' => $validated['method'],
        'bank_name' => $request->input('bankName'),
        'bank_account_number' => $request->input('bankAccountNumber'),
        'routing_number' => $request->input('routingNumber'),
        'address' => $request->input('address'),
        'zelle_email' => $request->input('zelleEmail'),
        'paypal_email' => $request->input('paypalEmail'),
        'wallet_address' => $request->input('cryptoWalletAddress'),
        'network' => $request->input('cryptoNetwork'),
        'coin_type' => $request->input('coinType'),
    ]);

    // Deduct the amount from the user's balance
    Balance::where('user_id', $user->id)->decrement('balance', $validated['amount']);

      // Send email notification
      Mail::to($user->email)->send(new WithdrawalSubmittedMail($transactionId, $validated['amount']));
    return response()->json([
        'message' => 'Withdrawal submitted successfully',
        'transaction_number' => $transactionId,
    ], 200);
}


/**
 * Generate a unique 10-digit transaction ID.
 *
 * @return string
 */
private function generateTransactionId()
{
    do {
        $transactionId = mt_rand(1000000000, 9999999999); // Generate a random 10-digit number
    } while (Withdrawal::where('transaction_number', $transactionId)->exists());

    return $transactionId;
}


}
