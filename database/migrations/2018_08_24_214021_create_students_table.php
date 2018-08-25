<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');

            // Personal Info
            $table->string('name');
            $table->string('gender');
            $table->date('date_of_birth');
            $table->string('national_id');
            $table->integer('school_id');

            // Contact
            $table->string('caregiver_name');
            $table->string('caregiver_contact');
            $table->string('caregiver_relationship');
            $table->string('caregiver_referral')->default('');

            // Criteria
            $table->integer('has_disability')->default(0);
            $table->integer('has_injury')->default(0);
            $table->integer('has_chronical')->default(0);
            $table->integer('health_consent')->default(0);
            $table->integer('last_grade_completed')->default(0);
            $table->integer('has_passed_grade_exam')->default(0);
            $table->integer('fmr_school_attended')->default(0);
            $table->integer('enrollment_reason_id')->default(0);
            $table->integer('previously_enrolled')->default(0);
            $table->integer('previous_school_id')->default(0);
            $table->integer('has_been_referred')->default(0);

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
        Schema::dropIfExists('students');
    }
}
