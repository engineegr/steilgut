<?php

namespace Database\Factories;

use App\Models\News;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Log;
use Faker;

class NewsFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = News::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        gc_collect_cycles();
        $selectedImage = Arr::random($this->getNewsImageTitles('public/images/faker/news'));

        //
        // Create Locale Fakers (see https://github.com/fzaninotto/Faker#localization)
        //
        $enFaker = Faker\Factory::create('en_US');
        $ruFaker = Faker\Factory::create('ru_RU');
        $deFaker = Faker\Factory::create('de_DE');
        $cnFaker = Faker\Factory::create('zh_CN');

        return [
            'title' => [
                'en' => $enFaker->realText($maxNbChars = 11),
                'ru' => $ruFaker->realText($maxNbChars = 11),
                'de' => $deFaker->realText($maxNbChars = 11),
                'zh_CN' => $cnFaker->realText($maxNbChars = 11),
            ],
            'posting_date' => $this->faker->dateTimeBetween(
                '-1 years',
                'now',
                'Asia/Sakhalin'
            ),
            'image' => '/images/faker/news/' . $selectedImage,
            'thread' => [
                'en' => $enFaker->realText($maxNbChars = 133),
                'ru' => $ruFaker->realText($maxNbChars = 133),
                'de' => $deFaker->realText($maxNbChars = 133),
                'zh_CN' => $cnFaker->realText($maxNbChars = 133),
            ],
        ];
    }

    private function getNewsImageTitles($rootDir)
    {
        return array_diff(scandir($rootDir), array('.', '..', '.DS_Store'));
    }
}
