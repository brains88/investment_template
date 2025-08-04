<?php
namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Mail\DepositSubmittedMail;
use App\Models\Deposit;
use App\Models\User;
use App\Models\Wallet;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Str;

class DepositController extends Controller
{
 //

 public function index()
 {
  $wallets = Wallet::all();

  $userData = auth()->user();

  // Return the view with the plans and user data
  return view('user.add-fund', compact('wallets', 'userData'));
 }

 public function GetUserdeposits()
 {
  $deposits = Deposit::where('user_id', Auth::id())
   ->with('wallet')                // Eager load the wallet relationship
   ->orderBy('created_at', 'desc') // Order by the latest deposits
   ->paginate(6);                  // Paginate results (6 per page)

  $userData = auth()->user();

  return view('user.fund-history', compact('deposits', 'userData'));
 }

 public function Makedeposit(Request $request)
 {
  $validated = $request->validate([
   'amount'    => 'required|numeric|min:1',
   'wallet_id' => 'required|exists:wallets,id',
  ]);

  $user    = auth()->user();
  $deposit = Deposit::create([
   'user_id'            => auth()->id(),
   'transaction_number' => $this->generateTransactionNumber(),
   'amount'             => $validated['amount'],
   'wallet_id'          => $validated['wallet_id'],
  ]);

  // Attempt to send email notification
  try {
   Mail::to($user->email)->send(new DepositSubmittedMail($deposit->transaction_number, $validated['amount']));
  } catch (\Exception $e) {
   Log::error('Email failed to send: ' . $e->getMessage());
  }

  return response()->json([
   'success' => true,
   'message' => 'Deposit created successfully.',
   'data'    => [
    'amount'             => $deposit->amount,
    'transaction_number' => $deposit->transaction_number,
    'wallet_address'     => $deposit->wallet->address,
    'coin'               => $deposit->wallet->coin,
    'network'            => $deposit->wallet->network,
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
