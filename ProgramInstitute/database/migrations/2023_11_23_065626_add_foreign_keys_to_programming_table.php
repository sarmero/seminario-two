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
        Schema::table('programming', function (Blueprint $table) {
            $table->foreign(['offer_subject_id'], 'fk_programming_19')->references(['id'])->on('offer_subject')->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->foreign(['teacher_id'], 'fk_programming_18')->references(['id'])->on('teacher')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('programming', function (Blueprint $table) {
            $table->dropForeign('fk_programming_19');
            $table->dropForeign('fk_programming_18');
        });
    }
};
