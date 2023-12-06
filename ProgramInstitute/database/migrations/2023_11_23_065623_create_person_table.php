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
        Schema::create('person', function (Blueprint $table) {
            $table->integer('id', true);
            $table->integer('number_document');
            $table->string('first_name', 200);
            $table->string('last_name', 200);
            $table->char('gender', 1);
            $table->integer('contact_id')->index('contact_id');
            $table->integer('district_id')->index('district_id');
            $table->integer('role_id')->index('role_id');
            $table->string('photo', 500)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('person');
    }
};
