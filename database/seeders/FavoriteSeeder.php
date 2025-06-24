<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FavoriteSeeder extends Seeder
{
    public function run(): void
    {
        $students = User::whereHas('role', function($query) {
            $query->where('name', 'Mahasiswa');
        })->get();

        $approvedEvents = Event::where('status', 'approved')->get();

        foreach ($students as $student) {
            $randomEvents = $approvedEvents->random(rand(3, 7));
            
            foreach ($randomEvents as $event) {
                DB::table('favorites')->insert([
                    'user_id' => $student->id,
                    'event_id' => $event->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }

        $otherUsers = User::whereHas('role', function($query) {
            $query->whereIn('name', ['Admin', 'Pembuat Event']);
        })->get();

        foreach ($otherUsers as $user) {
            $randomEvents = $approvedEvents->random(rand(2, 5));
            
            foreach ($randomEvents as $event) {
                $exists = DB::table('favorites')
                    ->where('user_id', $user->id)
                    ->where('event_id', $event->id)
                    ->exists();
                
                if (!$exists) {
                    DB::table('favorites')->insert([
                        'user_id' => $user->id,
                        'event_id' => $event->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }
            }
        }
    }
}