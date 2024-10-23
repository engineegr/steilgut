<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Person;
use App\Models\Address;
use App\Models\PersonalData;
use App\Models\Phone;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        //
        Person::factory(10)->create()->each(function ($aPerson) use ($faker) {
            $ph = Phone::make([
                'phone_number' => $faker->phoneNumber
            ]);
            $aPerson->phones()->save($ph);

            $pd = PersonalData::make([
                'lfp' => $faker->firstName($gender = 'female') . " " . $faker->lastName,
            ]);
            $aPerson->personalData()->save($pd);
        });
    }
}
