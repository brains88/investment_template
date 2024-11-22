<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\{User,investment,plan,wallet,Deposit,transfer,Balance,withdrawal};
use App\Mail\WelcomeMail;
use Str;
use Auth;

class TransferController extends Controller
{
    //

    public function GetUsertransfers()
    {
        $transfers = Transfer::with(['sender', 'receiver'])->paginate(10); // Adjust pagination as needed
        return view('admin.transfer', compact('transfers'));
    }

    // Delete a transfer
    public function destroy($id)
    {
        $transfer = Transfer::findOrFail($id);
        $transfer->delete();

        return redirect()->route('admin.transfer')->with('success', 'Transfer deleted successfully.');
    }

  
    
}
