<?php
namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    public function login(Request $request)
    {
        // Validate the input fields and captcha token
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Check credentials
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            // Check if the user is unverified
            if ($user->status === 'unverified') {
                Auth::logout();
                return response()->json([
                    'message' => 'Your account is not verified. Please activate your account.',
                    'redirect' => '/user-verification',
                ], 403);
            }

            // Redirect based on the user's role
            if ($user->role === 'admin') {
                return response()->json([
                    'message' => 'Login successful',
                    'redirect' => route('admin.dashboard'),
                ]);
            } elseif ($user->role === 'user') {
                return response()->json([
                    'message' => 'Login successful',
                    'redirect' => route('user.dashboard'),
                ]);
            }

            Auth::logout();
            return response()->json(['message' => 'Unauthorized role.']);
        }

        return response()->json(['message' => 'Invalid email or password.'], 401);
    }

// For Account Activation
    public function activateAccount(Request $request)
    {
        $request->validate([
            'verificationCode' => 'required|string',
        ]);

        // Find the user by activation code
        $user = User::where('verification_code', $request->verificationCode)->first();

        // Handle invalid verification code
        if (!$user) {
            return redirect()->back()->withErrors([
                'error' => 'Invalid Verification Code.',
            ]);
        }

        // Check if the user is already verified
        if ($user->status === 'verified') {
            // Redirect based on the user's role
            if ($user->role === 'admin') {
                return response()->json([
                    'message' => 'Login successful',
                    'redirect' => route('admin.dashboard'), // Return Laravel route to redirect to
                ]);
            } elseif ($user->role === 'user') {
                return response()->json([
                    'message' => 'Login successful',
                    'redirect' => route('user.dashboard'), // Return Laravel route to redirect to
                ]);
            }
        }

        // Update user's status to verified
        $user->update([
            'status' => 'verified',
        ]);

        // Log in the user
        Auth::login($user);

        // Redirect based on the user's role
        if ($user->role === 'admin') {
            return response()->json([
                'message' => 'Login successful',
                'redirect' => route('admin.dashboard'), // Return Laravel route to redirect to
            ]);
        } elseif ($user->role === 'user') {

            if ($user->account === 'banned') {
                return response()->json([
                    'message' => 'Sorry, You can has been Banned. Send mail or use the Chat support',
                ]);
            }
            return response()->json([
                'message' => 'Login successful',
                'redirect' => route('user.dashboard'), // Return Laravel route to redirect to
            ]);
        }
    }

    // Logout method
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // Revoke tokens if using API tokens (optional)
        if (Auth::check() && Auth::user()->tokens()->exists()) {
            Auth::user()->tokens()->delete();
        }

        return response()->json(['message' => 'Logged out successfully'], 200);
    }

}
