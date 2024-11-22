<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\{User,investment,plan,wallet,Deposit,transfer,Balance,withdrawal};
use App\Mail\WelcomeMail;
use Str;
use Auth;

class TransferController extends Controller
{
    //

    
    public function index()
    {
    
        $userData = auth()->user();
    
        // Return the view with the plans and user data
        return view('user.money-transfer', compact('userData'));
    }

    /*
    public function getUserTransactions()
    {
        $userData = auth()->user();
        
        // Fetch transactions where the authenticated user is either the sender or the receiver
        $transactions = Transfer::with(['sender', 'receiver']) // Eager load the sender and receiver relationships
            ->where(function ($query) {
                $query->where('sender_id', auth()->id())
                      ->orWhere('receiver_id', auth()->id());
            })
            ->where('status', 'completed') // Only show completed transactions
            ->get();
        
        // Pass the data to the view
        return view('user.transactions', compact('transactions', 'userData'));
    }
    
    
    */

    public function store(Request $request)
    {
        // Validate request
        $request->validate([
            'receiver_email' => 'required|email|exists:users,email',
            'amount' => 'required|numeric|min:0.01',
            'password' => 'required',
        ]);
    
        // Verify sender's password
        $sender = auth()->user();
        if (!Hash::check($request->password, $sender->password)) {
            return response()->json(['error' => 'Incorrect password'], 401);
        }
    
        // Fetch receiver by email
        $receiver = User::where('email', $request->receiver_email)->first();
    
        if (!$receiver) {
            return response()->json(['error' => 'Receiver not found'], 404);
        }
    
        // Check if sender has a valid balance record
        $senderBalance = $sender->balance;
        if (is_null($senderBalance) || $senderBalance->balance == 0) {
            return response()->json(['error' => 'Your Balance is empty'], 400);
        }
    
        // Check if sender has enough funds
        if ($senderBalance->balance < $request->amount) {
            return response()->json(['error' => 'Insufficient funds'], 400);
        }
    
        // Check if the receiver has a balance record; if not, create one
        $receiverBalance = $receiver->balance;
        if (is_null($receiverBalance)) {
            // Create balance record for receiver if it does not exist
            $receiverBalance = $receiver->balance()->create([
                'balance' => 0,  // Start with a balance of 0
            ]);
        }
    
        // Start a database transaction
        DB::beginTransaction();
    
        try {
            // Create the transaction
            $transaction = Transfer::create([
                'sender_id' => $sender->id,
                'receiver_id' => $receiver->id,
                'amount' => $request->amount,
                'status' => 'Pending',
            ]);
    
            // Deduct from sender's balance and add to receiver's balance
            $senderBalance->decrement('balance', $request->amount);
            $receiverBalance->increment('balance', $request->amount);
    
            // Commit the transaction
            DB::commit();
    
            return response()->json(['message' => 'Transfer successful', 'transaction' => $transaction], 201);
        } catch (\Exception $e) {
            // Rollback if anything fails
            DB::rollBack();
            return response()->json(['error' => 'Transaction failed: ' . $e->getMessage()], 500);
        }
    }
    
}
