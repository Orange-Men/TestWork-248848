<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        $exams = Exam::factory()->count(3)->create();

        User::factory(5)
            ->hasAttached($exams)
            ->create()
            ->each(fn (User $user) =>
                $user->exams->each(fn (Exam $exam) =>
                    $exam->pivot->update(['grade' => $faker->numberBetween(60, 100)])
                )
            );
    }
}
