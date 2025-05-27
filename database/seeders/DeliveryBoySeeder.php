<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\DeliveryBoy;

class DeliveryBoySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $boys = [
            ['name' => 'A', 'max_capacity' => 2],
            ['name' => 'B', 'max_capacity' => 4],
            ['name' => 'C', 'max_capacity' => 5],
            ['name' => 'D', 'max_capacity' => 3],
        ];

        foreach ($boys as $boy) {
            DeliveryBoy::create($boy);
        }
    }
}
