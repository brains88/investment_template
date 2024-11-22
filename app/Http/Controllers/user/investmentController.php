<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\{User,investment,plan,balance};
use App\Mail\WelcomeMail;
use Str;
class investmentController extends Controller
{
    //


    public function index()
    {
        // Fetch paginated plans (6 per page in this case)
        $plans = Plan::paginate(6);
        
        // Return the plans as JSON
        return response()->json($plans);
    }
    

    public function bladePlans()
    {
        // Fetch paginated plans (6 per page in this case)
        $plans = Plan::paginate(6);
        
        // Get the authenticated user
        $userData = auth()->user();
        
        // Return the view with the plans and user data
        return view('user.plan', compact('plans', 'userData'));
    }
    


    public function userInvestments()
    {
        // Fetch all investments for the authenticated user
        $investments = Investment::where('user_id', Auth::id())->paginate(6);
        // Get the authenticated user
        $userData = auth()->user();

        foreach ($investments as $investment) {
             // Define one month as 30 days in seconds
            $oneMonthInSeconds = 30 * 24 * 60 * 60;

        // Calculate the total duration (1 month) and elapsed time
        $totalDuration = $oneMonthInSeconds;
        $elapsedTime = now()->timestamp - $investment->start_time->timestamp;

            // Assume 'end_time' is stored as a timestamp
            $totalDuration = $investment->end_time->timestamp - $investment->start_time->timestamp; 
            $elapsedTime = now()->timestamp - $investment->start_time->timestamp;
    
            // Calculate the percentage of the investment completed
            $investPercentage = ($elapsedTime / $totalDuration) * 100;
            $investment->investPercentage = min(100, max(0, $investPercentage)); // Ensure it's between 0 and 100
            // Calculate the remaining time in seconds
                $remainingTimeInSeconds = $oneMonthInSeconds - $elapsedTime;
                $investment->remainingTime = max(0, $remainingTimeInSeconds); // Ensure it's non-negative
                }
        // Pass the investments to the view
        return view('user.invest-history', compact('investments','userData'));
    

    }

  // InvestmentController.php
  public function makeInvestment(Request $request)
  {
      $validated = $request->validate([
          'plan_id' => 'required|exists:plans,id',
          'amount' => 'required|numeric|min:1',
      ]);
  
      $user = auth()->user();
      if (!$user) {
          return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
      }
  
      // Check if the user's balance is zero
      if ($user->balance->balance == 0) {
          return response()->json(['success' => false, 'message' => 'Insufficient balance. Your balance is zero.']);
      }
  
      // Fetch the plan
      $plan = Plan::find($validated['plan_id']);
      if (!$plan) {
          return response()->json(['success' => false, 'message' => 'Invalid plan selected.']);
      }
  
      // Check if the investment amount is within the plan's min and max
      if ($validated['amount'] < $plan->min_amount) {
          return response()->json(['success' => false, 'message' => 'Investment amount is less than the plan minimum.']);
      }
      if ($validated['amount'] > $plan->max_amount) {
          return response()->json(['success' => false, 'message' => 'Investment amount exceeds the plan maximum.']);
      }
  
      // Check if the user has sufficient balance
      if ($validated['amount'] > $user->balance->balance) {
          return response()->json(['success' => false, 'message' => 'Insufficient balance for this investment.']);
      }
  
      // Calculate duration (add 2 months)
      $startTime = now();
      $endTime = $startTime->copy()->addMonths($plan->duration + 2);
  
      // Calculate ROI
      $roi = ($validated['amount'] * $plan->interest) / 100;
  
      // Create new investment
      $investment = new Investment();
      $investment->user_id = $user->id;
      $investment->plan_id = $validated['plan_id'];
      $investment->amount = $validated['amount'];
      $investment->start_time = $startTime;
      $investment->end_time = $endTime;
      $investment->return_on_investment = $roi;
      $investment->save();
  
       // Subtract the investment amount from the user's balance
    $user->balance->balance = $user->balance->balance - $validated['amount'];
    $user->balance->save();  // Save the updated balance
  
      return response()->json([
        'success' => true, 
        'message' => 'Investment successful!',
         'investment' => $investment,
        ], 200);
  }
  
  

}
