<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(LocationsCountriesTableSeeder::class);
        $this->call(LocationsStatesTableSeeder::class);
        $this->call(LocationsCitiesTableSeeder::class);
        $this->call(QrsTableSeeder::class);
    }
}
