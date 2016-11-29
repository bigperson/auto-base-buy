<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarSerieTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('car_serie', function(Blueprint $table)
		{
			$table->integer('id_car_serie', true);
			$table->integer('id_car_model')->index('id_car_model');
			$table->string('name')->index('name');
			$table->integer('id_car_generation')->nullable();
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
		Schema::drop('car_serie');
	}

}
