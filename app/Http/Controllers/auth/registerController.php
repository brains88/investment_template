<?php
namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Mail\WelcomeMail;
use Str;

class RegisterController extends Controller
{
    public function register(Request $request) 
    {
        $validatedData = $request->validate([
            'fullname' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|max:255|unique:users,username',
            'password' => 'required|string|min:8|confirmed',
            'country' => 'required|string|max:255',
            'mobile' => 'required|regex:/^\+?\d{8,15}$/|unique:users,mobile',
            'profileImage' => 'required|image|max:2048',
        ]);
    
        // Generate a six-digit verification code
        $verificationCode = random_int(100000, 999999);
    
        // Handle profile image upload if it exists
        if ($request->hasFile('profileImage')) {
            $userImage = $request->file('profileImage');
            $imagename = Str::uuid() . '.' . $userImage->getClientOriginalExtension();
            $validatedData['profileImage'] = $imagename;
        }
    
        // Create the user and set the verification code
        $user = User::create([
            'name' => $validatedData['fullname'],
            'email' => $validatedData['email'],
            'mobile' => $validatedData['mobile'],
            'username' => $validatedData['username'],
            'password' => Hash::make($validatedData['password']),
            'country' => $validatedData['country'],
            'image' => $validatedData['profileImage'],
            'verification_code' => $verificationCode, // Save verification code
        ]);
    
        //Store Image in the public folder
         $userImage->storeAs('profile_images', $imagename, 'public');
        // Send welcome email with the verification code
        Mail::to($user->email)->send(new WelcomeMail($user, $verificationCode));
    

        if (session()->has('referrer')) {
            $referrer = User::where('username', session()->pull('referrer'))->first();
    
            if ($referrer) {
                // Log the referral (e.g., store in a `referrals` table or update referrer count)
                $referrer->referrals()->create(['referred_user_id' => $user->id]);
            }
        }
        return response()->json(['message' => 'User registered successfully. A verification code has been sent to your email.'], 201);
    }


    public function handleReferral($username)
    {
        // Check if the referrer exists
        $referrer = User::where('username', $username)->first();

        if ($referrer) {
            // Store the referrer's username in session
            session(['referrer' => $referrer->username]);
        }

        // Redirect to the Vue.js registration route
        return redirect()->to('/register'); // Adjust if the Vue registration route is different
    }
}


/*
    //login logic code
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            // Check if user is verified
            if (!$user->verified) {
                return response()->json(['redirect' => '/verify-user'], 403);
            }

            // Redirect based on role
            return response()->json(['redirect' => $user->role === 'user' ? '/dashboard' : '/admin']);
        }

        return response()->json(['error' => 'Invalid credentials'], 401);
    }

    public function passwordReset(Request $request)
    {
        $request->validate(['email' => 'required|string|email']);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            $user->notify(new PasswordResetNotification());
            return response()->json(['message' => 'Password reset link sent to your email.']);
        }

        return response()->json(['error' => 'Email not found'], 404);
    }

*/