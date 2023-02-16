<?php

use Illuminate\Database\Seeder;
use App\Models\Spec;

class SpecializationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $specialitazions = config('seeder.specialitazions');

        foreach ($specialitazions as $elem) {

            $newSpecialization = new Spec();
            $newSpecialization-> name = $elem['name'];
            $newSpecialization-> save();
        }
    }
}
