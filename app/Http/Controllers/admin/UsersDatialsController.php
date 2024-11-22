<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\{User,investment,plan,wallet,Deposit,Balance,withdrawal,transfer,referral};
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
        $withdrawal = Withdrawal::findOrFail($id);

        if ($withdrawal->status !== 'pending') {
            return back()->with('error', 'Withdrawal is not pending.');
        }

        // Deduct the withdrawal amount from user's balance
        $user = $withdrawal->user;
        $userBalance = $user->balance;

        if ($userBalance && $userBalance->balance >= $withdrawal->amount) {
            $userBalance->balance -= $withdrawal->amount;
            $userBalance->save();

            // Update withdrawal status to completed
            $withdrawal->status = 'complete';
            $withdrawal->save();

            return back()->with('success', 'Withdrawal approved successfully.');
        }

        return back()->with('error', 'Insufficient balance for this withdrawal.');
    }

    //Delete Deposit
        public function deleteWithdrawal($id)
    {
        $withdrawal = Withdrawal::findOrFail($id);

        if ($withdrawal->status === 'complete') {
            return back()->with('error', 'Cannot delete a completed withdrawal.');
        }

        $withdrawal->delete();

        return back()->with('success', 'Withdrawal deleted successfully.');
    }

    //Withdrawal Feedback
    public function addFeedback(Request $request)
    {
        $withdrawal = Withdrawal::findOrFail($request->id);
        $withdrawal->feedback = $request->feedback;
        $withdrawal->save();
    
        return back()->with('success', 'Feedback added successfully.');
    }
    

}