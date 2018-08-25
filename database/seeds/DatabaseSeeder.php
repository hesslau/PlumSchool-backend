<?php

use Illuminate\Database\Seeder;
use App\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(StudentSeeder::class);
        $this->call(CoursesSeeder::class);
        $this->call(EnrollmentSeeder::class);
        $this->roles();
    }

    private function roles() {
        Role::truncate();
        Role::create(['role_name' => 'teacher']);
        Role::create(['role_name' => 'volunteer']);
    }

}
