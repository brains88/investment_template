<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; // Import the Log facade
use App\Models\{User,Investment,Plan,Wallet,Deposit,Balance,Withdrawal,Transfer,Referral};
use App\Mail\WelcomeMail;
use Str;

class UsersDatialsController extends Controller
{
    //

    //Approve User Deposite
    public function approveDeposit($id)
    {
        $transaction = Deposit::findOrFail($id);

        if ($transaction->status !== 'pending') {
            return back()->with('error', 'Transaction is not pending.');
        }

        // Update transaction status
        $transaction->status = 'completed';
        $transaction->save();

        // Add amount to user's balance
        $user = $transaction->user;
        $userBalance = $user->balance;
        if ($userBalance) {
            $userBalance->balance += $transaction->amount;
            $userBalance->save();
        } else {
            // If the user has no balance record, create one
            $user->balance()->create(['balance' => $transaction->amount]);
        }

        return back()->with('success', 'Transaction approved and user balance updated.');
    }

    //Delete user Deposit
    public function deleteDeposit($id)
    {
        $transaction = Deposit::findOrFail($id);

        if ($transaction->status === 'completed') {
            return back()->with('error', 'Cannot delete a completed transaction.');
        }

        $transaction->delete();

        return back()->with('success', 'Transaction deleted successfully.');
    }


    //Approve Withdrawal 
    public function approveWithdrawal($id)
    {
        $Withdrawal = Withdrawal::findOrFail($id);

        if ($Withdrawal->status !== 'pending') {
            return back()->with('error', 'Withdrawal is not pending.');
        }

        // Deduct the Withdrawal amount from user's balance
        $user = $Withdrawal->user;
        $userBalance = $user->balance;

        if ($userBalance && $userBalance->balance >= $Withdrawal->amount) {
            $userBalance->balance -= $Withdrawal->amount;
            $userBalance->save();

            // Update Withdrawal status to completed
            $Withdrawal->status = 'complete';
            $Withdrawal->save();

            return back()->with('success', 'Withdrawal approved successfully.');
        }

        return back()->with('error', 'Insufficient balance for this Withdrawal.');
    }

    //Delete Deposit
        public function deleteWithdrawal($id)
    {
        $Withdrawal = Withdrawal::findOrFail($id);

        if ($Withdrawal->status === 'complete') {
            return back()->with('error', 'Cannot delete a completed Withdrawal.');
        }

        $Withdrawal->delete();

        return back()->with('success', 'Withdrawal deleted successfully.');
    }

    //Withdrawal Feedback
    public function addFeedback(Request $request)
    {
        $Withdrawal = Withdrawal::findOrFail($request->id);
        $Withdrawal->feedback = $request->feedback;
        $Withdrawal->save();
    
        return back()->with('success', 'Feedback added successfully.');
    }
    
    //Send Activation Mail
    public function sendActivationEmail($id)
    {
        Log::info('Send Activation Email hit for user ID: ' . $id);
    
        $user = User::findOrFail($id);
        $verificationCode = $user->verification_code;
    
        try {
            // Simulate email sending for debugging
            Log::info('Sending email to: ' . $user->email);
    
            
             Mail::to($user->email)->send(new WelcomeMail($user, $verificationCode));
    
            return response()->json(['message' => 'Activation email sent successfully!'], 200);
        } catch (\Exception $e) {
            Log::error('Failed to send email for user ID ' . $id . ': ' . $e->getMessage());
            return response()->json(['message' => 'Failed to send activation email. Please try again.'], 500);
        }
    }
    

    //Adjust the user balance

    public function adjustBalance(Request $request)
    {
        // Validate the request
        $request->validate([
            'action' => 'required|in:increment,decrement',
            'user_id' => 'required|integer|exists:users,id',
            'amount' => 'required|numeric|min:0',
        ]);
    
        // Find the user
        $user = User::find($request->user_id);
    
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }
    
        // Access the related Balance model or create one if it doesn't exist
        $balance = $user->balance;
    
        if (!$balance) {
            // Create a new balance record with default values
            $balance = $user->balance()->create([
                'user_id' => $user->id,
                'balance' => 0,
                'interest' => null, // Set interest to null
            ]);
        }
    
        // Check for sufficient balance if action is decrement
        if ($request->action === 'decrement' && $request->amount > $balance->balance) {
            return response()->json(['message' => 'Insufficient balance.'], 400); // 400 Bad Request
        }
    
        // Adjust the balance
        if ($request->action === 'increment') {
            $balance->balance += $request->amount;
        } elseif ($request->action === 'decrement') {
            $balance->balance -= $request->amount;
        }
    
        // Save the updated balance
        $balance->save();
    
        return response()->json(['message' => 'Balance adjusted successfully.']);
    }
    
    
}
