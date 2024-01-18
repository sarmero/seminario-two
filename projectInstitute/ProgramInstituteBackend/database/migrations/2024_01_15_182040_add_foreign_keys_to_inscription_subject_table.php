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
        Schema::table('inscription_subject', function (Blueprint $table) {
            $table->foreign(['student_id'], 'inscription_subject_ibfk_3')->references(['id'])->on('student')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['offer_subject_id'], 'inscription_subject_ibfk_2')->references(['id'])->on('offer_subject')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inscription_subject', function (Blueprint $table) {
            $table->dropForeign('inscription_subject_ibfk_3');
            $table->dropForeign('inscription_subject_ibfk_2');
        });
    }
};
