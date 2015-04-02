<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTestsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuarios_examenes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->decimal('nota');
			$table->text('resultado');
			$table->string('estado');
			$table->datetime('fecha');
			$table->integer('correctas');
			$table->integer('incorrectas');
			$table->integer('sin_responder');
			$table->string('id_firma');
			

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
		Schema::drop('usuarios_examenes');
	}

}
