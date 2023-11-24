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
        Schema::create('offer', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('code', 20);
            $table->integer('quotas');
            $table->integer('calendar_id')->index('calendar_id');
            $table->integer('program_id')->index('program_id');
            $table->integer('modality_id')->index('modality_id');
            $table->integer('state_offer_id')->index('state_offer_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offer');
    }
};
