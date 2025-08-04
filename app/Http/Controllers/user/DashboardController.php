<?php
namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;

use App\Models\Deposit;

use App\Models\Investment;

use App\Models\Plan;

use App\Models\Referral;
use App\Models\User;
use App\Models\Withdrawal;use Auth;use Illuminate\Http\Request;use Illuminate\Support\Facades\DB;use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
 //

 public function index()
 {
  // Check if a user is authenticated
  $userId = auth()->id();
  if (! $userId) {
   return redirect('/login')->with('error', 'Please log in to access your dashboard.');
  }

  // Get the latest referral for the authenticated user
  $latestReferral = Referral::with('referredUser')
   ->where('user_id', $userId)
   ->latest()
   ->first();
  // Fetch the authenticated user with their relationships
  $user = User::with(['balance', 'investment.plan', 'withdrawal', 'deposit'])->find($userId);

  // If user doesn't exist, redirect
  if (! $user) {
   return redirect('/login')->with('error', 'User not found.');
  }

  $balance = DB::table('balances')
   ->where('user_id', $userId)->first();

  $withdrawal = DB::table('withdrawals')
   ->where('user_id', $userId)
   ->where('status', 'complete')
   ->sum('amount') ?? 0.00;

  $deposit = DB::table('deposits')
   ->where('user_id', $userId)
   ->where('status', 'completed')
   ->sum('amount') ?? 0.00;

  $investment = DB::table('investments')
   ->where('user_id', $userId)
   ->sum('amount') ?? 0.00;

  // Safely calculate investment and ROI percentages
  $totalInvestment    = $user->investment ? $user->investment->sum('amount') : 0;
  $returnOnInvestment = $user->investment ? $user->investment->sum('return_on_investment') : 0;

  $investPercentage = $totalInvestment > 0 ? min(($totalInvestment / 100000) * 100, 100) : 0; // Example target of 100,000
  $roiDecimal       = $totalInvestment > 0 ? min(($returnOnInvestment / $totalInvestment) * 100, 100) : 0;
  $roiPercentage    = round($roiDecimal * 100 / 100, 2);                                // Convert to percentage
                                                                                        // Calculate ROI speed based on the plan's duration
  $investmenttartDate = optional($user->investment->first())->created_at;               // Assume first investment for simplicity
  $planDuration       = optional(optional($user->investment->first())->plan)->duration; // Plan duration in months

  $roiSpeed = 0;
  if ($investmenttartDate && $planDuration) {
   $durationInDays = $planDuration * 30; // Convert months to days
   $elapsedDays    = now()->diffInDays($investmenttartDate);
   $roiSpeed       = $elapsedDays > 0 ? min(($elapsedDays / $durationInDays) * 100, 100) : 0;
  }

  // Prepare monthly data for deposit, withdrawal, and investment
  $depositData = $user->deposit
  ? $user->deposit
   ->groupBy(fn($deposit) => $deposit->created_at->format('m'))
   ->map(fn($group) => $group->sum('amount'))
  : collect();

  $withdrawalData = $user->withdrawal
  ? $user->withdrawal
   ->groupBy(fn($withdrawal) => $withdrawal->created_at->format('m'))
   ->map(fn($group) => $group->sum('amount'))
  : collect();

  $investmentData = $user->investment
  ? $user->investment
   ->groupBy(fn($investment) => $investment->created_at->format('m'))
   ->map(fn($group) => $group->sum('amount'))
  : collect();

  return view('user.dashboard', [
   'investPercentage' => $investPercentage,
   'roiPercentage'    => $roiPercentage,
   'roiSpeed'         => $roiSpeed,
   'depositData'      => $depositData,
   'withdrawalData'   => $withdrawalData,
   'investmentData'   => $investmentData,
   'userData'         => $user,
   'roiEarn'          => $returnOnInvestment,
   'balance'          => $balance,
   'withdrawal'       => $withdrawal,
   'deposit'          => $deposit,
   'investment'       => $investment,
   'latestReferral'   => $latestReferral,
   'TotalEarn'        => $returnOnInvestment,

  ]);
 }

 //User Profile

 public function updatePassword(Request $request)
 {
  $user = Auth::user();

  if (! $user) {
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
