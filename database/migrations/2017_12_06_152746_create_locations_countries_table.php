<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLocationsCountriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('locations_countries', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->string('name', 100);
			$table->string('alt_name', 100)->nullable();
			$table->string('capital', 100)->nullable();
			$table->string('alt_capital', 100)->nullable();
			$table->string('iso_a2', 2)->comment('ISO 3166-1 alpha-2  two-letter country codes');
			$table->string('iso_a3', 3)->nullable()->comment('ISO 3166-1 alpha-3  three-letter country codes');
			$table->string('iso_num', 3)->nullable()->comment('ISO 3166-1 numeric three-digit country codes');
			$table->string('fips', 3)->nullable();
			$table->decimal('lat', 10, 7)->nullable();
			$table->decimal('lng', 10, 7)->nullable();
			$table->string('region_code', 2)->nullable()->comment('\'AF\': \'Africa\', \'AN\': \'Antarctica\', \'AS\': \'Asia\', \'EU\': \'Europe\', \'NA\': \'North America\', \'OC\': \'Oceania\', \'SA\': \'South America\'');
			$table->string('neighbours', 32)->nullable();
			$table->string('languages', 32)->nullable()->comment('ISO 639-1 two-letter language code list');
			$table->string('currency', 16)->nullable();
			$table->string('flag', 64)->nullable()->comment('URL or path');
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
		Schema::drop('locations_countries');
	}

}
