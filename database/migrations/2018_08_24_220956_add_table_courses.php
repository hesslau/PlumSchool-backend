<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTableCourses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('school_id');
            $table->integer('teacher_id');
            $table->dateTime('start_date');
            $table->dateTime('end_date');
            $table->integer('course_name_id');
            $table->integer('course_schedule_id');
            $table->integer('grade');
            // ...
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('courses', function (Blueprint $table) {
            Schema::dropIfExists('courses');
        });
    }

}
