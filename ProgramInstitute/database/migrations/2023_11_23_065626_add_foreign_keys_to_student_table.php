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
        Schema::table('student', function (Blueprint $table) {
            $table->foreign(['admission_id'], 'student_ibfk_1')->references(['id'])->on('admission')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['semester_id'], 'fk_student_7')->references(['id'])->on('semester')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student', function (Blueprint $table) {
            $table->dropForeign('student_ibfk_1');
            $table->dropForeign('fk_student_7');
        });
    }
};
