<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('preguntas', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('pregunta');
			$table->string('respuesta1');
			$table->string('respuesta2');
			$table->string('respuesta3');
			$table->string('correcta');

			$table->integer('examen_id')->unsigned();

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
		Schema::drop('preguntas');
	}

}
