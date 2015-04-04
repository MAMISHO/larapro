<?php

use Illuminate\Database\Seeder;

class UserRegisterTestTableSeeder extends Seeder {

    public function run()
    {
        DB::table('alumnos_matriculados_examenes')->delete();

        //item 1
        
        for ($i=1; $i < 6; $i++) { 
        	for ($j=1; $j < 6; $j++) { 
        		\DB::table('alumnos_matriculados_examenes')->insert(array(
	        		'usuario_id'	=>	$i,
	        		'examen_id'		=>	$j,
	        		'estado'		=>	'no_superado'
	        	));
        	}
        }

        // //item 1
        // \DB::table('usuarios_examenes')->insert(array(
        //         'usuario_id'    =>  1,
        //         'examen_id'     =>  2,
        //         'nota'          =>  '',
        //         'resultado'     =>  '',
        //         'estado'        =>  'activo'
        //     ));

        // //item 1
        // \DB::table('usuarios_examenes')->insert(array(
        //         'usuario_id'    =>  1,
        //         'examen_id'     =>  3,
        //         'nota'          =>  '',
        //         'resultado'     =>  '',
        //         'estado'        =>  'activo'
        //     ));

        // //item 1
        // \DB::table('usuarios_examenes')->insert(array(
        //         'usuario_id'    =>  1,
        //         'examen_id'     =>  4,
        //         'nota'          =>  '',
        //         'resultado'     =>  '',
        //         'estado'        =>  'activo'
        //     ));

        // //item 1
        // \DB::table('usuarios_examenes')->insert(array(
        //         'usuario_id'    =>  1,
        //         'examen_id'     =>  5,
        //         'nota'          =>  '',
        //         'resultado'     =>  '',
        //         'estado'        =>  'activo'
        //     ));

        // //item 1
        // \DB::table('usuarios_examenes')->insert(array(
        //         'usuario_id'    =>  2,
        //         'examen_id'     =>  1,
        //         'nota'          =>  '',
        //         'resultado'     =>  '',
        //         'estado'        =>  'activo'
        //     ));

        // //item 1
        // \DB::table('usuarios_examenes')->insert(array(
        //         'usuario_id'    =>  2,
        //         'examen_id'     =>  2,
        //         'nota'          =>  '',
        //         'resultado'     =>  '',
        //         'estado'        =>  'activo'
        //     ));

        // //item 1
        // \DB::table('usuarios_examenes')->insert(array(
        //         'usuario_id'    =>  2,
        //         'examen_id'     =>  3,
        //         'nota'          =>  '',
        //         'resultado'     =>  '',
        //         'estado'        =>  'activo'
        //     ));

        // //item 1
        // \DB::table('usuarios_examenes')->insert(array(
        //         'usuario_id'    =>  2,
        //         'examen_id'     =>  4,
        //         'nota'          =>  '',
        //         'resultado'     =>  '',
        //         'estado'        =>  'activo'
        //     ));

        // //item 1
        // \DB::table('usuarios_examenes')->insert(array(
        //         'usuario_id'    =>  2,
        //         'examen_id'     =>  5,
        //         'nota'          =>  '',
        //         'resultado'     =>  '',
        //         'estado'        =>  'activo'
        //     ));
    }

}