<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Seeder;

class DemoSubscriptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $plans = Plan::all();

        foreach ($users->take(5) as $user) {
            $randomPlan = $plans->random();
            
            Subscription::create([
                'user_id' => $user->id,
                'plan_id' => $randomPlan->id,
                'started_at' => now(),
                'renews_at' => now()->addMonth(),
                'cancelled_at' => null,
                'status' => 'active',
            ]);
        }
    }
}
