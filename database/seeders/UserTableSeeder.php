<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\UserRole;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rootUser = User::create([
            'name' => 'root',
            'email' => 'root@laravelauth',
            'password' => bcrypt('laravelauth'),
            'email_verified_at' => now(),
            'remember_token' => Str::random(10),
        ]);

        $administratorRole = UserRole::administratorRole();
        $rootUser->userRoles()->attach($administratorRole);
    }
}
