<?php

namespace Database\Seeders;

use App\Models\JenisBeasiswa;
use Illuminate\Database\Seeder;

class JenisBeasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $now = now();
        $data = [
            [
                'nama' => 'Beasiswa Akademik',
                'minimal_ipk' => 3.00,
                'created_at' => $now,
                'updated_at' => $now,
            ],
            [
                'nama' => 'Beasiswa Non Akademik',
                'minimal_ipk' => 3.00,
                'created_at' => $now,
                'updated_at' => $now,
            ],
        ];

        JenisBeasiswa::upsert($data, ['nama'], ['minimal_ipk', 'updated_at']);
    }
}
