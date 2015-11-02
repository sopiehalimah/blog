<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('posts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('idpengguna');
			$table->date('tanggal');
			$table->time('jam');
			$table->string('judul');
			$table->string('isi');
			//$table->integer('hapus');
			$table->string('tag');
			$table->string('slug');
			$table->string('sampul');
			$table->timestamps();
			$table->softDeletes();

			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('posts');
	}

}
