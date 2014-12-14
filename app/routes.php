<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

#Homepage
Route::get('/', function()
{
	return View::make('index');
});


Route::get('/classes', function() {
    echo Paste\Pre::render(get_declared_classes(),'');
});

Route::get('/', 'IndexController@getIndex');

Route::get('/recipe', 'RecipeController@getIndex');

Route::get('/recipe/create', 'RecipeController@getCreate');
Route::post('/recipe/create', 'RecipeController@postCreate');

Route::get('/recipe/edit/{id}', 'RecipeController@getEdit');
Route::post('/recipe/edit', 'RecipeController@postEdit');

Route::post('/recipe/delete', 'RecipeController@postDelete');

Route::get('/truncate', function() {

    # Clear the tables to a blank slate
    DB::statement('SET FOREIGN_KEY_CHECKS=0'); # Disable FK constraints so that all rows can be deleted, even if there's an associated FK
    DB::statement('TRUNCATE recipes');
    DB::statement('TRUNCATE authors');
    DB::statement('TRUNCATE ingredients');
    DB::statement('TRUNCATE tags');
    DB::statement('TRUNCATE recipe_tag');
    DB::statement('TRUNCATE recipe_ingredient');
});

Route::get('/practice-creating', function() {

    $author = new Author;
    $author->name = 'Chef BOY RD';
    $author->save();

    $tag = new Tag;
$tag->name = 'dessert';
$tag->save();

$ingredient = new Ingredient;
$ingredient->name = 'flour';
$ingredient->save();

    $recipe = new Recipe();

    # Set 
    $recipe->recipeName = 'Cookies';
    $recipe->author()->associate($author);
    $recipe->directions = 'mix ingredients and bake at 375';

    # This is where the Eloquent ORM magic happens
    $recipe->save();

$recipe->tags()->attach($tag);
$recipe->ingredients()->attach($ingredient);

    return 'A new recipe has been added! Check your database to see...';

});
