<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Wine;
use App\Models\WineSet;
use Log;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        // Create only wine, but if we have any other products we will do it easily
        Wine::get()->each(function ($aWine) use ($faker) {
            $this->fillAndSaveProduct($aWine);
        });

        WineSet::get()->each(function ($aWineSet) use ($faker) {

            if ($aWineSet->title === 'STEILSET «3x4»') {
                $this->fillAndSaveSteilsetWineSetProduct($aWineSet);
            }

            if ($aWineSet->title === 'Probepaket') {
                $this->fillAndSaveProbepaketWineSetProduct($aWineSet);
            }

            if ($aWineSet->title === 'Das (knochen-)trockene Naslei-Paket') {
                $this->fillAndSaveNasleipaketWineSetProduct($aWineSet);
            }

        });
    }

    private function randomFloat($min = 0, $max = 1)
    {
        return $min + mt_rand() / mt_getrandmax() * ($max - $min);
    }

    private function fillAndSaveProduct($aWine)
    {
        $aProduct = $aWine->product()->make();
        $aProduct->total_in_stock = 10000;
        $aProduct->save();
        return $aProduct;
    }

    private function fillAndSaveSteilsetWineSetProduct($aWine)
    {
        $aProduct = $aWine->product()->make();
        $aProduct->total_in_stock = 10000;
        $aProduct->discount = 0.188;
        $aProduct->save();
        return $aProduct;
    }

    private function fillAndSaveProbepaketWineSetProduct($aWine)
    {
        $aProduct = $aWine->product()->make();
        $aProduct->total_in_stock = 10000;
        $aProduct->discount = 0;
        $aProduct->save();
        return $aProduct;
    }

    private function fillAndSaveNasleipaketWineSetProduct($aWine)
    {
        $aProduct = $aWine->product()->make();
        $aProduct->total_in_stock = 10000;
        $aProduct->discount = 0.07872;
        $aProduct->save();
        return $aProduct;
    }
}
