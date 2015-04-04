<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersRegisterTestTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('alumnos_matriculados_examenes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('estado');

			$table->integer('usuario_id')->unsigned();
			$table->integer('examen_id')->unsigned();

			$table->foreign('usuario_id')
				  ->references('id')
				  ->on('usuarios')
				  ->onDelete('cascade');

			$table->foreign('examen_id')
				  ->references('id')
				  ->on('examenes')
				  ->onDelete('cascade');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('alumnos_matriculados_examenes');
	}

}
