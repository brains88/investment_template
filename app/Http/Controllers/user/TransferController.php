<?php
namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Models\transfer;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Str;

class TransferController extends Controller
{
    //

    public function index()
    {

        $userData = auth()->user();

        // Return the view with the plans and user data
        return view('user.money-transfer', compact('userData'));
    }

    public function getUserTransactions()
    {
        //Get the Auth user data
        $userData = auth()->user();
        // Get all completed transactions for the authenticated user
        $transactions = Transfer::where('sender_id', auth()->id())
            ->Orwhere('receiver_id', auth()->id())
            ->with(['sentTransfers', 'receivedTransfers'])
            ->paginate(6);

        // Pass the transactions to the view
        return view('user.transactions', compact('transactions', 'userData'));
    }

    public function store(Request $request)
    {

        // Validate request
        $request->validate([
            'receiver_email' => 'required|email|exists:users,email',
            'amount'         => 'required|numeric|min:0.01',
            'password'       => 'required',
        ]);

        // Verify sender's password
        $sender = auth()->user();
        if (! Hash::check($request->password, $sender->password)) {
            return response()->json(['error' => 'Incorrect password'], 401);
        }

        // Fetch receiver by email
        $receiver = User::where('email', $request->receiver_email)->first();

        if (! $receiver) {
            return response()->json(['error' => 'Receiver not found'], 404);
        }

        // Prevent user from sending money to themselves
        if ($sender->id === $receiver->id) {
            return response()->json(['error' => 'You cannot send money to yourself'], 400);
        }

        // Check if sender has a valid balance record
        $senderBalance = $sender->balance;
        if (is_null($senderBalance) || $senderBalance->balance == 0) {
            return response()->json(['error' => 'Your balance is empty'], 400);
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
                'balance' => 0, // Start with a balance of 0
            ]);
        }

        // Start a database transaction
        DB::beginTransaction();

        try {
            // Generate a unique transaction ID
            $transactionId = Str::uuid()->toString();

            // Create the transaction
            $transaction = Transfer::create([
                'transaction_id' => $transactionId, // Store the unique transaction ID
                'sender_id'      => $sender->id,
                'receiver_id'    => $receiver->id,
                'amount'         => $request->amount,
                'status'         => 'Completed', // Set status to "Completed" for successful transfers
            ]);

            // Deduct from sender's balance and add to receiver's balance
            $senderBalance->decrement('balance', $request->amount);
            $receiverBalance->increment('balance', $request->amount);

            // Commit the transaction
            DB::commit();

            return response()->json([
                'message'     => 'Transfer successful',
                'transaction' => $transaction,
            ], 201);
        } catch (\Exception $e) {
            // Rollback if anything fails
            DB::rollBack();
            return response()->json(['error' => 'Transaction failed: ' . $e->getMessage()], 500);
        }
    }

}
