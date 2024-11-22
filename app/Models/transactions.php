<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class transactions extends Model
{
    //
    protected $fillable = [
        'transaction_id', // Unique transaction identifier
        'user_id',         // The user making the transaction
        'amount',          // The transaction amount
        'status',          // The transaction status (pending, completed, failed)
        'type',            // Type of transaction (transfer, withdrawal, investment)
        'withdrawal_id',   // Foreign key to the withdrawal table (nullable)
        'investment_id',   // Foreign key to the investment table (nullable)
        'transfer_id',     // Foreign key to the transfer table (nullable)
        'remark',          // Remarks for the transaction (optional)
    ];

    // Define relationship to the user (User model)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define relationship to the withdrawal (Withdrawal model)
    public function withdrawal()
    {
        return $this->belongsTo(Withdrawal::class);
    }

    // Define relationship to the investment (Investment model)
    public function investment()
    {
        return $this->belongsTo(Investment::class);
    }

    // Define relationship to the transfer (Transfer model)
    public function transfer()
    {
        return $this->belongsTo(Transfer::class);
    }

}
