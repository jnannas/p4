<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTables extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
	
		Schema::create('authors', function($table) {

			$table->increments('id');

			$table->timestamps();

			$table->string('name');

		});

		# Create the books table
		Schema::create('recipes', function($table) {
			
			# AI, PK
			$table->increments('id');
			
			# created_at, updated_at columns
			$table->timestamps();
			
			# General data...
			$table->string('recipeName');
			$table->integer('author_id')->unsigned(); # Important! FK has to be unsigned because the PK it will reference is auto-incrementing
			$table->string('directions');
			
			# Define foreign keys...
			$table->foreign('author_id')->references('id')->on('authors');
			
								
		});
		
		
		# Create the tags table
		Schema::create('tags', function($table) {
			
			# AI, PK
			$table->increments('id');
			
			# created_at, updated_at columns
			$table->timestamps();
			
			# General data....
			$table->string('name', 64);
			
			
		});
		
		# Create pivot table connecting `books` and `tags`
		Schema::create('recipe_tag', function($table) {

			# AI, PK
			# none needed

			# General data...
			$table->integer('recipe_id')->unsigned();
			$table->integer('tag_id')->unsigned();
			
			# Define foreign keys...
			$table->foreign('recipe_id')->references('id')->on('recipes');
			$table->foreign('tag_id')->references('id')->on('tags');
			
		});

		Schema::create('ingredients', function($table) {
			
			# AI, PK
			$table->increments('id');
			
			# created_at, updated_at columns
			$table->timestamps();
			
			# General data....
			$table->string('name', 64);
			
			
		});

		Schema::create('recipe_ingredient', function($table) {

			# AI, PK
			# none needed

			# General data...
			$table->integer('recipe_id')->unsigned();
			$table->integer('ingredient_id')->unsigned();
			
			# Define foreign keys...
			$table->foreign('recipe_id')->references('id')->on('recipes');
			$table->foreign('ingredient_id')->references('id')->on('ingredients');
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('authors');
		Schema::drop('recipes');
		Schema::drop('tags');
		Schema::drop('recipe_tag');
		Schema::drop('ingredients');
		Schema::drop('recipe_ingredient');
	}
}