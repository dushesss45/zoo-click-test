<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\EquipmentType;

class EquipmentTypeSeeder extends Seeder
{
    public function run(): void
    {
        EquipmentType::insert([
            ['name' => 'TP-Link model 1', 'serial_mask' => 'XXAAAAAXAA'],
            ['name' => 'D-Link model 2', 'serial_mask' => 'NXXAAXZXaa'],
            ['name' => 'D-Link model 4', 'serial_mask' => 'NAAAAXZXXX'],
        ]);
    }
}
