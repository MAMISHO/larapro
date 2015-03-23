<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

    public function run()
    {
        DB::table('usuarios')->delete();

        //User::create(['email' => 'foo@bar.com']);

        \DB::table('usuarios')->insert(array(
        		'nombre'		=>	'Mauricio',
        		'apellidos'		=>	'Quishpe Maldonado',
        		'dni'			=>	'53425364N',
        		'usuario'		=>	'mauricio',
        		'clave'			=>	\Hash::make('12345'),
        		'matriz'		=>	'123,456,789;123,456,789;123,456,789;'
        	));
    }

}
