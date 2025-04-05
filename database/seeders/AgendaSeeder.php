<?php

namespace Database\Seeders;

use App\Models\Agenda;
use App\Models\AgendaOption;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AgendaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    Agenda::factory()
    ->count(50)
    ->create();
    
    AgendaOption::factory()->count(150)->create(); 

    }
}
