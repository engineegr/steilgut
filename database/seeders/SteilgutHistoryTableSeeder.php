<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SteilgutHistory;
use App\Models\Category;
use Log;

class SteilgutHistoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aSteilgutHistoryCategory = Category::where('dict_name', 'STEILGUT_HISTORY_CATEGORY')->first();
        foreach (\App\Utilities\SteilgutHistoryHelper::$STEILGUT_HISTORY_CONTENT_LIST as $yearContent) {
            $aYearContent = SteilgutHistory::make();
            
            $aYearContent->year = $yearContent->year;
            $aYearContent->title = [
                'en' => $yearContent->RU->title,
                'ru' => $yearContent->RU->title,
                'de' => $yearContent->DE->title,
                'zh_CN' => $yearContent->RU->title,
            ];

            $aYearContent->thread = [
                'en' => $yearContent->RU->thread,
                'ru' => $yearContent->RU->thread,
                'de' => $yearContent->DE->thread,
                'zh_CN' => $yearContent->RU->thread,
            ];

            $selectedYear = $yearContent->year;
            // xs - min-width = 320px, xs-2x - min-width = 640px
            $aYearContent->xs_image = '/images/faker/steilgutHistory/' . $selectedYear . '/xs/xs-bg-history.jpg';
            $aYearContent->xs_2x_image = '/images/faker/steilgutHistory/' . $selectedYear . '/xs/xs-2x-bg-history.jpg';

            // sm - min-width = 640px, sm-2x - min-width = 1280px
            $aYearContent->sm_image = '/images/faker/steilgutHistory/' . $selectedYear . '/sm/sm-bg-history.jpg';
            $aYearContent->sm_2x_image = '/images/faker/steilgutHistory/' . $selectedYear . '/sm/sm-2x-bg-history.jpg';

            // md - min-width = 768px, md-2x - min-width = 1536px
            $aYearContent->md_image = '/images/faker/steilgutHistory/' . $selectedYear . '/md/md-bg-history.jpg';
            $aYearContent->md_2x_image = '/images/faker/steilgutHistory/' . $selectedYear . '/md/md-2x-bg-history.jpg';

            // lg - min-width = 1024px, lg-2x - min-width = 2048px
            $aYearContent->lg_image = '/images/faker/steilgutHistory/' . $selectedYear . '/lg/lg-bg-history.jpg';
            $aYearContent->lg_2x_image = '/images/faker/steilgutHistory/' . $selectedYear . '/lg/lg-2x-bg-history.jpg';

            // hd - min-width = 1440px, hd-2x - min-width = 2880px
            $aYearContent->hd_image = '/images/faker/steilgutHistory/' . $selectedYear . '/hd/hd-bg-history.jpg';
            $aYearContent->hd_2x_image = '/images/faker/steilgutHistory/' . $selectedYear . '/hd/hd-2x-bg-history.jpg';

            // $aYearContent->save();
            $aSteilgutHistoryCategory->steilgutHistory()->save($aYearContent);
            // $aYearContent->category()->save($aSteilgutHistoryCategory);
        }
    }
}
