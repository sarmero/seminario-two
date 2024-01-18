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
        Schema::table('subject', function (Blueprint $table) {
            $table->foreign(['semester_id'], 'subject_ibfk_1')->references(['id'])->on('semester')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['program_id'], 'fk_subject_10')->references(['id'])->on('program')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('subject', function (Blueprint $table) {
            $table->dropForeign('subject_ibfk_1');
            $table->dropForeign('fk_subject_10');
        });
    }
};
