<?php

use Illuminate\Database\Seeder;

class TestTableSeeder extends Seeder {

    public function run()
    {
        DB::table('examenes')->delete();

        //examen 1
        \DB::table('examenes')->insert(array(
        		'nombre'		=>	'Administración electrónica',
        		'codigo'		=>	'AE2015'
        	));

        //examen 2
        \DB::table('examenes')->insert(array(
        		'nombre'		=>	'Diseño de Base de Datos',
        		'codigo'		=>	'DB2015'
        	));

        //examen 3
        \DB::table('examenes')->insert(array(
        		'nombre'		=>	'Inteligencia Artificial',
        		'codigo'		=>	'IA2015'
        	));

        //examen 4
        \DB::table('examenes')->insert(array(
        		'nombre'		=>	'Calidad Software',
        		'codigo'		=>	'CA2015'
        	));

        //examen 5
        \DB::table('examenes')->insert(array(
        		'nombre'		=>	'Seguridad Informática',
        		'codigo'		=>	'SI2015'
        	));

    }

}
