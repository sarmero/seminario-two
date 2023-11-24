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
        Schema::table('person', function (Blueprint $table) {
            $table->foreign(['role_id'], 'fk_person_2')->references(['id'])->on('role');
            $table->foreign(['district_id'], 'fk_person_1')->references(['id'])->on('district');
            $table->foreign(['contact_id'], 'person_ibfk_1')->references(['id'])->on('contact');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('person', function (Blueprint $table) {
            $table->dropForeign('fk_person_2');
            $table->dropForeign('fk_person_1');
            $table->dropForeign('person_ibfk_1');
        });
    }
};
