<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Brand::create(['name' => 'MSI']);
        Brand::create(['name' => 'Asus']);
        Brand::create(['name' => 'Dell']);
        Brand::create(['name' => 'Lenovo']);
        Brand::create(['name' => 'Gigabyte']);
    }
}
