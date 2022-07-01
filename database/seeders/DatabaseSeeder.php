<?php

namespace Database\Seeders;

use App\Models\News;
use App\Models\User;
use App\Models\Event;
use App\Models\EventTheme;
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
        News::factory(10)->create();
        Event::factory(10)->create();
        EventTheme::factory(5)->create();
        User::factory(10)->create();
    }
}
