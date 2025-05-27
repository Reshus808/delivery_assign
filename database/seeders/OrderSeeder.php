<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Order;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        for ($i = 1; $i <= 20; $i++) {
            Order::create([
                'status' => 'pending',
                'delivery_boy_id' => null,
                'assigned_at' => null,
            ]);
        }
    }
}
