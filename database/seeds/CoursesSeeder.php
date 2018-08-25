<?php

use Illuminate\Database\Seeder;
use App\Course;

class CoursesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Course::truncate();

        $faker = \Faker\Factory::create();

        for($i=0;$i<5;$i++) {
            $course = Course::create([
                'name' => $faker->word,
            ]);

        }
    }
}
