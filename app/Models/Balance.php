<?php

namespace App\Models;

// app/Models/Balance.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Balance extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'balance','interest'];

    // Relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
