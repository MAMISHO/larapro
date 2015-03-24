<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('preguntas')->delete();

        //User::create(['email' => 'foo@bar.com']);

        \DB::table('preguntas')->insert(array(
        		'examen_id'		=>	1,
        		'pregunta'		=>	'La Administración Electrónica...',
        		'respuesta1'	=>	'Implica el uso de las TIC en las Administraciones Públicas.',
        		'respuesta2'	=>	'Requiere cambios organizativos.',
        		'respuesta3'	=>	'Nuevas capacidades en los empleados públicos.',
        		'correcta'		=>	'Todas las anteriores.'
        	));
    }

}
