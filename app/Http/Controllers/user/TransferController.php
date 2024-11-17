<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\{User,investment,plan,wallet,Deposit,transfer,Balance};
use App\Mail\WelcomeMail;
use Str;
use Auth;

class TransferController extends Controller
{
    //

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
            $receiver->balance->increment('balance', $request->amount);

            // Commit the transaction
            DB::commit();

            return response()->json(['message' => 'Transfer successful', 'transaction' => $transaction], 201);
        } catch (\Exception $e) {
            // Rollback if anything fails
            DB::rollBack();
            return response()->json(['error' => 'Transaction failed: ' . $e->getMessage()], 500);
        }
    }

    public function index()
    {
        // Fetch transactions where the authenticated user is either the sender or the receiver
        $transactions = Transfer::with(['receiver', 'sender'])
            ->where('sender_id', auth()->id())
            ->orWhere('receiver_id', auth()->id())
            ->get();

        return response()->json($transactions);
    }
}
