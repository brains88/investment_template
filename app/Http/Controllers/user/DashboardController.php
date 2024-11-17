<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\{User,investment,plan,wallet,Deposit,Balance};
use App\Mail\WelcomeMail;
use Str;
use Auth;
class DashboardController extends Controller
{
    //

    public function getUserMetrics(Request $request)
    {
        $userId = auth()->id();
    
        // Return default values if no user is authenticated
        if (!$userId) {
            return response()->json([
                'balance' => 0.00,
                'withdrawal' => 0.00,
                'deposit' => 0.00,
                'investment' => 0.00,
            ]);
        }
    
        // Get user balance or default to 0.00
        $balance = DB::table('balances')
            ->where('user_id', $userId)
            ->value('balance') ?? 0.00;
    
        // Get the total withdrawal amount where status is completed or default to 0.00
        $withdrawal = DB::table('withdrawals')
            ->where('user_id', $userId)
            ->where('status', 'completed')
            ->sum('amount') ?? 0.00;
    
        // Get the total deposit amount where status is completed or default to 0.00
        $deposit = DB::table('deposits')
            ->where('user_id', $userId)
            ->where('status', 'completed')
            ->sum('amount') ?? 0.00;
    
        // Get the total investment amount or default to 0.00
        $investment = DB::table('investments')
            ->where('user_id', $userId)
            ->sum('amount') ?? 0.00;
    
        // Return calculated metrics
        return response()->json([
            'balance' => $balance,
            'withdrawal' => $withdrawal,
            'deposit' => $deposit,
            'investment' => $investment,
        ]);
    }
    
    //User Profile

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'message' => 'User not authenticated',
            ], 401);
        }

        // Validate request data
        $request->validate([
            'newPassword' => 'required|string|min:8|confirmed', // Ensure password confirmation is sent as 'password_confirmation'
        ]);

        // Update the user's password
        $user->password = Hash::make($request->password);
        $user->save();

        return response()->json([
            'message' => 'Password updated successfully!',
        ]);
    }

}
