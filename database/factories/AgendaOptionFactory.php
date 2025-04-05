<?php

namespace Database\Factories;

use App\Models\Agenda;
use App\Models\AgendaOption;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AgendaOption>
 */
class AgendaOptionFactory extends Factory
{
    protected $model = AgendaOption::class;

    public function definition(): array
    {
        return [
            'agenda_id' => Agenda::query()->inRandomOrder()->value('id'),
            'agreed' => $this->faker->randomElements(range(1, 10), rand(1, 5)),
            'against' => $this->faker->randomElements(range(1, 10), rand(0, 3)),
            'abstained' => $this->faker->randomElements(range(1, 10), rand(0, 2)),
            'attachments' => [
                $this->faker->imageUrl(), // или путь к фейковым медиа
                $this->faker->imageUrl(),
            ],
        ];
    }
}
