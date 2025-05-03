<?php
namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log; // Add this import
use App\Models\{User, Balance};
use App\Mail\{WelcomeMail, BonusMail};
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
        ]);
    
        $verificationCode = random_int(100000, 999999);
    
        try {
            DB::beginTransaction();
    
            $user = User::create([
                'name' => $validatedData['fullname'],
                'email' => $validatedData['email'],
                'mobile' => $validatedData['mobile'],
                'username' => $validatedData['username'],
                'password' => Hash::make($validatedData['password']),
                'country' => $validatedData['country'],
                'image' => null,
                'verification_code' => $verificationCode,
            ]);
    
            Balance::create([
                'user_id' => $user->id,
                'balance' => 200.00,
                'interest' => 0.00,
            ]);
    
            // Send welcome email immediately
            Mail::to($user->email)->send(new WelcomeMail($user, $verificationCode));
    
            // Send bonus email immediately (remove ->later)
            Mail::to($user->email)->send(new BonusMail($user));
    
            DB::commit();
    
            return response()->json(['message' => 'Registration successful. Please check your email.']);
    
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error("Registration error: ".$e->getMessage());
            return response()->json(['message' => 'Registration failed.'], 500);
        }
    }

    public function handleReferral($username)
    {
        $referrer = User::where('username', $username)->first();

        if ($referrer) {
            session(['referrer' => $referrer->username]);
        }

        return redirect()->to('/register');
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