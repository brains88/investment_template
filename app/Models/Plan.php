<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'interest',
        'duration',
        'min_amount',
        'max_amount',
    ];

    public function investments()
    {
        return $this->hasMany(Investment::class);
    }
}
