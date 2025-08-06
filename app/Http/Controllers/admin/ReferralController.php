<?php

namespace App\Http\Controllers\admin;

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

    public function GetAllReferrals()
    {
    
        // Get referrals for the authenticated user
        $referrals = Referral::with('referredUser')->orderBy('created_at', 'desc')->paginate(6);
    
        return view('admin.referral', compact('referrals'));
    }


  
}
