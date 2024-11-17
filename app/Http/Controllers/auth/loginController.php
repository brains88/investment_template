<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        
        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            
            // Check if the user is unverified
            if ($user->status=== 'unverified') {
                Auth::logout();
                return response()->json([
                    'message' => 'Your account is not verified. Please activate your account.',
                    'redirect' => '/user-verification'
                ], 403);
            }
    
            // Get the user's role
            $role = $user->role;
    
            // Redirect based on the role
            if ($role === 'admin') {
                Auth::login($user);
                return response()->json([
                    'message' => 'Login successful',
                    'role' => $role,
                    'redirect' => '/admin'
                ], 200);
            } elseif ($role === 'user') {
                Auth::login($user);
                return response()->json([
                    'message' => 'Login successful',
                    'role' => $role,
                    'redirect' => '/dashboard'
                ], 200);
            } else {
                return response()->json([
                    'message' => 'Login successful',
                    'role' => $role,
                    'redirect' => '/'
                ], 200);
            }
        }
    
        return response()->json(['error' => 'Unauthorized'], 401);
    }
    
    
    
 // For Account Activation
public function activateAccount(Request $request)
{
    $request->validate([
        'verificationCode' => 'required|string',
    ]);

    // Find the user by activation code
    $user = User::where('verification_code', $request->verificationCode)->first();

    // If the activation code is invalid
    if (!$user) {
        return response()->json([
            'message' => 'Invalid Verification Code.',
        ], 401);
    }

    // If the user is already verified
    if ($user->status === 'verified') {
        return response()->json([
            'message' => 'Your account is already verified.',
            'redirect' => $user->role === 'admin' ? '/admin' : '/dashboard'
        ], 200);
    }

    // Activate the user's account
    $user->status = 'verified';
    $user->save();

    // Log in the user
    Auth::login($user);

    // Redirect based on the role
    $redirectUrl = $user->role === 'admin' ? '/admin' : '/dashboard';
    return response()->json([
        'message' => 'Account Verified successfully!',
        'redirect' => $redirectUrl
    ], 200);
}


    // Logout method
    public function logout(Request $request)
    {
        auth()->logout();
        request()->session()->flush();
        request()->session()->invalidate();
        return response()->json(['message' => 'Logout successful'], 200);
    }
}