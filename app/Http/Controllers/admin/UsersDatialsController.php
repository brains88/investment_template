<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
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
    

}
