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
    ]);

    $verificationCode = random_int(100000, 999999);

    try {
        \DB::beginTransaction();

        $user = User::create([
            'name' => $validatedData['fullname'],
            'email' => $validatedData['email'],
            'mobile' => $validatedData['mobile'],
            'username' => $validatedData['username'],
            'password' => Hash::make($validatedData['password']),
            'country' => $validatedData['country'],
            'image' => null, // Set the image field to null
            'verification_code' => $verificationCode,
            
        ]);

        // Send the welcome email
        Mail::to($user->email)->send(new WelcomeMail($user, $verificationCode));

        \DB::commit();

        return response()->json(['message' => 'Registration successful. Please check your email for the activation code.']);
    } catch (\Exception $e) {
        \DB::rollback();

        Log::error("Registration error: ", [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ]);

        return response()->json([
            'message' => 'Registration failed due to a server error.',
        ], 500);
    }
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