<?php

use Illuminate\Database\Seeder;

class UserTestTableSeeder extends Seeder {

    public function run()
    {
        DB::table('usuarios_examenes')->delete();

        //User::create(['email' => 'foo@bar.com']);

        \DB::table('usuarios_examenes')->insert(array(
        		'usuario_id'	=>	1,
        		'examen_id'		=>	1,
        		'nota'			=>	'',
        		'resultado'		=>	'',
        		'estado'		=>	'activo'
        	));
    }

}
