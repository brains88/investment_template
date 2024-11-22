<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\{User,investment,plan,wallet,Deposit,Balance,withdrawal,referral};
use App\Mail\WelcomeMail;
use Str;
use Auth;
class DashboardController extends Controller
{
    //

    public function index()
    {
        // Fetch totals for balances, interests, deposits, withdrawals, etc.
        $totalUsers = User::where('role','user')->count(); // Count all users
        $totalBalances = Balance::sum('balance'); // Sum of all user balances
        $totalInterest = Balance::sum('interest'); // Sum of all user interest balances
        $totalDeposits = Deposit::sum('amount');
        $totalWithdrawals = Withdrawal::sum('amount');
        $totalInvestments = Investment::sum('amount'); // Sum of user investments
    
        // Prepare data for monthly charts
        $monthlyDeposits = Deposit::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->groupBy('month')
            ->pluck('total', 'month');
        $monthlyWithdrawals = Withdrawal::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->groupBy('month')
            ->pluck('total', 'month');
        $monthlyInvestments = Investment::selectRaw('MONTH(created_at) as month, SUM(amount) as total')
            ->groupBy('month')
            ->pluck('total', 'month');
    
        // ROI percentage (as an example)
        $roiPercentage = $totalWithdrawals > 0 ? ($totalWithdrawals / $totalInvestments) * 100 : 0;
    
        // Return the view with all data
        return view('admin.dashboard', compact(
            'totalUsers',
            'totalBalances',
            'totalInterest',
            'totalDeposits',
            'totalWithdrawals',
            'totalInvestments',
            'monthlyDeposits',
            'monthlyWithdrawals',
            'monthlyInvestments',
            'roiPercentage'
        ));
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
