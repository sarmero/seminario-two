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
        Schema::table('inscription', function (Blueprint $table) {
            $table->foreign(['offer_id'], 'fk_inscription_12')->references(['id'])->on('offer')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['student_id'], 'fk_inscription_11')->references(['id'])->on('student')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('inscription', function (Blueprint $table) {
            $table->dropForeign('fk_inscription_12');
            $table->dropForeign('fk_inscription_11');
        });
    }
};
