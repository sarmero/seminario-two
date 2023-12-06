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
        Schema::table('admission', function (Blueprint $table) {
            $table->foreign(['state_id'], 'fk_admission_4')->references(['id'])->on('state');
            $table->foreign(['offer_id'], 'admission_ibfk_1')->references(['id'])->on('offer');
            $table->foreign(['person_id'], 'fk_admission_5')->references(['id'])->on('person')->onUpdate('CASCADE')->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admission', function (Blueprint $table) {
            $table->dropForeign('fk_admission_4');
            $table->dropForeign('admission_ibfk_1');
            $table->dropForeign('fk_admission_5');
        });
    }
};
