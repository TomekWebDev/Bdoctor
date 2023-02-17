<?php

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
        $this->call(SpecializationsSeeder::class);
        $this->call(RatingsSeeder::class);
        $this->call(SponsorsSeeder::class);
    }
}
