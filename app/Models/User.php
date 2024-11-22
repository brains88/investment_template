<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'username',
        'password',
        'mobile',
        'image',
        'country',
        'role',
        'verification_code',
        'status',
        'account',
        'reason',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'password' => 'hashed',
    ];

    public function wallet()
    {
        return $this->hasOne(Wallet::class);
    }

    public function deposit()
    {
        return $this->hasMany(Deposit::class);
    }

    public function withdrawal()
    {
        return $this->hasMany(Withdrawal::class);
    }

    public function investment()
    {
        return $this->hasMany(Investment::class);
    }

    public function referrals()
    {
        return $this->hasMany(Referral::class);
    }
    
    public function balance()
    {
        return $this->hasOne(Balance::class);
    }

    public function sentTransfers()
    {
        return $this->hasMany(Transfer::class, 'sender_id');
    }

    public function receivedTransfers()
    {
        return $this->hasMany(Transfer::class, 'receiver_id');
    }

    // Custom accessor to generate the referral link
    public function getReferralLinkAttribute()
{
    $baseUrl = env('APP_URL'); // Get the base URL from the .env file
    return "{$baseUrl}/referral/{$this->username}"; // Generate the referral link based on the username
}

}
