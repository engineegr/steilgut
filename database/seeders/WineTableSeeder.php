<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wine;
use Illuminate\Support\Arr;

class WineTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->createFinishData();
        // $this->createTestData();
    }

    private function createFinishData()
    {
        /*
        * Last changes: see letter 24.01.2022, Last corrections, 
        * see 25012022 Q_A_Current - 
        * Comments_160122_corr/ilya.likhobabin@gmail.com
        * 
        * Removed: Sudwand 2020
        * Added: Frauenberg 2018/2020
        */
        // $aSudwand2018 = Wine::make();
        // $this->cloneWines($aSudwand2018, \App\Utilities\WinesHelper::$SUDWAND_WINE_TYPE_2018);
        // $aSudwand2018->save();
        // $this->createSudwandBackgroundImage($aSudwand2018);

        // $aFrauenberg2018 = Wine::make();
        // $this->cloneWines($aFrauenberg2018, \App\Utilities\WinesHelper::$FRAUENBERG_WINE_TYPE_2018);
        // $aFrauenberg2018->save();
        // $this->createFrauenbergBackgroundImage($aFrauenberg2018);

        // $aSudwand2019 = Wine::make();
        // $this->cloneWines($aSudwand2019, \App\Utilities\WinesHelper::$SUDWAND_WINE_TYPE_2019);
        // $aSudwand2019->save();
        // $this->createSudwandBackgroundImage($aSudwand2019);

        $aSudwand2020 = Wine::make();
        $this->cloneWines($aSudwand2020, \App\Utilities\WinesHelper::$SUDWAND_WINE_TYPE_2020);
        $aSudwand2020->save();
        $this->createSudwandBackgroundImage($aSudwand2020);

        $aFrauenberg2020 = Wine::make();
        $this->cloneWines($aFrauenberg2020, \App\Utilities\WinesHelper::$FRAUENBERG_WINE_TYPE_2020);
        $aFrauenberg2020->save();
        $this->createFrauenbergBackgroundImage($aFrauenberg2020);

        $aNaslei2020 = Wine::make();
        $this->cloneWines($aNaslei2020, \App\Utilities\WinesHelper::$NASLEI_WINE_TYPE_2020);
        $aNaslei2020->save();
        $this->createNasleiBackgroundImage($aNaslei2020);
    }

    private function createTestData()
    {
        $harvestList = array();
        $i = 0;
        for ($y = 2016; $y < 2022; $y++) {
            $harvestList[$i++] = $y;
        }

        foreach (\App\Utilities\WinesHelper::$CATALOG_WINE_TITLE_LIST as $key => $value) {
            $aWineType = new \stdClass;
            switch ($key) {
                case 'SUDWAND':
                    $this->stdCloneWines(
                        $aWineType,
                        \App\Utilities\WinesHelper::$SUDWAND_WINE_TYPE_2018
                    );
                    break;

                case 'FRAUENBERG':
                    $this->stdCloneWines(
                        $aWineType,
                        \App\Utilities\WinesHelper::$FRAUENBERG_WINE_TYPE_2018
                    );
                    break;

                case 'FANAGORIA':
                    $this->stdCloneWines(
                        $aWineType,
                        \App\Utilities\WinesHelper::$FRAUENBERG_WINE_TYPE_2020
                    );
                    break;

                case 'ABRAMDUSO':
                    $this->stdCloneWines(
                        $aWineType,
                        \App\Utilities\WinesHelper::$FRAUENBERG_WINE_TYPE_2018
                    );
                    break;

                case 'ALMAVALLEY':
                    $this->stdCloneWines(
                        $aWineType,
                        \App\Utilities\WinesHelper::$SUDWAND_WINE_TYPE_2019
                    );
                    break;

                case 'MEZON':
                    $this->stdCloneWines(
                        $aWineType,
                        \App\Utilities\WinesHelper::$SUDWAND_WINE_TYPE_2020
                    );
                    break;
            }

            $aWineType->title = $key;
            $aWineType->RU->title = $key;
            $aWineType->DE->title = $key;
            $aWineType->zh_CN->title = $key;

            foreach ($harvestList as $i => $h) {
                $aWine = Wine::make();
                $this->cloneWines($aWine, $aWineType);
                $aWine->harvest = $h;
                $aWine->save();
                switch ($key) {
                    case 'SUDWAND':
                    case 'MEZON':
                    case 'FANAGORIA':
                        $this->createSudwandBackgroundImage($aWine);
                        break;

                    default:
                        $this->createFrauenbergBackgroundImage($aWine);
                        break;
                }
            }
        }
    }

    private function cloneWines($aWine, $WINE_TYPE)
    {
        foreach (get_object_vars($WINE_TYPE) as $key => $value) {
            if (in_array($key, Wine::getColumnListing('wines'))) {
                $aWine->$key = $value;
            }
        }

        $this->cloneWineTranslations(
            $aWine,
            $WINE_TYPE
        );
    }

    private function cloneWineSet($aWineSet, $WINE_TYPE)
    {
        foreach (get_object_vars($WINE_TYPE) as $key => $value) {
            if (in_array($key, WineSet::getColumnListing('wine_set'))) {
                $aWineSet->$key = $value;
            }
        }

        $this->cloneWineSetTranslations(
            $aWineSet,
            $WINE_TYPE
        );
    }

    private function stdCloneWines($aWine, $WINE_TYPE)
    {
        foreach (get_object_vars($WINE_TYPE) as $key => $value) {
            $aWine->$key = $value;
        }
        $aWine->title = $WINE_TYPE;
        $aWine->RU = new \stdClass;
        $aWine->DE = new \stdClass;
        $aWine->zh_CN = new \stdClass;
        foreach (get_object_vars($WINE_TYPE->RU) as $key => $value) {
            $aWine->RU->$key = $value;
		}

		foreach (get_object_vars($WINE_TYPE->DE) as $key => $value) {
            $aWine->DE->$key = $value;
		}

		foreach (get_object_vars($WINE_TYPE->zh_CN) as $key => $value) {
            $aWine->zh_CN->$key = $value;
		}
    }

    /*
     * Make translations.
     * $WINE_TYPE must have variables: 
     * $WINE_TYPE->RU
     * $WINE_TYPE->DE
     * $WINE_TYPE->zh_CN
     * 
    */
    private function cloneWineTranslations($aWine, $WINE_TYPE)
    {
        $aWine->title = [
            'en' => $WINE_TYPE->title,
            'ru' => $WINE_TYPE->RU->title,
            'de' => $WINE_TYPE->DE->title,
            'zh_CN' => $WINE_TYPE->zh_CN->title
        ];

        $aWine->wineType = [
            'en' => $WINE_TYPE->wineType,
            'ru' => $WINE_TYPE->RU->wineType,
            'de' => $WINE_TYPE->DE->wineType,
            'zh_CN' => $WINE_TYPE->zh_CN->wineType
        ];

        $aWine->color = [
            'en' => $WINE_TYPE->color,
            'ru' => $WINE_TYPE->RU->color,
            'de' => $WINE_TYPE->DE->color,
            'zh_CN' => $WINE_TYPE->zh_CN->color
        ];

        $aWine->wineSort = [
            'en' => $WINE_TYPE->wineSort,
            'ru' => $WINE_TYPE->RU->wineSort,
            'de' => $WINE_TYPE->DE->wineSort,
            'zh_CN' => $WINE_TYPE->zh_CN->wineSort
        ];

        $aWine->soil = [
            'en' => $WINE_TYPE->soil,
            'ru' => $WINE_TYPE->RU->soil,
            'de' => $WINE_TYPE->DE->soil,
            'zh_CN' => $WINE_TYPE->zh_CN->soil
        ];

        $aWine->terroir = [
            'en' => $WINE_TYPE->terroir,
            'ru' => $WINE_TYPE->RU->terroir,
            'de' => $WINE_TYPE->DE->terroir,
            'zh_CN' => $WINE_TYPE->zh_CN->terroir
        ];

        $aWine->harvest_aspect = [
            'en' => $WINE_TYPE->harvest_aspect,
            'ru' => $WINE_TYPE->RU->harvest_aspect,
            'de' => $WINE_TYPE->DE->harvest_aspect,
            'zh_CN' => $WINE_TYPE->zh_CN->harvest_aspect,
        ];

        $aWine->taste = [
            'en' => $WINE_TYPE->taste,
            'ru' => $WINE_TYPE->RU->taste,
            'de' => $WINE_TYPE->DE->taste,
            'zh_CN' => $WINE_TYPE->zh_CN->taste,
        ];
    }

    private function createSudwandBackgroundImage($aWine)
    {
        $subwand_background_image = $aWine->backgroundImage()->make();
        $subwand_background_image->relative_path = \App\Utilities\WinesHelper::$SUDWAND_WINE_TYPE_2018->background_image->relative_path;
        $subwand_background_image->base_name = \App\Utilities\WinesHelper::$SUDWAND_WINE_TYPE_2018->background_image->base_name;
        $subwand_background_image->save();
    }

    private function createFrauenbergBackgroundImage($aWine)
    {
        $frauenberg_background_image = $aWine->backgroundImage()->make();
        $frauenberg_background_image->relative_path = \App\Utilities\WinesHelper::$FRAUENBERG_WINE_TYPE_2018->background_image->relative_path;
        $frauenberg_background_image->base_name = \App\Utilities\WinesHelper::$FRAUENBERG_WINE_TYPE_2018->background_image->base_name;
        $frauenberg_background_image->save();
    }

    private function createNasleiBackgroundImage($aWine)
    {
        $subwand_background_image = $aWine->backgroundImage()->make();
        $subwand_background_image->relative_path = \App\Utilities\WinesHelper::$NASLEI_WINE_TYPE_2020->background_image->relative_path;
        $subwand_background_image->base_name = \App\Utilities\WinesHelper::$NASLEI_WINE_TYPE_2020->background_image->base_name;
        $subwand_background_image->save();
    }

}
