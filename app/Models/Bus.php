<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Schedule;

class Bus extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'plate_number',
        'class_type',
        'seat_capacity',
        'facilities',
        'status',
    ];

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class);
    }
}