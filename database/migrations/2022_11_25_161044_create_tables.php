<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spr_subject', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('slug', 50);
        });

        Schema::create('spr_pair_time', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('slug', 50);
            $table->time('time');
        });

        Schema::create('spr_theme', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50);
            $table->string('slug', 50);
        });

        Schema::create('student', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('s_user');
            $table->string('num_record_book', 7);
        });

        Schema::create('course', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('s_teacher');
            $table->bigInteger('s_lesson');
            $table->dateTime('create_time');
        });

        Schema::create('question', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('s_question_group');
            $table->string('name');
            $table->string('code');
            $table->boolean('is_true');
        });

        Schema::create('student_group', function (Blueprint $table) {
            $table->id();
            $table->string('name_course');
            $table->integer('course');
        });

        Schema::create('student_intro_lesson', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('s_lesson');
            $table->bigInteger('s_student');
            $table->timestamps();
        });

        Schema::create('assignment_course_student_group', function (Blueprint $table) {
            $table->bigInteger('s_course');
            $table->bigInteger('s_student_group');
        });

        Schema::create('assignment_student_student_group', function (Blueprint $table) {
            $table->bigInteger('s_group');
            $table->bigInteger('s_student');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tables');
        Schema::dropIfExists('assignment_student_student_group');
        Schema::dropIfExists('assignment_course_student_group');
        Schema::dropIfExists('student_intro_lesson');
        Schema::dropIfExists('student_group');
        Schema::dropIfExists('question');
        Schema::dropIfExists('course');
        Schema::dropIfExists('student');
        Schema::dropIfExists('spr_theme');
        Schema::dropIfExists('spr_pair_time');
        Schema::dropIfExists('spr_subject');
    }
}
