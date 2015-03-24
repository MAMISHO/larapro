<?php

use Illuminate\Database\Seeder;

class UserTestTableSeeder extends Seeder {

    public function run()
    {
        DB::table('usuarios_examenes')->delete();

        //item 1
        \DB::table('usuarios_examenes')->insert(array(
        		'usuario_id'	=>	1,
        		'examen_id'		=>	1,
        		'nota'			=>	'',
        		'resultado'		=>	'',
        		'estado'		=>	'activo'
        	));

        //item 1
        \DB::table('usuarios_examenes')->insert(array(
                'usuario_id'    =>  1,
                'examen_id'     =>  2,
                'nota'          =>  '',
                'resultado'     =>  '',
                'estado'        =>  'activo'
            ));

        //item 1
        \DB::table('usuarios_examenes')->insert(array(
                'usuario_id'    =>  1,
                'examen_id'     =>  3,
                'nota'          =>  '',
                'resultado'     =>  '',
                'estado'        =>  'activo'
            ));

        //item 1
        \DB::table('usuarios_examenes')->insert(array(
                'usuario_id'    =>  1,
                'examen_id'     =>  4,
                'nota'          =>  '',
                'resultado'     =>  '',
                'estado'        =>  'activo'
            ));

        //item 1
        \DB::table('usuarios_examenes')->insert(array(
                'usuario_id'    =>  1,
                'examen_id'     =>  5,
                'nota'          =>  '',
                'resultado'     =>  '',
                'estado'        =>  'activo'
            ));

        //item 1
        \DB::table('usuarios_examenes')->insert(array(
                'usuario_id'    =>  2,
                'examen_id'     =>  1,
                'nota'          =>  '',
                'resultado'     =>  '',
                'estado'        =>  'activo'
            ));

        //item 1
        \DB::table('usuarios_examenes')->insert(array(
                'usuario_id'    =>  2,
                'examen_id'     =>  2,
                'nota'          =>  '',
                'resultado'     =>  '',
                'estado'        =>  'activo'
            ));

        //item 1
        \DB::table('usuarios_examenes')->insert(array(
                'usuario_id'    =>  2,
                'examen_id'     =>  3,
                'nota'          =>  '',
                'resultado'     =>  '',
                'estado'        =>  'activo'
            ));

        //item 1
        \DB::table('usuarios_examenes')->insert(array(
                'usuario_id'    =>  2,
                'examen_id'     =>  4,
                'nota'          =>  '',
                'resultado'     =>  '',
                'estado'        =>  'activo'
            ));

        //item 1
        \DB::table('usuarios_examenes')->insert(array(
                'usuario_id'    =>  2,
                'examen_id'     =>  5,
                'nota'          =>  '',
                'resultado'     =>  '',
                'estado'        =>  'activo'
            ));
    }

}
