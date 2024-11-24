<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use App\Models\{User,Investment,Plan,Wallet,Deposit};
use App\Mail\WelcomeMail;
use Str;
use Auth;

class PlanController extends Controller
{
    //

    // Display a listing of the plans
    public function index()
    {
        $plans = Plan::paginate(10); // Show 10 plans per page
        return view('admin.plan', compact('plans'));
    }

    // Show the form to create a new plan
    public function create()
    {
        return view('admin.plans.create');
    }

    // Store a newly created plan in the database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'interest' => 'required|numeric|min:0',
            'duration' => 'required|numeric|min:1',
            'min_amount' => 'required|numeric|min:0',
            'max_amount' => 'required|numeric|min:0',
        ]);

        Plan::create([
            'name' => $request->name,
            'interest' => $request->interest,
            'duration' => $request->duration,
            'min_amount' => $request->min_amount,
            'max_amount' => $request->max_amount,
        ]);

        return redirect()->route('admin.plans')->with('success', 'Plan created successfully');
    }


    // Update the specified plan in the database
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'interest' => 'required|numeric|min:0',
            'duration' => 'required|numeric|min:1',
            'min_amount' => 'required|numeric|min:0',
            'max_amount' => 'required|numeric|min:0',
        ]);

        $plan = Plan::findOrFail($id);
        $plan->update([
            'name' => $request->name,
            'interest' => $request->interest,
            'duration' => $request->duration,
            'min_amount' => $request->min_amount,
            'max_amount' => $request->max_amount,
        ]);

        return redirect()->route('admin.plans')->with('success', 'Plan updated successfully');
    }

    // Remove the specified plan from the database
    public function destroy($id)
    {
        $plan = Plan::findOrFail($id);
        $plan->delete();

        return redirect()->route('admin.plans')->with('success', 'Plan deleted successfully');
    }
}
