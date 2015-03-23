<<<<<<< Updated upstream
<?php 

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder{

	public function run(){

		\DB::table('usuarios')->insert(array(
				'id'		=> 1,
				'nombre'	=> 'Edwin Mauricio',
				'apellidos'	=> 'Quispe Maldonado',
				'dni'		=> '54223798D',
				'usuario'	=> 'edwin',
				'matriz'	=> 123,
				'clave'		=> \Hash::make('edwin')
			));
	}


}
 ?>
=======
<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder {

    public function run()
    {
        //DB::table('users')->delete();

        //User::create(['email' => 'foo@bar.com']);

        \DB::table('usuarios')->insert(array(
        		'nombre'		=>	'Mauricio',
        		'apellidos'		=>	'Quishpe Maldonado',
        		'dni'			=>	'53425364N',
        		'usuario'		=>	'mauricio',
        		'clave'			=>	\Hash::make('12345'),
        		'matriz'		=>	123
        	));
    }

}
>>>>>>> Stashed changes
