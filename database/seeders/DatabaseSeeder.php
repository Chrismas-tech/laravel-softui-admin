<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Invoice;
use App\Models\User;
use App\Models\YoutubeVideo;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
        User::factory()->count(50)->create()->each(function ($user) {
            for ($i = 1; $i < random_int(1, 8); $i++) {
                Invoice::factory()->create([
                    'user_id' => $user->id,
                ]);
            }
        });

        // Admin
        User::factory()->create([
            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('secret'),
            'role' => 'admin'
        ]);

        //Youtube Videos
        YoutubeVideo::factory()->create([
            'name' => 'Livewire PowerGrid: Quick Datatable Package [REVIEW]',
            'iframe' => '<iframe width="560" height="315" src="https://www.youtube.com/embed/Qj0GLZJzDLY" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>'
        ]);
    }
}
