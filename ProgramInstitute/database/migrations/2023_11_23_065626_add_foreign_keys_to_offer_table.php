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
        Schema::table('offer', function (Blueprint $table) {
            $table->foreign(['program_id'], 'fk_offer_17')->references(['id'])->on('program');
            $table->foreign(['state_offer_id'], 'offer_ibfk_2')->references(['id'])->on('state_offer');
            $table->foreign(['calendar_id'], 'fk_offer_16')->references(['id'])->on('calendar');
            $table->foreign(['modality_id'], 'offer_ibfk_1')->references(['id'])->on('modality');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('offer', function (Blueprint $table) {
            $table->dropForeign('fk_offer_17');
            $table->dropForeign('offer_ibfk_2');
            $table->dropForeign('fk_offer_16');
            $table->dropForeign('offer_ibfk_1');
        });
    }
};
