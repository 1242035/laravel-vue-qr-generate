<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'email' => 'chidungdekiemtra@gmail.com',
                'verified_fields' => 0,
                'created_at' => '2017-12-05 05:02:43',
                'modified_at' => '2017-12-05 05:02:43',
            ),
            1 => 
            array (
                'id' => 2,
                'email' => 'khongco@gmail.com',
                'verified_fields' => 0,
                'created_at' => '2017-12-06 08:41:05',
                'modified_at' => '2017-12-06 08:41:05',
            ),
            2 => 
            array (
                'id' => 3,
                'email' => 'aaaaaa@gmail.com',
                'verified_fields' => 0,
                'created_at' => '2017-12-06 10:44:12',
                'modified_at' => '2017-12-06 10:44:12',
            ),
        ));
        
        
    }
}