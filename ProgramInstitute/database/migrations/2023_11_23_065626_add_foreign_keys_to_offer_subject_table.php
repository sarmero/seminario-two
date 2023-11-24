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
            $table->foreign(['calendar_id'], 'offer_subject_ibfk_2')->references(['id'])->on('calendar');
            $table->foreign(['subject_id'], 'offer_subject_ibfk_1')->references(['id'])->on('subject');
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
            $table->dropForeign('offer_subject_ibfk_2');
            $table->dropForeign('offer_subject_ibfk_1');
        });
    }
};
