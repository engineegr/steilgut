<?php

namespace Database\Factories;

use App\Models\SteilgutHistory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Log;

class SteilgutHistoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SteilgutHistory::class;

    protected $yearDirList = null;

    function __construct(
        $count = null,
        ?Collection $states = null,
        ?Collection $has = null,
        ?Collection $for = null,
        ?Collection $afterMaking = null,
        ?Collection $afterCreating = null,
        $connection = null
    ) {
        parent::__construct($count, $states, $has, $for, $afterMaking, $afterCreating, $connection);
        $this->yearDirList = \App\Utilities\SteilgutHistoryHelper::$STEILGUT_HISTORY_FAKE_YEAR_LIST;
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $selectedYear = Arr::random($this->yearDirList);
        $selectedYearKeys = array_keys($this->yearDirList, $selectedYear);
        $this->yearDirList = array_diff($this->yearDirList, array($this->yearDirList[$selectedYearKeys[0]]));

        return [
            'title' => $this->faker->text(20),
            'year' => $selectedYear,

            // xs - min-width = 320px
            'xs_image' => '/images/faker/steilgutHistory/' . $selectedYear . '/xs/xs-bg-history.jpg',
            'xs_2x_image' => '/images/faker/steilgutHistory/' . $selectedYear . '/xs/xs-2x-bg-history.jpg',

            // sm - min-width = 640px
            'sm_image' => '/images/faker/steilgutHistory/' . $selectedYear . '/sm/sm-bg-history.jpg',
            'sm_2x_image' => '/images/faker/steilgutHistory/' . $selectedYear . '/sm/sm-2x-bg-history.jpg',

            // md - min-width = 768px
            'md_image' => '/images/faker/steilgutHistory/' . $selectedYear . '/md/md-bg-history.jpg',
            'md_2x_image' => '/images/faker/steilgutHistory/' . $selectedYear . '/md/md-2x-bg-history.jpg',

            // lg - min-width = 1024px
            'lg_image' => '/images/faker/steilgutHistory/' . $selectedYear . '/lg/lg-bg-history.jpg',
            'lg_2x_image' => '/images/faker/steilgutHistory/' . $selectedYear . '/lg/lg-2x-bg-history.jpg',

            // hd - min-width = 1280px
            'hd_image' => '/images/faker/steilgutHistory/' . $selectedYear . '/hd/hd-bg-history.jpg',
            'hd_2x_image' => '/images/faker/steilgutHistory/' . $selectedYear . '/hd/hd-2x-bg-history.jpg',

            'thread' => $this->faker->text(100),
        ];
    }
}
