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
