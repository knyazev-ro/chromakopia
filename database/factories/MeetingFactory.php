<?php

namespace Database\Factories;

use App\Models\Meeting;
use App\Models\User;
use App\Models\Agenda;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\MeetingFormatType;

class MeetingFactory extends Factory
{
    protected $model = Meeting::class;

    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('now', '+1 week');
        $end = (clone $start)->modify('+2 hours');

        return [
            'name' => $this->faker->sentence(3),
            'start_date' => $start,
            'end_date' => $end,
            'agenda_id' => Agenda::query()->inRandomOrder()->value('id'), // nullable по желанию
            'format_type' => $this->faker->randomElement([
                MeetingFormatType::IN_PERSON,
                MeetingFormatType::REMOTE,
                MeetingFormatType::HYBRID,
            ]),
            'chariman_id' => User::query()->inRandomOrder()->value('id'),
            'secretaty_id' => User::query()->inRandomOrder()->value('id'),
        ];
    }
}
