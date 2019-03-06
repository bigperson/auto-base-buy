<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarModificationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_modification', function (Blueprint $table) {
            $table->integer('id_car_modification', true);
            $table->integer('id_car_serie')->index('id_car_serie');
            $table->integer('id_car_model')->index('id_car_model');
            $table->string('name');
            $table->string('start_production_year')->nullable();
            $table->string('end_production_year')->nullable();
            $table->integer('id_car_type')->index('id_car_type');
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
        Schema::drop('car_modification');
    }
}
