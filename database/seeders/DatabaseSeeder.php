<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Admin;
use App\Models\Bus;
use App\Models\Schedule;
use App\Models\TravelRoute;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Admin::updateOrCreate(
            ['email' => 'admin@haryanto.test'],
            [
                'name' => 'Admin PO Haryanto',
                'password' => Hash::make('password'),
            ]
        );

        User::updateOrCreate(
            ['email' => 'user@haryanto.test'],
            [
                'name' => 'User Demo',
                'password' => Hash::make('password'),
            ]
        );

        $routes = collect([
            ['origin' => 'Surabaya', 'destination' => 'Denpasar', 'transit_points' => 'Semarang, Demak, Kudus', 'description' => 'Rute utama Surabaya ke Denpasar.'],
            ['origin' => 'Surabaya', 'destination' => 'Banyuwangi', 'transit_points' => 'Probolinggo, Pasuruan', 'description' => 'Rute timur menuju pelabuhan.'],
            ['origin' => 'Surabaya', 'destination' => 'Probolinggo', 'transit_points' => 'Pasuruan', 'description' => 'Rute pendek harian.'],
            ['origin' => 'Surabaya', 'destination' => 'Pasuruan', 'transit_points' => 'Sidoarjo', 'description' => 'Rute cepat antar kota.'],
        ])->map(function (array $routeData) {
            return TravelRoute::updateOrCreate(
                ['origin' => $routeData['origin'], 'destination' => $routeData['destination']],
                $routeData + ['active' => true]
            );
        });

        $buses = collect([
            ['name' => 'PO Haryanto Executive 1', 'plate_number' => 'S 7019 UH', 'class_type' => 'Executive', 'seat_capacity' => 30, 'facilities' => 'AC, reclining seat, charger, WiFi', 'status' => 'active'],
            ['name' => 'PO Haryanto Luxury 2', 'plate_number' => 'S 7020 UH', 'class_type' => 'Luxury', 'seat_capacity' => 28, 'facilities' => 'AC, toilet, charger, WiFi', 'status' => 'active'],
        ])->map(function (array $busData) {
            return Bus::updateOrCreate(
                ['plate_number' => $busData['plate_number']],
                $busData
            );
        });

        Schedule::firstOrCreate(
            ['bus_id' => $buses[0]->id, 'route_id' => $routes[0]->id, 'departure_date' => now()->addDays(1)->toDateString(), 'departure_time' => '18:00'],
            ['arrival_time' => '08:00', 'price' => 350000, 'seat_count' => 30, 'status' => 'active']
        );

        Schedule::firstOrCreate(
            ['bus_id' => $buses[1]->id, 'route_id' => $routes[1]->id, 'departure_date' => now()->addDays(2)->toDateString(), 'departure_time' => '19:00'],
            ['arrival_time' => '06:30', 'price' => 280000, 'seat_count' => 28, 'status' => 'active']
        );
    }
}
