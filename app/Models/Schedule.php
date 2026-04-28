<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

use App\Models\Booking;
use App\Models\Bus;
use App\Models\Seat;
use App\Models\TravelRoute;

class Schedule extends Model
{
    use HasFactory;

    protected $fillable = [
        'bus_id',
        'route_id',
        'departure_date',
        'departure_time',
        'arrival_time',
        'price',
        'seat_count',
        'status',
    ];

    protected $casts = [
        'departure_date' => 'date',
        'price' => 'integer',
        'seat_count' => 'integer',
    ];

    protected static function booted(): void
    {
        static::created(function (Schedule $schedule): void {
            $schedule->generateSeats();
        });
    }

    public function bus(): BelongsTo
    {
        return $this->belongsTo(Bus::class);
    }

    public function route(): BelongsTo
    {
        return $this->belongsTo(TravelRoute::class, 'route_id');
    }

    public function seats(): HasMany
    {
        return $this->hasMany(Seat::class);
    }

    public function bookings(): HasMany
    {
        return $this->hasMany(Booking::class);
    }

    public function generateSeats(): void
    {
        $totalSeats = $this->seat_count ?: 30;

        for ($seatNumber = 1; $seatNumber <= $totalSeats; $seatNumber++) {
            $this->seats()->create([
                'seat_number' => str_pad((string) $seatNumber, 2, '0', STR_PAD_LEFT),
                'status' => 'available',
            ]);
        }
    }
}