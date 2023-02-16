<?php

use Illuminate\Database\Seeder;
use App\Models\Sponsor;

class SponsorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */

    protected $sponsors = [
        [
            'name' => 'Bronze',
            'duration' => 24,
            'price' => 2.99
        ],
        [
            'name' => 'Silver',
            'duration' => 48,
            'price' => 5.99
        ],
        [
            'name' => 'Gold',
            'duration' => 72,
            'price' => 9.99
        ]
    ];

    public function run()
    {

        foreach($this->sponsors as $sponsor) { Sponsor::create($sponsor); }

    }
}
