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
            $table->unsignedBigInteger('s_user');
            $table->foreign('s_user')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('num_record_book', 7);
        });

        Schema::create('lesson', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('s_subject');
            $table->foreign('s_subject')
                ->references('id')
                ->on('spr_subject')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('s_user_creator');
            $table->foreign('s_user_creator')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('s_start_lesson');
            $table->foreign('s_start_lesson')
                ->references('id')
                ->on('lesson')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('s_theme');
            $table->foreign('s_theme')
                ->references('id')
                ->on('spr_theme')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });

        Schema::create('student_group', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->integer('course');
        });

        Schema::create('question_group', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('s_lesson');
            $table->foreign('s_lesson')
                ->references('id')
                ->on('lesson')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('name');
            $table->integer('duration');
        });

        Schema::create('question', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('s_question_group');
            $table->foreign('s_question_group')
                ->references('id')
                ->on('student_group')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('name');
            $table->string('code');
            $table->boolean('is_true');
        });

        Schema::create('student_intro_lesson', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('s_lesson');
            $table->foreign('s_lesson')
                ->references('id')
                ->on('lesson')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('s_student');
            $table->foreign('s_student')
                ->references('id')
                ->on('student')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->timestamps();
        });

        Schema::create('lesson_student_group', function (Blueprint $table) {
            $table->unsignedBigInteger('s_lesson');
            $table->foreign('s_lesson')
                ->references('id')
                ->on('lesson')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('s_student_group');
            $table->foreign('s_student_group')
                ->references('id')
                ->on('student_group')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->primary(['s_lesson', 's_student_group']);
        });

        Schema::create('student_group_student', function (Blueprint $table) {
            $table->unsignedBigInteger('s_student_group');
            $table->foreign('s_student_group')
                ->references('id')
                ->on('student_group')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('s_student');
            $table->foreign('s_student')
                ->references('id')
                ->on('student')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->primary(['s_student', 's_student_group']);

        });

        Schema::create('student_question', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('s_question_group');
            $table->foreign('s_question_group')
                ->references('id')
                ->on('question_group')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('s_select_group');
            $table->foreign('s_select_group')
                ->references('id')
                ->on('student_group')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student', function (Blueprint $table){
            $table->dropForeign(['s_user']);
        });
        Schema::table('lesson', function (Blueprint $table){
            $table->dropForeign(['s_subject']);
        });
        Schema::table('lesson', function (Blueprint $table){
            $table->dropForeign(['s_user_creator']);
        });
        Schema::table('lesson', function (Blueprint $table){
            $table->dropForeign(['s_start_lesson']);
        });
        Schema::table('lesson', function (Blueprint $table){
            $table->dropForeign(['s_theme']);
        });
        Schema::table('question_group', function (Blueprint $table){
            $table->dropForeign(['s_lesson']);
        });
        Schema::table('question', function (Blueprint $table){
            $table->dropForeign(['s_question_group']);
        });
        Schema::table('student_intro_lesson', function (Blueprint $table){
            $table->dropForeign(['s_lesson']);
        });
        Schema::table('student_intro_lesson', function (Blueprint $table){
            $table->dropForeign(['s_student']);
        });
        Schema::table('lesson_student_group', function (Blueprint $table){
            $table->dropForeign(['s_lesson']);
        });
        Schema::table('lesson_student_group', function (Blueprint $table){
            $table->dropForeign(['s_student_group']);
        });
        Schema::table('student_group_student', function (Blueprint $table){
            $table->dropForeign(['s_student_group']);
        });
        Schema::table('student_group_student', function (Blueprint $table){
            $table->dropForeign(['s_student']);
        });
        Schema::table('student_question', function (Blueprint $table){
            $table->dropForeign(['s_question_group']);
        });
        Schema::table('student_question', function (Blueprint $table){
            $table->dropForeign(['s_select_group']);
        });

        Schema::dropIfExists('student_question');
        Schema::dropIfExists('lesson_student_group');
        Schema::dropIfExists('student_group_student');
        Schema::dropIfExists('student_intro_lesson');
        Schema::dropIfExists('student_group');
        Schema::dropIfExists('lesson');
        Schema::dropIfExists('question');
        Schema::dropIfExists('question_group');
        Schema::dropIfExists('student');
        Schema::dropIfExists('spr_theme');
        Schema::dropIfExists('spr_pair_time');
        Schema::dropIfExists('spr_subject');
    }
}
