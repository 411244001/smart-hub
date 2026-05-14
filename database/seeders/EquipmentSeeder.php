<?php

namespace Database\Seeders;

use App\Models\Equipment;
use Illuminate\Database\Seeder;

class EquipmentSeeder extends Seeder
{
    public function run(): void
    {
        Equipment::create([
            'name'        => 'Kamera Sony A7III',
            'category'    => 'Kamera',
            'description' => 'Kamera mirrorless full frame',
            'status'      => 'available',
        ]);

        Equipment::create([
            'name'        => 'Tripod Profesional',
            'category'    => 'Aksesoris',
            'description' => 'Tripod carbon fiber 180cm',
            'status'      => 'available',
        ]);

        Equipment::create([
            'name'        => 'Lighting Studio',
            'category'    => 'Lighting',
            'description' => 'Softbox 60x90cm dengan stand',
            'status'      => 'available',
        ]);
    }
}
