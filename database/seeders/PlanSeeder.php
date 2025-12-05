<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        Plan::query()->delete(); // optional: bersihin dulu

        Plan::create([
            'name'          => 'Free',
            'slug'          => 'free',
            'description'   => 'Cocok untuk mencoba fitur dasar.',
            'price_monthly' => 0,
            'price_yearly'  => 0,
            'currency'      => 'IDR',
            'is_active'     => true,
            'max_projects'  => 1,
            'max_users'     => 1,
            'data'          => ['features' => ['1 project', 'Basic analytics']],
            'sort_order'    => 1,
        ]);

        Plan::create([
            'name'          => 'Pro',
            'slug'          => 'pro',
            'description'   => 'Untuk pengguna serius dan freelancer.',
            'price_monthly' => 99000,
            'price_yearly'  => 990000,
            'currency'      => 'IDR',
            'is_active'     => true,
            'max_projects'  => 10,
            'max_users'     => 3,
            'data'          => ['features' => ['10 projects', 'Advanced analytics', 'Priority support']],
            'sort_order'    => 2,
        ]);

        Plan::create([
            'name'          => 'Business',
            'slug'          => 'business',
            'description'   => 'Untuk tim kecil dan bisnis.',
            'price_monthly' => 199000,
            'price_yearly'  => 1990000,
            'currency'      => 'IDR',
            'is_active'     => true,
            'max_projects'  => 999,
            'max_users'     => 10,
            'data'          => ['features' => ['Unlimited projects', 'Team access', 'Dedicated support']],
            'sort_order'    => 3,
        ]);
    }
}
