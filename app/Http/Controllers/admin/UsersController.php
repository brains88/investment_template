<?php
namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;

use App\Models\Balance;

use App\Models\Deposit;

use App\Models\Investment;

use App\Models\Referral;

use App\Models\Transfer;
use App\Models\User;
use App\Models\Withdrawal;use Illuminate\Http\Request;use Illuminate\Support\Facades\DB;use Illuminate\Support\Facades\Hash;use Illuminate\Support\Facades\Mail;

class UsersController extends Controller
{

    public function index()
    {
                                                            // Fetch paginated users
        $users = User::where('role', 'user')->paginate(10); // Adjust the number to suit your needs

        return view('admin.users', compact('users'));
    }

    // AdminController.php
    public function viewUser($id)
    {
        $user = User::findOrFail($id);

        // Fetch related data, ensuring it's always an object or collection, even if empty
        $withdrawals = Withdrawal::where('user_id', $user->id)->paginate(6);
        $investments = Investment::where('user_id', $user->id)->paginate(6);
        $deposits    = Deposit::where('user_id', $user->id)->paginate(6);
        $referrals   = Referral::where('user_id', $user->id)->paginate(6);
        $transfers   = Transfer::where('sender_id', $user->id)->paginate(6);

        // Calculate the total amounts for each category
        $totalWithdrawalAmount = $withdrawals->sum('amount');
        $totalInvestmentAmount = $investments->sum('amount');
        $totalDepositAmount    = $deposits->sum('amount');
        $totalReferredUsers    = $referrals->count();

      foreach ($investments as $investment) {
                // Check if investment has a plan and start time
                if (!$investment->start_time || !$investment->plan || !$investment->plan->duration) {
                    continue;
                }

                // Convert duration to integer before using addWeeks()
                $durationWeeks = (int)$investment->plan->duration;
                
                // Calculate end time based on plan duration (in weeks)
                $endTime = $investment->start_time->copy()->addWeeks($durationWeeks);
                
                // If no explicit end_time in database, set it
                if (!$investment->end_time) {
                    $investment->end_time = $endTime;
                    $investment->save();
                }

                $totalDuration = $endTime->timestamp - $investment->start_time->timestamp;
                $elapsedTime = now()->timestamp - $investment->start_time->timestamp;

                if ($totalDuration <= 0) {
                    $investment->status = 'completed';
                    $investment->save();
                    continue;
                }

                // Calculate progress
                $investment->investPercentage = min(100, max(0, ($elapsedTime / $totalDuration) * 100));
                $investment->remainingTime = max(0, $endTime->timestamp - now()->timestamp);

                // Process interest if investment completed
                if ($investment->investPercentage >= 100 && $investment->status !== 'completed') {
                    $returnOnInvestment = $investment->amount * ($investment->return_on_investment / 10000);
                    Balance::where('user_id', $investment->user_id)->increment('interest', $returnOnInvestment);
                    
                    $investment->status = 'completed';
                    $investment->save();
                }
            }

        return view('admin.user-details', compact(
            'user',
            'totalDepositAmount',
            'totalReferredUsers',
            'totalInvestmentAmount',
            'totalWithdrawalAmount',
            'withdrawals',
            'investments',
            'deposits',
            'referrals',
            'transfers'
        ));
    }

    //Ban User Function
    public function banUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Assuming the 'ban' status is a boolean field
        $user->account = 'banned';
        $user->reason  = $request->ban_reason; // Assuming you save the reason
        $user->save();

        // Set flash message to display on success
        session()->flash('message', 'User has been banned successfully.');

        return redirect()->route('admin.users'); // Redirect back to the users list
    }

    //Unban User Function
    public function unbanUser($id)
    {
        $user          = User::findOrFail($id);
        $user->account = 'active';
        $user->reason  = null; // Optionally clear the ban reason
        $user->save();

        session()->flash('message', 'User has been unbanned successfully.');
        return redirect()->route('admin.users'); // Redirect back to the users list
    }

    //Delete User Function
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.users')->with('success', 'User has been deleted.');
    }

    public function sendEmail(Request $request, $id)
    {
        $request->validate([
            'email_subject' => 'required|string|max:255',
            'email_content' => 'required|string',
        ]);

        $user    = User::findOrFail($id);
        $logoUrl = "https://www.equitifytrades.com/assets/img/logo.png";

        // Build the email body
        $emailBody = "
        <div style='font-family: Arial, sans-serif;'>
            <div style='text-align: center; margin-bottom: 20px;'>
                <img src='{$logoUrl}' alt='Company Logo' style='max-width: 150px; height: auto;'>
            </div>
            <h3>Hello {$user->name},</h3>
            <div>
                " . nl2br(e($request->email_content)) . "
            </div>
        </div>
    ";

        try {
            Mail::send([], [], function ($message) use ($request, $user, $emailBody) {
                $message->to($user->email)
                    ->subject($request->email_subject)
                    ->html($emailBody);
            });

            return redirect()->back()->with('success', 'Email sent successfully to ' . $user->name);
        } catch (\Exception $e) {
            // Log the detailed error
            \Log::error('Email sending failed: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Failed to send email. Please try again.');
        }
    }
    /*
        //Send Mail to the user
        public function sendEmail(Request $request, $id)
        {
            $request->validate([
                'email_subject' => 'required|string|max:255',
                'email_content' => 'required|string',
            ]);

            $user = User::findOrFail($id);

            // Company logo URL
            $logoUrl = "https://www.equitifytrades.com/assets/img/logo.png";

            // Email content with the logo
            $emailBody = "
                <div style='font-family: Arial, sans-serif;'>
                    <div style='text-align: center; margin-bottom: 20px;'>
                        <img src='{$logoUrl}' alt='Company Logo' style='max-width: 150px; height: auto;'>
                    </div>
                    <h3>Hello {$user->name},</h3>
                    <div>
                        {$request->email_content}
                    </div>
                </div>
            ";

            try {
                Mail::send([], [], function ($message) use ($request, $user, $emailBody) {
                    $message->to($user->email)
                        ->subject($request->email_subject)
                        ->html($emailBody);
                });

                return redirect()->back()->with('success', 'Email sent successfully to ' . $user->name);
            } catch (\Exception $e) {
                return redirect()->back()->with('error', 'Failed to send email. Please try again.');
            }
        }

      */

}
