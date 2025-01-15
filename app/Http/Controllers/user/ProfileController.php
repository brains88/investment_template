<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\{User,investment,plan,wallet,Deposit,Referral};
use Str;
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
    
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            if ($user->image) {
                $oldImagePath = public_path('storage/profile_images/' . $user->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
    
            // Save the new image
            $request->image->storeAs('profile_images', $request->image, 'public');
            $user->image = $request->image;
            $user->save();
    
            return response()->json(['message' => 'Profile image updated successfully.']);
        }
    
        return response()->json(['message' => 'Image upload failed.'], 500);
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
    $request->validate(['identity_type' => 'required', 'identity_file' => 'required|file|mimes:jpeg,png,pdf']);
    $fileName = time() . '.' . $request->identity_file->extension();
    $request->identity_file->storeAs('identity_verifications', $fileName, 'public');
    // Save identity verification record
    return response()->json(['message' => 'Identity verification submitted successfully.']);
}

public function submitAddress(Request $request)
{
    $request->validate(['addressProof' => 'required|file|mimes:jpeg,png,pdf']);
    $fileName = time() . '.' . $request->addressProof->extension();
    $request->addressProof->storeAs('address_verifications', $fileName, 'public');
    // Save address verification record
    return response()->json(['message' => 'Address verification submitted successfully.']);
}

}
