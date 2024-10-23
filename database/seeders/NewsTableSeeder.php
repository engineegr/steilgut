<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\News;
use App\Models\Category;

class NewsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aNewsCategory = Category::where('dict_name', 'NEWS_CATEGORY')->first();
        News::factory(11)->make()->each(function ($aNews) use ($aNewsCategory) {
            $aNewsCategory->news()->save($aNews);
        });
    }
}
