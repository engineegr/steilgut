<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\WineSet;
use App\Models\Tooltip;

class WineSetTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $aSTEILSET = WineSet::make();
        $this->cloneWineSet(
            $aSTEILSET,
            \App\Utilities\WinesHelper::$STEILSET_WINE_TYPE
        );
        $this->cloneWineSetTranslations(
            $aSTEILSET,
            \App\Utilities\WinesHelper::$STEILSET_WINE_TYPE
        );
        $aSTEILSET->save();
        $this->createSteilsetTooltip($aSTEILSET);

        $aPROBEPAKET = WineSet::make();
        $this->cloneWineSet(
            $aPROBEPAKET,
            \App\Utilities\WinesHelper::$PROBEPAKET_WINE_TYPE
        );
        $this->cloneWineSetTranslations(
            $aPROBEPAKET,
            \App\Utilities\WinesHelper::$PROBEPAKET_WINE_TYPE
        );
        $aPROBEPAKET->save();
        $this->createProbepaketTooltip($aPROBEPAKET);

        $aNASLEIPAKET = WineSet::make();
        $this->cloneWineSet(
            $aNASLEIPAKET,
            \App\Utilities\WinesHelper::$NASLEIPAKET_WINE_TYPE
        );
        $this->cloneWineSetTranslations(
            $aNASLEIPAKET,
            \App\Utilities\WinesHelper::$NASLEIPAKET_WINE_TYPE
        );
        $aNASLEIPAKET->save();
        $this->createNasleipaketTooltip($aNASLEIPAKET);
    }


    /*
     * Make translations.
     * $WINE_TYPE must have variables: 
     * $WINE_TYPE->RU
     * $WINE_TYPE->DE
     * $WINE_TYPE->zh_CN
     * 
    */
    private function cloneWineSetTranslations($aWineSet, $WINE_TYPE)
    {
        $aWineSet->title = [
            'en' => $WINE_TYPE->title,
            'ru' => $WINE_TYPE->RU->title,
            'de' => $WINE_TYPE->DE->title,
            'zh_CN' => $WINE_TYPE->zh_CN->title
        ];

        $aWineSet->terroir = [
            'en' => $WINE_TYPE->terroir,
            'ru' => $WINE_TYPE->RU->terroir,
            'de' => $WINE_TYPE->DE->terroir,
            'zh_CN' => $WINE_TYPE->zh_CN->terroir
        ];
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

    private function createSteilsetTooltip($aWineSet) 
    {
        $wineSetTooltip = [
            'announcement' => [
                'en' => '12er- Steilset; Enthält jeweils drei Flaschen unserer vier Weine mit 15 % Rabatt und versandkostenfrei!',
                'ru' => 'Дегустационный сет из четырёх разных вин по три бутылки каждого. Скидка 15% и доставка бесплатно!',
                'de' => '12er- Steilset; Enthält jeweils drei Flaschen unserer vier Weine mit 15 % Rabatt und versandkostenfrei!',
                'zh_CN' => '12er- Steilset; Enthält jeweils drei Flaschen unserer vier Weine mit 15 % Rabatt und versandkostenfrei!',
            ],
            'image' => '/images/icons/store-pg/tip@2x.svg'
        ];
        $aWineSet->tooltip()->create($wineSetTooltip);
    }

    private function createProbepaketTooltip($aWineSet) 
    {
        $wineSetTooltip = [
            'announcement' => [
                'en' => '6er-Probepaket. Enthält jeweils eine Flasche unserer sechs Weine.',
                'ru' => 'Дегустационный сет из шести разных вин. Попробуйте каждое!',
                'de' => '6er-Probepaket. Enthält jeweils eine Flasche unserer sechs Weine.',
                'zh_CN' => '6er-Probepaket. Enthält jeweils eine Flasche unserer sechs Weine.',
            ],
            'image' => '/images/icons/store-pg/tip@2x.svg'
        ];
        $aWineSet->tooltip()->create($wineSetTooltip);
    }

    private function createNasleipaketTooltip($aWineSet) 
    {
        $wineSetTooltip = [
            'announcement' => [
                'en' => '6er-Paket; 3 Fl. 2021 Bremmer Calmont Naslei 3 Fl. 2020 Bremmer Calmont Naslei.',
                'ru' => 'Cет из полностью сухих вин.',
                'de' => '6er-Paket; 3 Fl. 2021 Bremmer Calmont Naslei 3 Fl. 2020 Bremmer Calmont Naslei.',
                'zh_CN' => '6er-Paket; 3 Fl. 2021 Bremmer Calmont Naslei 3 Fl. 2020 Bremmer Calmont Naslei.',
            ],
            'image' => '/images/icons/store-pg/tip@2x.svg'
        ];
        $aWineSet->tooltip()->create($wineSetTooltip);
    }
}
