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
        Schema::create('student', function (Blueprint $table) {
            $table->integer('id', true);
            $table->string('code', 10);
            $table->integer('admission_id')->index('person_id');
            $table->integer('semester_id')->index('semester_id');
            $table->integer('person_id')->index('person_id_2');
            $table->integer('offer_id')->index('offer_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student');
    }
};
