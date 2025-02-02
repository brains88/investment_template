<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Balance;
use App\Models\Investment;
use App\Models\Plan;
use App\Models\User;
use Illuminate\Http\Request;use Illuminate\Support\Facades\Auth;

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
        $investments = Investment::paginate(6);
        foreach ($investments as $investment) {
            // Ensure timestamps are valid before calculations
            if (! $investment->start_time || ! $investment->end_time) {
                continue;
            }

            $totalDuration = $investment->end_time->timestamp - $investment->start_time->timestamp;
            $elapsedTime   = now()->timestamp - $investment->start_time->timestamp;

            // Ensure duration is positive to avoid division errors
            if ($totalDuration <= 0) {
                $investment->status = 'completed';
                $investment->save();
                continue;
            }

            // Calculate progress (but do NOT save these to DB)
            $investment->investPercentage = min(100, max(0, ($elapsedTime / $totalDuration) * 100));
            $investment->remainingTime    = max(0, $totalDuration - $elapsedTime);

            // Only process interest if the investment is NOT already completed
            if ($investment->investPercentage >= 100 && $investment->status !== 'completed') {
                $returnOnInvestment = $investment->amount * ($investment->return_on_investment / 10000);
                Balance::where('user_id', $investment->user_id)->increment('interest', $returnOnInvestment);

                // Mark investment as completed
                $investment->status = 'completed';
                $investment->save();
            }
        }

        return view('admin.invest-history', compact('investments'));
    }

    // InvestmentController.php
    public function makeInvestment(Request $request)
    {
        $validated = $request->validate([
            'plan_id' => 'required|exists:plans,id',
            'amount'  => 'required|numeric|min:1',
        ]);

        $user = auth()->user();
        if (! $user) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 401);
        }

        // Check if the user's balance is zero
        if ($user->balance->balance == 0) {
            return response()->json(['success' => false, 'message' => 'Insufficient balance. Your balance is zero.']);
        }

        // Fetch the plan
        $plan = Plan::find($validated['plan_id']);
        if (! $plan) {
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
        $endTime   = $startTime->copy()->addMonths($plan->duration + 2);

        // Calculate ROI
        $roi = ($validated['amount'] * $plan->interest) / 100;

        // Create new investment
        $investment                       = new Investment();
        $investment->user_id              = $user->id;
        $investment->plan_id              = $validated['plan_id'];
        $investment->amount               = $validated['amount'];
        $investment->start_time           = $startTime;
        $investment->end_time             = $endTime;
        $investment->return_on_investment = $roi;
        $investment->save();

        // Subtract the investment amount from the user's balance
        $user->balance->balance = $user->balance->balance - $validated['amount'];
        $user->balance->save(); // Save the updated balance

        return response()->json([
            'success'    => true,
            'message'    => 'Investment successful!',
            'investment' => $investment,
        ], 200);
    }

}
