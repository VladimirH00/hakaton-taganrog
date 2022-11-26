<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class InsertDataIntoTable extends Migration
{

    public $dataSubject = [
        ['id' => 1, 'name' => 'Высшая математика', 'slug' => 'visshaya-matematika'],
        ['id' => 2, 'name' => 'Информатика', 'slug' => 'informatika'],
        ['id' => 3, 'name' => 'Схемотехника', 'slug' => 'shemotehnika'],
        ['id' => 4, 'name' => 'Базы данных', 'slug' => 'data-base'],
    ];
    public $dataTheme = [
        ['id' => 1, 'name' => 'Интегралы', 'slug' => 'integrali'],
        ['id' => 2, 'name' => 'Определетители', 'slug' => 'opreltkbntkb'],
        ['id' => 3, 'name' => 'Регулярные выражения', 'slug' => 'regular_virajeniya'],
        ['id' => 4, 'name' => 'ООП программирование', 'slug' => 'oop-programirovaniye'],
        ['id' => 5, 'name' => 'Триггеры', 'slug' => 'trigeri'],
        ['id' => 6, 'name' => 'Полевые транзисторы', 'slug' => 'polevoy-transistor'],
        ['id' => 7, 'name' => 'Функции', 'slug' => 'funckcii'],
        ['id' => 8, 'name' => 'Подзапрсы', 'slug' => 'podzaprosy'],
    ];
    public $assignmentData = [
        ['s_subject' => 1, 's_theme' => 1],
        ['s_subject' => 1, 's_theme' => 2],
        ['s_subject' => 2, 's_theme' => 3],
        ['s_subject' => 2, 's_theme' => 4],
        ['s_subject' => 3, 's_theme' => 5],
        ['s_subject' => 3, 's_theme' => 6],
        ['s_subject' => 4, 's_theme' => 7],
        ['s_subject' => 4, 's_theme' => 8],
    ];

    public $users = [
        ['', '', '', ''],
    ];
    public $group = [];


    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('subject_theme', function (Blueprint $table) {
            $table->unsignedBigInteger('s_subject');
            $table->foreign('s_subject')
                ->references('id')
                ->on('spr_subject')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->unsignedBigInteger('s_theme');
            $table->foreign('s_theme')
                ->references('id')
                ->on('spr_theme')
                ->onDelete('cascade')
                ->onUpdate('cascade');
            $table->primary(['s_subject', 's_theme']);

        });

        DB::table('users')->insert(
            [
                'name' => 'admin',
                'email' => 'admin@admin.ru',
                'password' => Hash::make('admin'),
                'created_at' => date('Y-m-d H:m:i'),
                'updated_at' => date('Y-m-d H:m:i'),
            ]
        );
        DB::table('spr_theme')->insert($this->dataTheme);
        DB::table('spr_subject')->insert($this->dataSubject);
        DB::table('subject_theme')->insert($this->assignmentData);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subject_theme', function (Blueprint $table) {
            $table->dropForeign(['s_subject']);
        });
        Schema::table('subject_theme', function (Blueprint $table) {
            $table->dropForeign(['s_theme']);
        });

        Schema::dropIfExists('subject_theme');
        DB::table('users')->where(['name' => 'admin'])->delete();
        DB::table('spr_subject')->whereIn('id', [1,2,3,4])->delete();
        DB::table('spr_theme')->whereIn('id', [1,2,3,4,5,6,7,8])->delete();
    }
}
