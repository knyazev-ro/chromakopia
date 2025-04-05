<?php

namespace Database\Seeders;

use App\Enums\RoleType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Lauthz\Facades\Enforcer;
use Faker\Factory as Faker;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users =User::all();
        $faker = Faker::create();
        RoleType::all()->each(fn($e) => Enforcer::addPolicy($e['value'], $e['value'] . "_MENU", 'access'));
        
        $users->each(function($user) use($faker){
            Enforcer::addRoleForUser("U$user->id", "AU");
            Enforcer::addRoleForUser("U$user->id", $faker->boolean() ? ($faker->boolean() ? RoleType::DIRECTOR->value : RoleType::COMMITET_DIRECTOR->value) : RoleType::ADMIN->value);
        });

    }
}
