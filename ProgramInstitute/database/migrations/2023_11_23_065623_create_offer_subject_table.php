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
        Schema::create('offer_subject', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('subject_id')->index('subject_id');
            $table->integer('calendar_id')->index('calendar_id');
            $table->integer('quotas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('offer_subject');
    }
};
