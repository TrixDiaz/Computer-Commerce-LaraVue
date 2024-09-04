<?php

namespace Database\Seeders;

use App\Models\Series;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SeriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Series::create(['name' => 'N/A']);
        Series::create(['name' => 'Series 11']);
        Series::create(['name' => 'Series 12']);
        Series::create(['name' => 'Series 13']);
        Series::create(['name' => 'Series 14']);
    }
}
