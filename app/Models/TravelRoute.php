<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Schedule;

class TravelRoute extends Model
{
    use HasFactory;

    protected $table = 'routes';

    protected $fillable = [
        'origin',
        'destination',
        'transit_points',
        'description',
        'active',
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function schedules(): HasMany
    {
        return $this->hasMany(Schedule::class, 'route_id');
    }
}