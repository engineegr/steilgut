<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categoryDictList = Category::$CATEGORY_DICT;
        foreach ($categoryDictList as $category) {
            Category::create([
                'dict_name' => $category['dict_name'],
                'name' => $category['name'],
                'url' => $category['url'],
            ]);
        }
    }
}
