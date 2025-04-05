<?php

namespace Database\Seeders;

use App\Models\Agenda;
use App\Models\Meeting;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MeetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Meeting::factory()->count(100)->for(Agenda::factory()->count(1)->create())->create();
    }
}
