<?php

namespace Database\Factories;

use App\Models\UserRole;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;

class UserRoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserRole::class;

    protected $userRoleTypeList = [
        'Administrator',
        'User'
    ];

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'type' => Arr::random($this->userRoleTypeList),
            'description' => $this->faker->text(),
        ];
    }
}
