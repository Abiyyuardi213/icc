<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Event;
use Carbon\Carbon;

class EventSeeder extends Seeder
{
    public function run(): void
    {
        $now = Carbon::now();
        
        Event::create([
            'name' => 'Basis Data',
            'slug' => 'basis-data',
            'description' => 'Kompetisi perancangan basis data.',
            'registration_start' => $now->copy()->subDays(10),
            'registration_end' => $now->copy()->addDays(20),
            'event_start' => $now->copy()->addDays(25),
            'event_end' => $now->copy()->addDays(26),
            'max_members' => 3,
            'is_active' => true,
        ]);

        Event::create([
            'name' => 'Pemrograman Terstruktur',
            'slug' => 'pemrograman-terstruktur',
            'description' => 'Kompetisi logic dan algoritma pemrograman.',
            'registration_start' => $now->copy()->subDays(10),
            'registration_end' => $now->copy()->addDays(20),
            'event_start' => $now->copy()->addDays(25),
            'event_end' => $now->copy()->addDays(26),
            'max_members' => 3,
            'is_active' => true,
        ]);
        
        // Roles seeding as well if needed
    }
}
