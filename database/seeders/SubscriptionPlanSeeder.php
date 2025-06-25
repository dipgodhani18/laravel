<?php

namespace Database\Seeders;

use App\Models\SubscriptionPlan;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SubscriptionPlanSeeder extends Seeder
{
    public function run()
    {
        $currentDateTime = Carbon::now()->format('Y-m-d H:i:s');

        SubscriptionPlan::insert([
            [
                'name' => 'Monthly',
                'stripe_price_id' => 'price_1Rdqy4BDi9ZPBDCH5gE6gAYX',
                'trial_days' => 5,
                'plan_amount' => 49,
                'type' => 0,
                'enabled' => 1,
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime
            ],
            [
                'name' => 'Yearly',
                'stripe_price_id' => 'price_1RdqynBDi9ZPBDCHULQhM03S',
                'trial_days' => 5,
                'plan_amount' => 549,
                'type' => 1,
                'enabled' => 1,
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime
            ],
            [
                'name' => 'Unlimited',
                'stripe_price_id' => 'price_1Rdr4NBDi9ZPBDCHV9jcQi3z',
                'trial_days' => 5,
                'plan_amount' => 1199,
                'type' => 2,
                'enabled' => 1,
                'created_at' => $currentDateTime,
                'updated_at' => $currentDateTime
            ]
        ]);
    }
}