<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Language;

class LanguageTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (Language::$LANGUAGE_DICT as $lang) {
            Language::create(['lang' => $lang]);
        }
    }
}
