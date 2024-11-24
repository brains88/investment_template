<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\{User,investment,plan,balance,transactions};

class TransactionsController extends Controller
{
    //

    public function getUserTransactions()
    {
        //Get the Auth user data
        $userData = auth()->user();
        // Get all completed transactions for the authenticated user
        $transactions = Transactions::where('user_id', auth()->id())
            ->where('status', 'completed')
            ->whereIn('type', ['transfer', 'withdrawal', 'investment'])
            ->paginate(6);

        // Pass the transactions to the view
        return view('user.transactions', compact('transactions','userData' ));
    }
}
