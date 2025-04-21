<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Event;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // one admin
        User::factory()->create([
            'email'    => 'admin@example.com',
            'role'     => 'admin',
            'password' => bcrypt('password'),
        ]);

        // 3 organizers with 3 approved events each
        User::factory(3)->create(['role'=>'organizer'])->each(function($u){
            Event::factory(3)->create([
                'organizer_id' => $u->id,
                'status'       => 'approved'
            ]);
        });

        // 10 visitors
        User::factory(10)->create(['role'=>'visitor']);
    }
}