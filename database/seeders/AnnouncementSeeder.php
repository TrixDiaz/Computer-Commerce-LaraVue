<?php

namespace Database\Seeders;

use App\Models\Announcement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnnouncementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Announcement::create(['title' => 'default', 'description' => 'EasyPC now offers Easy2Get Delivery, where you can deliver your order as fast as 2 hours for orders between 8:00AM to 2:00PM, available on some areas of Metro Manila. Express Delivery is also available from 8:00AM to 2:00PM providing prompt delivery within two hours. Same Day Delivery for orders within some areas of Metro Manila, as well as specific areas in Rizal, Cavite, and Bulacan for orders between 12:00MN to 12:00NN only. Nationwide shipping also available.

']);
    }
}
