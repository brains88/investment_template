<?php
namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\transfer;
use Illuminate\Support\Facades\Auth;

//
class TransactionsController extends Controller
{
 //

 public function getUserTransactions()
 {
  //Get the Auth user data
  $userData = auth()->user();
  // Get all completed transactions for the authenticated user
  $transactions = Transfer::where('user_id', auth()->id())
   ->where('status', 'completed')
   ->whereIn('type', ['transfer', 'withdrawal', 'investment'])
   ->orderBy('created_at', 'desc')
   ->paginate(6);

  // Pass the transactions to the view
  return view('user.transactions', compact('transactions', 'userData'));
 }
}
