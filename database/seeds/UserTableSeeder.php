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
                'tipo'         =>  'usuario',
        		'matriz'		=>	'123,456,789,987,654,321,123,456;123,456,789,987,654,321,123,456;123,456,789,987,654,321,123,456;123,456,789,987,654,321,123,456;123,456,789,987,654,321,123,456;123,456,789,987,654,321,123,456;123,456,789,987,654,321,123,456;123,456,789,987,654,321,123,456;'
        	));
    }

}
