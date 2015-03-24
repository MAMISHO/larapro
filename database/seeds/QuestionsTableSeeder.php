<?php

use Illuminate\Database\Seeder;

class QuestionsTableSeeder extends Seeder {

    public function run()
    {
        DB::table('preguntas')->delete();

        //User::create(['email' => 'foo@bar.com']);

        \DB::table('preguntas')->insert(array(
        		'examen_id'	=>	1,
        		'pregunta'	=>	'La Administración Electrónica...',
        		'resp_a'	=>	'Implica el uso de las TIC en las Administraciones Públicas.',
        		'resp_b'	=>	'Requiere cambios organizativos.',
        		'resp_c'	=>	'Nuevas capacidades en los empleados públicos.',
        		'resp_d'	=>	'Todas las anteriores.',
        		'correcta'	=>	'resp_d'
        	));

        \DB::table('preguntas')->insert(array(
        		'examen_id'	=>	1,
        		'pregunta'	=>	'Una infraestructura de clave pública es el conjunto de elementos hardware y software,...',
        		'resp_a'	=>	'Así como políticas y procedimientos que permiten llevar a cabo la gestión de las aplicaciones de administración electrónica.',
        		'resp_b'	=>	'Que permiten gestionar el ciclo de vida de los certificados digitales.',
        		'resp_c'	=>	'Así como políticas y procedimientos que permiten llevar a cabo la gestión y el control de vida de los certificados digitales.',
        		'resp_d'	=>	'Ninguna de las anteriores es correcta.',
        		'correcta'	=>	'resp_b'
        	));

        \DB::table('preguntas')->insert(array(
        		'examen_id'	=>	1,
        		'pregunta'	=>	'¿Quién mantiene actualizada la CRL?',
        		'resp_a'	=>	'La Autoridad de Certificación.',
        		'resp_b'	=>	'La Autoridad de Registro.',
        		'resp_c'	=>	'La Autoridad de Revocación.',
        		'resp_d'	=>	'Los poseedores de un certificado digital.',
        		'correcta'	=>	'resp_a'
        	));

        // \DB::table('preguntas')->insert(array(
        // 		'examen_id'	=>	1,
        // 		'pregunta'	=>	'',
        // 		'resp_a'	=>	'',
        // 		'resp_b'	=>	'',
        // 		'resp_c'	=>	'',
        // 		'resp_d'	=>	'',
        // 		'correcta'	=>	''
        // 	));

    }

}
