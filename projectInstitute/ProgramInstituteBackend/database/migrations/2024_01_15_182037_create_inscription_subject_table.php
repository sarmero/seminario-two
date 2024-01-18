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
        Schema::create('inscription_subject', function (Blueprint $table) {
            $table->integer('id', true);
            $table->float('note', 10, 0)->nullable();
            $table->integer('offer_subject_id')->index('subject_id');
            $table->integer('student_id')->index('student_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('inscription_subject');
    }
};
