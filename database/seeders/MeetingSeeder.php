<?php

namespace Database\Seeders;

use App\Models\Agenda;
use App\Models\Meeting;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MeetingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Meeting::factory()
        ->count(150)
        ->create() // Сначала создаём встречи
        ->each(function ($meeting) { // Затем для каждой встречи создаём связанные записи
            Agenda::factory()
                ->count(1)
                ->state(function (array $attributes) use ($meeting) {
                    return [
                        'start_date' => Carbon::parse($meeting->start_date),
                        'end_date' => Carbon::parse($meeting->start_date)->addHours(8),
                        'meeting_id' => $meeting->id, // Указываем связь с Meeting
                    ];
                })
                ->create();
        });
    }
}
