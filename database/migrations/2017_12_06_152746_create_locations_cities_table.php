<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocationsCitiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('locations_cities', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 100);
			$table->string('alt_name', 100)->nullable();
			$table->string('capital', 100)->nullable();
			$table->string('alt_capital', 100)->nullable();
			$table->string('country_code', 2)->comment('ISO 3166-1 alpha-2  two-letter country codes');
			$table->string('state_code', 10)->comment('ISO 3166-2 state codes for identifying the principal subdivisions (e.g., provinces or states)');
			$table->string('code', 10)->comment('city code, use HASC as code');
			$table->string('hasc', 10)->nullable()->comment('Hierarchical administrative subdivision codes if exists');
			$table->integer('level')->nullable()->default(2)->comment('Administrative level 2');
			$table->string('types', 64)->nullable();
			$table->string('alt_types', 64)->nullable();
			$table->decimal('lat', 10, 7)->nullable();
			$table->decimal('lng', 10, 7)->nullable();
			$table->string('postcode', 10)->nullable();
			$table->string('neighbours', 32)->nullable();
			$table->string('languages', 32)->nullable()->comment('ISO 639-1 two-letter language code ');
			$table->string('currency', 16)->nullable();
			$table->string('flag', 64)->nullable()->comment('URL or path');
			$table->string('map', 64)->nullable()->comment('URL or path');
			$table->string('url', 64)->nullable()->comment('URL or path');
			$table->integer('sort_order')->nullable()->default(0);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('locations_cities');
	}

}
