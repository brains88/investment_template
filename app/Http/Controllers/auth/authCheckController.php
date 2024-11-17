<?php
namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User};
use Auth;
use Illuminate\Support\Facades\Log;
class AuthCheckController extends Controller
{
    public function verify(Request $request)
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // User is authenticated, retrieve the logged-in user's details
            $user = Auth::user();
    
            // Return the authenticated user's details as JSON response
            return response()->json([
                'authenticated' => true,
                'user' => $user
            ], 200);
        } else {
            // User is not authenticated
            return response()->json([
                'authenticated' => false,
                'user' => null
            ], 401);
        }
    }
    
    public function checkAdmin()
    {
        // Check if the authenticated user is an admin
        $isAdmin = auth()->check() && (auth()->user()->role === 'admin');
        
        return response()->json(['isAdmin' => $isAdmin]);
    }
    
    public function checkUser()
    {
        // Check if the authenticated user is a user
        $isuser = auth()->check() && auth()->user()->role === 'user';
        
        return response()->json(['isUser' => $isUser]);
    }
}