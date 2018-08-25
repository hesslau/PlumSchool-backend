<?php

use Illuminate\Database\Seeder;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Enrollment::truncate();

        $faker = \Faker\Factory::create();

        for($i=0;$i<5;$i++) {
            \App\Enrollment::create([
                'student_id' => \App\Student::inRandomOrder()->get()[0]->id,
                'course_id' => \App\Course::inRandomOrder()->get()[0]->id
            ]);

        }
    }
}
