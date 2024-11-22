<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\{User,investment,plan,wallet,Deposit,Referral};
use Str;
use Auth;
class ReferralController extends Controller
{
    //

    public function index()
    {
        $userData = auth()->user();
    
        // Get referrals for the authenticated user
        $referrals = Referral::with('referredUser')
            ->where('user_id', $userData->id)
            ->get();
    
        return view('user.referral', compact('referrals', 'userData'));
    }


    public function ShowReferrals()
    {
        $userData = auth()->user();
    
        // Get referrals for the authenticated user
      // Get referrals with investment data
      $referrals = Referral::with(['referredUser', 'investment'])
      ->where('user_id', auth()->id())
      ->paginate(6); // Adjust the number of referrals per page

  // Process bonuses for referrals with active investments
  foreach ($referrals as $referral) {
      $investment = $referral->investment;

      if ($investment) {
          $currentTime = now();

          if (!$referral->last_bonus_at || $referral->last_bonus_at->lt($currentTime->subDay())) {
              $bonus = 0.75; // Fixed bonus amount

              // Update referrer's balance in the balances table
              DB::table('balances')
                  ->where('user_id', $referral->user_id)
                  ->increment('interest', $bonus);

              // Update the last_bonus_at column
              $referral->update(['last_bonus_at' => $currentTime]);
          }
      }
  }
    
        return view('user.referral-bonus', compact('referrals', 'userData'));
    }
    

    //User Referral Bonus Table
    public function processReferralBonuses()
    {
        $userData = auth()->user();
    
        // Get referrals with investment data
        $referrals = Referral::with(['referredUser', 'investment'])
            ->where('user_id', auth()->id())
            ->paginate(6); // Adjust the number of referrals per page
    
        // Process bonuses for referrals with active investments
        foreach ($referrals as $referral) {
            $investment = $referral->investment;
    
            if ($investment) {
                $currentTime = now();
    
                if (!$referral->last_bonus_at || $referral->last_bonus_at->lt($currentTime->subDay())) {
                    $bonus = 0.75; // Fixed bonus amount
    
                    // Update referrer's balance in the balances table
                    DB::table('balances')
                        ->where('user_id', $referral->user_id)
                        ->increment('interest', $bonus);
    
                    // Update the last_bonus_at column
                    $referral->update(['last_bonus_at' => $currentTime]);
                }
            }
        }
    
        return redirect()->back()->with('success', 'Referral bonuses processed successfully.');
    }
}
