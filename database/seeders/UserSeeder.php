<?php

namespace Database\Seeders;

use App\Enums\RoleType;
use App\Interfaces\IRoleService;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Lauthz\Facades\Enforcer;
use App\Models\Branch;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin = User::create([
            'name' => 'Gabe',
            'email' => 'chromakopia@og.com',
            'sign' => Str::random(10),
            'branch_id' => Branch::query()->inRandomOrder()->value('id'),
            'password' => Hash::make('123'),
            'type' => 1,
        ]);

        Enforcer::addRoleForUser("U$admin->id", RoleType::ADMIN->value);

        User::factory()->count(100)->create();
    }
}
