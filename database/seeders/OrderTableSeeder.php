<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\OrderData;
use App\Models\Address;
use App\Models\Person;
use App\Models\Phone;
use App\Models\PersonalData;
use App\Models\State;
use App\Models\DeliveryOption;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        try {
            DB::beginTransaction();
            $cart = array();
            $faker = \Faker\Factory::create();

            // create a Person with PersonData
            $p = Person::create([
                'email' => 'drw@google.com',
                'email_verified_at' => $faker->dateTimeBetween('-1 years', 'now'),
            ]);

            // couldn't save personal data without Person: PersonalData is a child of Person
            $pd = PersonalData::make([
                'lfp' => $faker->firstName($gender = 'female') . " " . $faker->lastName,
            ]);
            $p->personalData()->save($pd);

            $ph = Phone::make([
                'phone_number' => '8(962)660000',
            ]);

            $p->phones()->save($ph);

            $productToCartList = Product::whereIn('id', [1, 2, 3, 4, 5, 6, 7, 8, 9, 10])->get();

            // use &$cart for arrys unless the array doesn't change value
            $productToCartList->each(function ($aProduct) use (&$cart, $faker) {
                $cart[$aProduct->id] = $faker->numberBetween(1, $aProduct->total_in_stock);
            });

            $deliveryAddress = Address::create(['google_place_id' => Str::uuid(), 'country' => 'Ukraine', 'city' => 'Odessa', 'full_path' => 'Гаванная улица, Odesa, Odessa Oblast, Ukraine']);

            // Create our order data and bind it with the person and status
            $orderData = OrderData::make();
            $openStatus = State::orderOpenStatus();

            $deliveryOptionDictStr = Arr::random(DeliveryOption::$DELIVERY_OPTION_DICT);
            $selectedDeliveryOption = NULL;

            switch ($deliveryOptionDictStr) {
                case DeliveryOption::$DELIVERY_OPTION_DICT[0]: /* Self-delivery */
                    $selectedDeliveryOption = DeliveryOption::selfDeliveryOption();
                    break;
                case DeliveryOption::$DELIVERY_OPTION_DICT[1]: /* Post-delivery */
                    $selectedDeliveryOption = DeliveryOption::postDeliveryOption();
                    break;
                case DeliveryOption::$DELIVERY_OPTION_DICT[2]: /* Post-delivery */
                    $selectedDeliveryOption = DeliveryOption::courierDeliveryOption();
                    break;
                default:
                    throw new \InvalidArgumentException("[OrderTableSeeder] Uknown DeliveryOption dictionary string");
                    break;
            }
            $orderData->deliveryOption()->associate($selectedDeliveryOption);
            $orderData->state()->associate($openStatus); // don't save for awhile (Order data has constraint on Person and State tables) otherwise it falls with Exception

            // Connect our order to the delivery address
            $orderData->address()->associate($deliveryAddress);
            $orderData->subtotal_price = 0.0;
            $orderData->delivery_price = 0.0;

            // Save our orderData and connect it to our Person
            $p->orderData()->save($orderData);
            foreach ($cart as $product_id => $subtotal) {
                $aProduct = Product::find($product_id);
                $aProduct->total_in_stock = $aProduct->total_in_stock < $subtotal ? $aProduct->total_in_stock : $subtotal;
                $aProduct->orders()->attach($orderData->id, ['subtotal' => $subtotal]);
                $aProduct->save();
            }
            DB::commit();
        } catch (\PDOException $ex) {
            DB::rollback();
            throw $ex;
        }
    }
}
