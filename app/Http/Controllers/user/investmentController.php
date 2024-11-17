<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\{User,investment,plan};
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
    


  // InvestmentController.php
public function makeInvestment(Request $request)
{
    $validated = $request->validate([
        'plan_id' => 'required|exists:plans,id',
        'amount' => 'required|numeric|min:1',
    ]);

    $user = auth()->user();
    if (!$user) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    // Check if the user's balance is zero
    if ($user->balance == 0) {
        return response()->json(['error' => 'Insufficient balance. Your balance is zero.'], 400);
    }

    // Fetch the plan
    $plan = Plan::find($validated['plan_id']);
    if (!$plan) {
        return response()->json(['error' => 'Invalid plan'], 404);
    }

    // Check if the investment amount is within the plan's min and max amount
    if ($validated['amount'] < $plan->min_amount) {
        return response()->json(['error' => 'Investment amount is less than the plan minimum amount.'], 400);
    }
    if ($validated['amount'] > $plan->max_amount) {
        return response()->json(['error' => 'Investment amount exceeds the plan maximum amount.'], 400);
    }

    // Check if the user has sufficient balance
    if ($validated['amount'] > $user->balance) {
        return response()->json(['error' => 'You do not have sufficient balance to make this investment.'], 400);
    }

    // Calculate end time based on plan's duration
    $startTime = now();
    $endTime = $startTime->copy()->addDays($plan->duration);  // Add duration days to start time

    // Calculate ROI (if needed)
    $roi = ($validated['amount'] * $plan->interest) / 100;

    // Create new investment
    $investment = new Investment();
    $investment->user_id = $user->id;
    $investment->plan_id = $validated['plan_id'];
    $investment->amount = $validated['amount'];
    $investment->start_time = $startTime;
    $investment->end_time = $endTime;
    $investment->return_on_investment = $roi;  // Save ROI
    $investment->save();

    // Return success response with investment details
    return response()->json([
        'message' => 'Investment submitted successfully',
        'investment' => $investment,
        'roi' => $roi,
    ]);
}

}
