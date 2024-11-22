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

class UsersController extends Controller
{

      Public function index(){
        // Fetch paginated users
      $users = User::where('role','user')->paginate(10); // Adjust the number to suit your needs

      return view('admin.users', compact('users'));
      }

            // AdminController.php
            public function viewUser($id)
            {
                $user = User::findOrFail($id);
            
                // Fetch related data, ensuring it's always an object or collection, even if empty
                $withdrawals = Withdrawal::where('user_id', $user->id)->paginate(6);  // Ensure it defaults to an empty collection
                $investments = Investment ::where('user_id', $user->id)->paginate(6);
                $deposits = Deposit::where('user_id', $user->id)->paginate(6);
                $referrals =Referral::where('user_id', $user->id)->paginate(6);
                $transfers = Transfer::where('sender_id', $user->id)->paginate(6);;

                // Calculate the total amounts for each category
                $totalWithdrawalAmount = $withdrawals->sum('amount'); 
                $totalInvestmentAmount = $investments->sum('amount');
                $totalDepositAmount = $deposits->sum('amount');
                $totalReferredUsers = $referrals->count();  // Summing the referral amounts
            
                return view('admin.user-details', compact('user','totalDepositAmount', 'totalReferredUsers','totalInvestmentAmount','totalWithdrawalAmount','withdrawals', 'investments', 'deposits', 'referrals', 'transfers'));
            }
            
            //Ban User Function
            public function banUser(Request $request, $id)
            {
                $user = User::findOrFail($id);
            
                // Assuming the 'ban' status is a boolean field
                $user->account= 'banned'; 
                $user->reason = $request->ban_reason; // Assuming you save the reason
                $user->save();
            
                // Set flash message to display on success
                session()->flash('message', 'User has been banned successfully.');
            
                return redirect()->route('admin.users'); // Redirect back to the users list
            }

            //Unban User Function
            public function unbanUser($id)
            {
                $user = User::findOrFail($id);
                $user->account= 'active';
                $user->reason = null; // Optionally clear the ban reason
                $user->save();

                session()->flash('message', 'User has been unbanned successfully.');
                return redirect()->route('admin.users'); // Redirect back to the users list
            }

        //Delete User Function
        public function deleteUser($id)
        {
            $user = User::findOrFail($id);
            $user->delete();

            return redirect()->route('admin.users')->with('success', 'User has been deleted.');
        }

      

}
