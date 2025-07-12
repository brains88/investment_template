<?php
namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;

use App\Models\Balance;

use App\Models\Investment;

use App\Models\Plan;

use App\Models\User;
use App\Models\Withdrawal;use Illuminate\Http\Request;use Illuminate\Support\Facades\Auth;use Illuminate\Support\Facades\DB;use Illuminate\Support\Facades\Hash;
class investmentController extends Controller
{
    //

    public function index()
    {
        // Fetch paginated plans (6 per page in this case)
        $plans = Plan::paginate(12);

        // Return the plans as JSON
        return response()->json($plans);
    }

    public function bladePlans()
    {
        // Fetch paginated plans (6 per page in this case)
        $plans = Plan::paginate(12);

        // Get the authenticated user
        $userData = auth()->user();

        // Return the view with the plans and user data
        return view('user.plan', compact('plans', 'userData'));
    }

     public function userInvestments()
{
    $investments = Investment::with('plan')->where('user_id', Auth::id())->paginate(10);
    $userData = auth()->user();

    foreach ($investments as $investment) {
        if (!$investment->start_time || !$investment->plan || !$investment->plan->duration) {
            continue;
        }

        $durationWeeks = (int)$investment->plan->duration;
        $totalDays = $durationWeeks * 7;
        $endTime = $investment->start_time->copy()->addWeeks($durationWeeks);

        // Set end_time if not yet set
        if (!$investment->end_time) {
            $investment->end_time = $endTime;
            $investment->save();
        }

        $now = now();
        $totalDuration = $endTime->timestamp - $investment->start_time->timestamp;
        $elapsedTime = $now->timestamp - $investment->start_time->timestamp;

        if ($totalDuration <= 0) {
            $investment->status = 'completed';
            $investment->save();
            continue;
        }

        // Calculate daily ROI
        $totalROI = $investment->return_on_investment; // already calculated in makeInvestment()
        $dailyROI = $totalROI / $totalDays;

        // How many full days have passed since start
        $daysElapsed = $investment->start_time->diffInDays($now);
        $daysElapsed = min($daysElapsed, $totalDays); // cap it to total days

        // Calculate expected earnings up to today
        $expectedEarned = $dailyROI * $daysElapsed;

        // Update the amount_earned only if it has changed
        if (round($investment->amount_earned, 2) < round($expectedEarned, 2)) {
            $investment->amount_earned = round($expectedEarned, 2);
            $investment->save();
        }

        // Set progress & remaining time
        $investment->investPercentage = min(100, max(0, ($elapsedTime / $totalDuration) * 100));
        $investment->remainingTime = max(0, $endTime->timestamp - $now->timestamp);

        // Mark completed & transfer total ROI to interest
        if ($investment->investPercentage >= 100 && $investment->status !== 'completed') {
            $totalROI = $investment->return_on_investment;
            $capital  = $investment->amount;

            // Add ROI to interest
            Balance::where('user_id', $investment->user_id)->increment('interest', $totalROI);

            // Return capital to main balance
            Balance::where('user_id', $investment->user_id)->increment('balance', $capital);

            // Mark as completed
            $investment->status = 'completed';
            $investment->save();
        }
    }

    return view('user.invest-history', compact('investments', 'userData'));
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

    if ($user->balance->balance == 0) {
        return response()->json(['success' => false, 'message' => 'Insufficient balance. Your balance is zero.']);
    }

    $plan = Plan::find($validated['plan_id']);
    if (! $plan) {
        return response()->json(['success' => false, 'message' => 'Invalid plan selected.']);
    }

    if ($validated['amount'] < $plan->min_amount) {
        return response()->json(['success' => false, 'message' => 'Investment amount is less than the plan minimum.']);
    }

    if ($validated['amount'] > $plan->max_amount) {
        return response()->json(['success' => false, 'message' => 'Investment amount exceeds the plan maximum.']);
    }

    if ($validated['amount'] > $user->balance->balance) {
        return response()->json(['success' => false, 'message' => 'Insufficient balance for this investment.']);
    }

    $startTime = now();
    $durationWeeks = (int)$plan->duration;
    $endTime = $startTime->copy()->addWeeks($durationWeeks);

    $roi = ($validated['amount'] * $plan->interest) / 100;

    $investment                       = new Investment();
    $investment->user_id              = $user->id;
    $investment->plan_id              = $validated['plan_id'];
    $investment->amount               = $validated['amount'];
    $investment->start_time           = $startTime;
    $investment->end_time             = $endTime;
    $investment->return_on_investment = $roi;
    $investment->amount_earned        = 0.00;
    $investment->save();

    $user->balance->balance -= $validated['amount'];
    $user->balance->save();

    return response()->json([
        'success'    => true,
        'message'    => 'Investment successful!',
        'investment' => $investment,
    ], 200);
}


}
