#! /bin/bash

php artisan migrate:refresh --path="database/migrations/2020_10_01_112140_create_wines_table.php"
php artisan migrate:refresh --path="database/migrations/2022_11_08_101809_add_order_column_to_wines_table.php"
php artisan migrate:refresh --path="database/migrations/2020_11_04_135301_create_products_table.php"

# php artisan migrate:refresh --path="database/migrations/2020_11_04_135554_create_orders_table.php"
# php artisan migrate:refresh --path="database/migrations/2020_11_04_135201_create_order_data_table.php"


php artisan db:seed --class="WineTableSeeder"
php artisan db:seed --class="ProductTableSeeder"