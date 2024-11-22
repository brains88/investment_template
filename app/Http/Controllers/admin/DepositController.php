<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\{User,investment,plan,wallet,Deposit};
use App\Mail\WelcomeMail;
use Str;
use Auth;
class DepositController extends Controller
{
    //

    public function GetUserdeposits()
    {
        $deposits = Deposit::paginate(6);   // Paginate results (6 per page)
        
        
        return view('admin.fund-history', compact('deposits'));
    }
    
    

}
