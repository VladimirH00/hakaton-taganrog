<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class UpdateTableInsertData extends Migration
{
    public $pairs = [
        ['id'=>1, 'name'=>'Первая пара', 'slug'=>'pervaya-para', 'time'=>'08:20'],
        ['id'=>2, 'name'=>'Вторая пара', 'slug'=>'vtoraya-para', 'time'=>'11:35'],
        ['id'=>3, 'name'=>'Третья пара', 'slug'=>'tretiya-para', 'time'=>'12:05'],
        ['id'=>4, 'name'=>'Четвертая пара', 'slug'=>'chetvertaya-para', 'time'=>'13:50'],
    ];

    public $lesson = [
        ['id' =>1, 's_subject' => 1, 's_user_creator'=>9, 's_start_lesson'=>1, 's_theme'=>1, 'room' =>'B207', 'date_begin' =>'2022-11-26'],
        ['id' =>2, 's_subject' => 1, 's_user_creator'=>9, 's_start_lesson'=>2, 's_theme'=>2, 'room' =>'B210', 'date_begin' =>'2022-11-26'],
        ['id' =>3, 's_subject' => 2, 's_user_creator'=>9, 's_start_lesson'=>1, 's_theme'=>3, 'room' =>'B309', 'date_begin' =>'2022-11-27'],
        ['id' =>4, 's_subject' => 2, 's_user_creator'=>9, 's_start_lesson'=>2, 's_theme'=>4, 'room' =>'B102', 'date_begin' =>'2022-11-27'],
    ];

    public $lessonGroup = [
        ['s_lesson'=>1, 's_student_group'=>1],
        ['s_lesson'=>2, 's_student_group'=>2],
        ['s_lesson'=>1, 's_student_group'=>3],
        ['s_lesson'=>2, 's_student_group'=>1],
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lesson', function (Blueprint $table) {
            $table->string('room', 10);
            $table->date('date_begin');
        });
        DB::table('spr_pair_time')->insert($this->pairs);
        DB::table('lesson')->insert($this->lesson);
        DB::table('lesson_student_group')->insert($this->lessonGroup);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('lesson', function (Blueprint $table) {
            $table->dropColumn('room');
            $table->dropColumn('date_begin');
        });
        DB::table('spr_pair_time')->whereIn('id', [1,2,3,4])->delete();
        DB::table('lesson')->whereIn('id', [1,2,3,4])->delete();
    }
}
