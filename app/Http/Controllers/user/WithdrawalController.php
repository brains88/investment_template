<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Models\{User,Investment,Plan,Wallet,Deposit,Balance,Withdrawal,Referral};
use App\Mail\WithdrawalSubmittedMail;
use Str;
use Auth;

class WithdrawalController extends Controller
{
    //

    public function index()
    {
    
        $userData = auth()->user();
        $balance= Balance::where('user_id', $userData->id)->first();
        // Return the view with the plans and user data
        return view('user.payout', compact('userData', 'balance'));
    }

    public function getUserBalance(Request $request)
{
    $user = $request->user();
    $balance = Balance::where('user_id', $user->id)->value('balance');
    return response()->json(['balance' => $balance], 200);
}

//Get The authenticated user withdrawals
public function getWithdrawals(Request $request)
{
    $userData = auth()->user();
    $user = $request->user();
    $withdrawals = Withdrawal::where('user_id', $user->id)->latest()->paginate(6); // Example pagination
    return view('user.payout-history', compact('withdrawals', 'userData'));
}


public function submitWithdrawal(Request $request)
{
    // Common validations
    $validated = $request->validate([
        'amount' => 'required|numeric|min:1',
        'method' => 'required|in:crypto,bank,zelle,paypal',
        'account' => 'required|in:main,interest',
    ]);

    // Dynamically validate based on withdrawal method
    $this->validateMethodFields($validated['method'], $request);

    // Check user's balance
    $user = $request->user();
    $balanceMain = Balance::where('user_id', $user->id)->value('balance');
    $balanceInterest = Balance::where('user_id', $user->id)->value('interest');

    if ($validated['account'] === 'main') {
        if ($balanceMain === null || $validated['amount'] > $balanceMain) {
            return response()->json([
                'errors' => [
                    'account' => ['Insufficient main balance. Please fund your account.'],
                ]
            ], 422);
        }
    } elseif ($validated['account'] === 'interest') {
        if ($balanceInterest === null || $validated['amount'] > $balanceInterest) {
            return response()->json([
                'errors' => [
                    'account' => ['Insufficient interest balance. Please fund your account.'],
                ]
            ], 422);
        }
    }

    // Generate transaction ID
    $transactionId = $this->generateTransactionId();

    try {
        // Create withdrawal request
        Withdrawal::create([
            'user_id' => $user->id,
            'transaction_number' => $transactionId,
            'amount' => $validated['amount'],
            'method' => $validated['method'],
            'bank_name' => $request->input('bank_name'),
            'bank_account_number' => $request->input('bank_account_number'),
            'routing_number' => $request->input('routing_number'),
            'address' => $request->input('address'),
            'zelle_email' => $request->input('zelleEmail'),
            'paypal_email' => $request->input('paypalEmail'),
            'wallet_address' => $request->input('wallet_address'),
            'network' => $request->input('network'),
            'coin_type' => $request->input('coin_type'),
        ]);

            // Deduct the amount from user's balance
            //Balance::where('user_id', $user->id)->decrement('balance', $validated['amount']);
                
        // Send email notification
        try {
            Mail::to($user->email)->send(new WithdrawalSubmittedMail($transactionId, $validated['amount']));
        } catch (\Exception $e) {
            Log::error('Email failed to send for withdrawal', [
                'user_id' => $user->id,
                'transaction_id' => $transactionId,
                'error' => $e->getMessage(),
            ]);
        }

        return response()->json([
            'message' => 'Your withdrawal is being processed.',
            'transaction_number' => $transactionId,
        ], 200);

    } catch (\Illuminate\Database\QueryException $e) {
        return response()->json([
            'error' => 'An error occurred while processing your withdrawal. Please try again.',
        ], 500);
    } catch (\Exception $e) {
        Log::error('Error in Withdrawal:', ['message' => $e->getMessage()]);
        return response()->json([
            'error' => 'Something went wrong. Please contact support.',
        ], 500);
    }
}

private function validateMethodFields(string $method, Request $request)
{
    $rules = match ($method) {
        'crypto' => [
            'wallet_address' => 'required|string|max:255',
            'network' => 'required|string|max:255',
            'coin_type' => 'required|string|max:255',
        ],
        'bank' => [
            'bank_name' => 'required|string|max:255',
            'bank_account_number' => 'required|string|max:20',
            'routing_number' => 'required|string|max:20',
            'address' => 'required|string|max:255',
        ],
        'zelle' => [
            'zelleEmail' => 'required|email|max:255',
        ],
        'paypal' => [
            'paypalEmail' => 'required|email|max:255',
        ],
        default => [],
    };

    $request->validate($rules);
}


            private function generateTransactionId()
            {
                return random_int(1000000000, 9999999999);
            }
}
    
