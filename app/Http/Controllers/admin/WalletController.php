<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\{User,Investment,Plan,Wallet,Deposit,Transfer,Balance,Withdrawal};
use App\Mail\WelcomeMail;
use Str;
use Auth;
class WalletController extends Controller
{
    //
    public function index()
    {
        $wallets = Wallet::paginate(10); // Fetch wallets with pagination
        return view('admin.wallets', compact('wallets'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'coin' => 'required|string|max:255',
            'address' => 'required|string',
            'network' => 'required|string',
            'min_amount' => 'required|numeric',
            'max_amount' => 'required|numeric',
            'image' => 'required|image|max:2048',
        ]);
    
            // Handle the image upload
    if ($request->hasFile('image')) {
        // Generate a unique filename using UUID and preserve the file extension
        $uuid = (string) Str::uuid();
        $extension = $request->file('image')->getClientOriginalExtension();
        $uniqueFileName = $uuid . '.' . $extension;

        // Store the image in the 'public' root
        $request->file('image')->storeAs('coin',  $uniqueFileName, 'public');
    }
    
        Wallet::create(array_merge($validated, ['image_path' =>  $uniqueFileName]));
    
        return redirect()->route('wallets.index')->with('success', 'Wallet added successfully.');
    }
    

    public function update(Request $request, Wallet $wallet)
    {
        $validated = $request->validate([
            'coin' => 'required|string|max:255',
            'address' => 'required|string',
            'network' => 'required|string',
            'min_amount' => 'required|numeric',
            'max_amount' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);
    
        if ($request->hasFile('image')) {
            $uuid = (string) Str::uuid();
            $extension = $request->file('image')->getClientOriginalExtension();
            $uniqueFileName = $uuid . '.' . $extension;
    
            // Store the image in the 'public' root
            $request->file('image')->storeAs('coin',  $uniqueFileName, 'public');
            $wallet->update(array_merge($validated, ['image_path' => $uniqueFileName]));
        } else {
            $wallet->update($validated);
        }
    
        return redirect()->route('wallets.index')->with('success', 'Wallet updated successfully.');
    }
    

    public function destroy($id)
    {
        $wallet = Wallet::findOrFail($id);
        $wallet->delete();

        return redirect()->route('wallets.index')->with('success', 'Wallet deleted successfully.');
    }

}
