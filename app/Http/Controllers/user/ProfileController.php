<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\{User,investment,plan,wallet,Deposit,Referral};
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProfileController extends Controller
{
    //

    public function index()
    {
        $userData = auth()->user();
    
        return view('user.profile', compact('userData'));
    }

    public function updateImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);
    
        $user = auth()->user();
    
        // If user has a previous profile image, delete it
        if ($user->image && Storage::disk('public')->exists('profile/' . $user->image)) {
            Storage::disk('public')->delete('profile/' . $user->image);
        }
    
        // Create unique filename: profile_time_uuid.extension
        $extension = $request->file('image')->getClientOriginalExtension();
        $fileName = 'profile_' . time() . '_' . Str::uuid() . '.' . $extension;
    
        // Store in storage/app/public/profile
        $request->file('image')->storeAs('profile', $fileName, 'public');
    
        // Save only filename in DB
        $user->image = $fileName;
        $user->save();
    
        return response()->json(['message' => 'Profile image updated successfully.']);
    }
        public function updateInfo(Request $request)
        {
            $request->validate(['firstname' => 'required|string|max:255', 'username' => 'required|string|max:255']);
            $user = auth()->user();
            $user->name = $request->firstname;
            $user->username = $request->username;
            $user->address = $request->address;
            $user->save();
            return response()->json(['message' => 'Profile information updated successfully.']);
        }

        public function updatePassword(Request $request)
        {
            $request->validate([
                'current_password' => 'required',
                'password' => 'required|confirmed|min:8',
            ]);

            $user = auth()->user();
            if (!Hash::check($request->current_password, $user->password)) {
                return response()->json(['message' => 'Current password is incorrect.'], 400);
            }

            $user->password = Hash::make($request->password);
            $user->save();

            return response()->json(['message' => 'Password updated successfully.']);
        }
       
        
        public function submitIdentity(Request $request)
        {
            $request->validate([
                'identity_type' => 'required|string|max:255',
                'identity_file' => 'required|file|mimes:jpeg,png,pdf|max:2048',
            ]);
        
            $user = auth()->user();
        
            // If user has previous image, delete it from storage/app/public/identity
            if ($user->identity_image && Storage::disk('public')->exists('identity/' . $user->identity_image)) {
                Storage::disk('public')->delete('identity/' . $user->identity_image);
            }
        
            // Create unique filename: identity_time_uuid.extension
            $extension = $request->file('identity_file')->getClientOriginalExtension();
            $fileName = 'identity_' . time() . '_' . Str::uuid() . '.' . $extension;
        
            // Store in storage/app/public/identity
            $request->file('identity_file')->storeAs('identity', $fileName, 'public');
        
            // Save only filename in DB
            $user->identity_type  = $request->identity_type;
            $user->identity_image = $fileName;
            $user->save();
        
            return response()->json(['message' => 'Identity verification submitted successfully.']);
        }
        
        public function submitAddress(Request $request)
        {
            $request->validate([
                'addressProof' => 'required|file|mimes:jpeg,png,pdf|max:2048',
            ]);
        
            $user = auth()->user();
        
            // If user has previous address image, delete it
            if ($user->address_image && Storage::disk('public')->exists('address/' . $user->address_image)) {
                Storage::disk('public')->delete('address/' . $user->address_image);
            }
        
            // Create unique filename: address_time_uuid.extension
            $extension = $request->file('addressProof')->getClientOriginalExtension();
            $fileName = 'address_' . time() . '_' . Str::uuid() . '.' . $extension;
        
            // Store in storage/app/public/address
            $request->file('addressProof')->storeAs('address', $fileName, 'public');
        
            // Save only filename in DB
            $user->proof_of_address = $fileName;
            $user->save();
        
            return response()->json(['message' => 'Address verification submitted successfully.']);
        }
}
