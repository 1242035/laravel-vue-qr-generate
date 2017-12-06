<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateQrsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('qrs', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->integer('user_id');
			$table->string('ft_search', 1024)->nullable()->index('FT_search');
			$table->string('full_name', 150)->nullable();
			$table->string('mobile', 100)->nullable();
			$table->string('street', 150)->nullable();
			$table->string('city_code', 20)->nullable();
			$table->string('state_code', 20)->nullable();
			$table->string('country_code', 20)->nullable();
			$table->char('size', 10)->nullable();
			$table->string('file')->nullable();
			$table->dateTime('created_at')->nullable();
			$table->timestamp('modified_at')->nullable()->default(DB::raw('CURRENT_TIMESTAMP'));
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('qrs');
	}

}
