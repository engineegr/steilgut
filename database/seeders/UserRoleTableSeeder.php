<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserRole;

class UserRoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (UserRole::$USER_ROLE_DICT as $userRole) {
            UserRole::create(['user_role' => $userRole]);
        }
    }
}
