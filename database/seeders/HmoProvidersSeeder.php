<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Patients\PatientHmoProvider;

class HmoProvidersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $providers = ['MEDASIA', 'AMAPHIL', 'HPPI', 'LIFE AND HEALTH HMP', 'LACSON & LACSON', 'SUNLIFE GREPA'];

        foreach ($providers as $provider)
        {
            PatientHmoProvider::query()->firstOrCreate([
                'name'          => $provider,
                'name_slug'     => Str::slug($provider),
                'is_enabled'    => true
            ]);
        }
    }
}
