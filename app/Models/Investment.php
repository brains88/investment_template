<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Investment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'plan_id',
        'status',
        'return_on_investment',
        'start_time', 
        'end_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function plan()
    {
        return $this->belongsTo(Plan::class);
    }

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];


    // Calculate ROI for the current investment
    public function calculateROI()
    {
        $plan = $this->plan;
        $duration = $plan->duration;  // Duration of the plan in days
        $interestRate = $plan->interest;  // Interest rate of the plan

        // Formula for ROI: Amount * (Interest Rate / 100) * Duration
        $roi = $this->amount * ($interestRate / 100) * $duration;

        return $roi;
    }
}
