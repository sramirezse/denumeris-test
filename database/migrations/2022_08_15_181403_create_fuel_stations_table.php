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
        Schema::create('fuel_stations', function (Blueprint $table) {
            $table->id();
            $table->string('calle');
            $table->string('rfc');
            $table->string('date_insert');
            $table->string('regular');
            $table->string('premium');
            $table->string('colonia');
            $table->string('razonsocial');
            $table->string('codigopostal');
            $table->string('latitude');
            $table->string('longitude');
            $table->string('dieasel');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fuel_stations');
    }
};
