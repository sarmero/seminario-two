<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('teacher', function (Blueprint $table) {
            $table->foreign(['program_id'], 'teacher_ibfk_1')->references(['id'])->on('program')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['person_id'], 'fk_teacher_15')->references(['id'])->on('person')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('teacher', function (Blueprint $table) {
            $table->dropForeign('teacher_ibfk_1');
            $table->dropForeign('fk_teacher_15');
        });
    }
};
