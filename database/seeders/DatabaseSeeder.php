<?php

namespace Database\Seeders;

use App\Models\Group;
use App\Models\Task;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(10)->create();
        Group::factory(5)->create();
        Task::factory(10)->create();
        Tag::factory(5)->create();
    }
}
