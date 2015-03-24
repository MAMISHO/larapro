<?php

use Illuminate\Database\Seeder;

class TestTableSeeder extends Seeder {

    public function run()
    {
        DB::table('examenes')->delete();

        //User::create(['email' => 'foo@bar.com']);

        \DB::table('examenes')->insert(array(
        		'nombre'		=>	'Administración electrónica',
        		'codigo'		=>	'AE2015'
        	));
    }

}
