<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UpdateTableAndInsertData extends Migration
{
    public $students = [
        ['id' => 1, 'passport' => '2908500601', 'surname' => 'Сидоров', 'first_name' => 'Сидр', 'patronymic' => 'Сидорович'],
        ['id' => 2, 'passport' => '2908500602', 'surname' => 'Петров', 'first_name' => 'Петр', 'patronymic' => 'Петрович'],
        ['id' => 3, 'passport' => '2908500603', 'surname' => 'Сергеев', 'first_name' => 'Сергей', 'patronymic' => 'Сергеевич'],
        ['id' => 4, 'passport' => '2908500604', 'surname' => 'Иванов', 'first_name' => 'Иван', 'patronymic' => 'Иванович'],
    ];

    public $employee = [
        ['id'=> 1, 'passport' =>'1908543123', 'surname'=>'Важный', 'first_name'=>'Павел', 'patronymic' => 'Сергеевич', 'dolgn'=>'Доцент'],
    ];

    public $groups = [
        ['id' =>1, 'name' => 'ИОТ-1-089', 'course' => 1],
        ['id' =>2, 'name' => 'ИОТ-2-088', 'course' => 2],
        ['id' =>3, 'name' => 'ИОТ-1-087', 'course' => 3],
    ];

    public $assignmentGroupStudent = [
        ['s_student'=>1, 's_student_group'=>1],
        ['s_student'=>2, 's_student_group'=>1],
        ['s_student'=>3, 's_student_group'=>2],
        ['s_student'=>4, 's_student_group'=>3],
    ];

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student', function (Blueprint $table) {
            $table->dropForeign(['s_user']);
            $table->string('surname', 50);
            $table->string('first_name', 50);
            $table->string('patronymic', 50)->nullable();
            $table->dropColumn('s_user');
        });

        Schema::create('employee', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('s_user')->default(null)->nullable();
            $table->string('passport', 10);
            $table->string('surname', 50);
            $table->string('first_name', 50);
            $table->string('patronymic', 50)->nullable();
            $table->foreign('s_user')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->string('dolgn', 50);
        });

        Schema::table('student', function (Blueprint $table) {
            $table->unsignedBigInteger('s_user')->nullable();
            $table->string('passport', 10);
            $table->dropColumn('num_record_book');
            $table->foreign('s_user')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
        DB::table('student')->insert($this->students);
        DB::table('employee')->insert($this->employee);
        DB::table('student_group')->insert($this->groups);
        DB::table('student_group_student')->insert($this->assignmentGroupStudent);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('student')->whereIn('id', [1,2,3,4])->delete();
        DB::table('student_group')->whereIn('id', [1,2,3])->delete();
        Schema::table('student', function (Blueprint $table) {
            $table->dropForeign(['s_user']);
            $table->dropColumn('s_user');
        });
        Schema::table('employee', function (Blueprint $table) {
            $table->dropForeign(['s_user']);
        });
        Schema::drop('employee');
        Schema::table('student', function (Blueprint $table) {
            $table->string('num_record_book', 7);
            $table->dropColumn('passport');
            $table->dropColumn('surname');
            $table->dropColumn('first_name');
            $table->dropColumn('patronymic');
            $table->unsignedBigInteger('s_user');
            $table->foreign('s_user')
                ->references('id')
                ->on('users')
                ->onDelete('cascade')
                ->onUpdate('cascade');
        });
    }
}
