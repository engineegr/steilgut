<?php

namespace Database\Factories;

use App\Models\Wine;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Arr;

class WineFactory extends Factory
{


    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Wine::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $selectedWineImgPath = Arr::random(\App\Utilities\WinesHelper::$WINES_IMAGE_PATH_LIST);
        $selectedWineColor = Arr::random(\App\Utilities\WinesHelper::$WINE_COLORS);
        Log::info('Debug [WineFactory:definition] The image file path: ' . $selectedWineImgPath);
        return [
            'title' => $this->faker->city,
            'wineSort' => $this->faker->word,
            'harvest' => $this->faker->numberBetween(2000, 2018),
            'price' => $this->faker->numberBetween(50, 3000),
            'volume' => $this->faker->numberBetween(500, 1000),
            'wineType' => $this->faker->word,
            'soil' => $this->faker->word,
            'terroir' => $this->faker->word,
            'age' => $this->faker->numberBetween(1, 21),
            'residual_sugar' => round($this->faker->randomFloat(11.0, 11.0, 13.0), 1),
            'acidity' => round($this->faker->randomFloat(4.0, 4.0, 6.0), 2),
            'strength' => round($this->faker->randomFloat(7.0, 7.0, 13.0), 2),
            'area' => $this->faker->country,
            'color' => $selectedWineColor,
            'harvest_aspect' => $this->faker->text(),
            'taste' => $this->faker->text(),
            'image' => $selectedWineImgPath,
        ];
    }
}
