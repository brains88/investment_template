<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdrawal extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'transaction_number',
        'amount',
        'method',
        'wallet_address',
        'network',
        'coin_type',
        'bank_name',
        'bank_account_number',
        'routing_number',
        'address',
        'zelle_email',
        'paypal_email',
        'status',
        'transaction_proof',
        'feedback',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
}
