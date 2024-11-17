<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Plan;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $plans = [
            ['name' => 'Gold Plan', 'interest' => 6, 'min_amount' => 10, 'max_amount' => 249, 'duration' => '2'],
            ['name' => 'Silver Plan', 'interest' => 5, 'min_amount' => 20, 'max_amount' => 500, 'duration' => '4' ],
            ['name' => 'Platinum Plan', 'interest' => 7, 'min_amount' => 50, 'max_amount' => 1000, 'duration' => '6'],
            ['name' => 'Diamond Plan', 'interest' => 8, 'min_amount' => 100, 'max_amount' => 5000, 'duration' => '8'],
            ['name' => 'Premium Plan', 'interest' => 10, 'min_amount' => 200, 'max_amount' => 10000, 'duration' => '10'],
        ];

        foreach ($plans as $plan) {
            Plan::create($plan);
        }
    }
}
