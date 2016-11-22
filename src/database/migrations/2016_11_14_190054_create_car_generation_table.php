<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarGenerationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('car_generation', function(Blueprint $table)
		{
			$table->integer('id_car_generation', true);
			$table->string('name');
			$table->integer('id_car_model')->index('id_car_model');
			$table->string('year_begin')->nullable();
			$table->string('year_end')->nullable();
			$table->integer('id_car_type')->default(0)->index('id_car_type');
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
		Schema::drop('car_generation');
	}

}
