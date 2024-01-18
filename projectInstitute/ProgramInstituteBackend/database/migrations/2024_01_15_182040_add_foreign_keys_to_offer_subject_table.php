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
        Schema::table('offer_subject', function (Blueprint $table) {
            $table->foreign(['teacher_id'], 'offer_subject_ibfk_3')->references(['id'])->on('teacher')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['calendar_id'], 'offer_subject_ibfk_2')->references(['id'])->on('calendar')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['subject_id'], 'offer_subject_ibfk_1')->references(['id'])->on('subject')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offer_subject', function (Blueprint $table) {
            $table->dropForeign('offer_subject_ibfk_3');
            $table->dropForeign('offer_subject_ibfk_2');
            $table->dropForeign('offer_subject_ibfk_1');
        });
    }
};
