<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;

    protected $fillable = [
        'sender_id',
        'receiver_id',
        'amount',
        'status',
    ];


        // Define relationship to the sender (User model)
        public function sender()
        {
            return $this->belongsTo(User::class, 'sender_id');
        }
    
        // Define relationship to the receiver (User model)
        public function receiver()
        {
            return $this->belongsTo(User::class, 'receiver_id');
        }

        
    
}
