<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(WineTableSeeder::class);
        $this->call(WineSetTableSeeder::class);
        $this->call(UserRoleTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(CategoryTableSeeder::class);
        // $this->call(NewsTableSeeder::class);
        $this->call(CurrencyTableSeeder::class);
        $this->call(SteilgutHistoryTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(AddressTableSeeder::class);
        $this->call(PeopleTableSeeder::class);
        $this->call(PaymentPlatformTableSeeder::class);
        $this->call(OrderStateTableSeeder::class);
        $this->call(DeliveryOptionTableSeeder::class);
        $this->call(OrderTableSeeder::class);
        $this->call(OrderRemoveTableSeeder::class);
        $this->call(LanguageTableSeeder::class);
    }
}
