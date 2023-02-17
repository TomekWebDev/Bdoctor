<?php

use Illuminate\Database\Seeder;
use App\Models\Rating;

class RatingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ratings = [
            0,
            1,
            2,
            3,
            4,
            5
        ];

        foreach ($ratings as $elem) {

            $newratings = new Rating();
            $newratings->vote = $elem;
            $newratings->save();
        }
    }
}
