<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCarMarkTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('car_mark', function(Blueprint $table)
		{
			$table->integer('id_car_mark', true);
			$table->string('name');
			$table->integer('id_car_type')->index('id_car_type');
			$table->string('name_rus')->nullable();
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
		Schema::drop('car_mark');
	}

}
