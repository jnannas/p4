<?php

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

Route::get('/recipe/elements/edit', 'RecipeController@getEditElement');
Route::post('/recipe/elements/edit', 'RecipeController@postEditElement');

Route::post('/author/create', 'AuthorController@store');
Route::post('/author/create', 'IngredientController@store');
Route::post('/author/create', 'TagController@store');

Route::get('/recipe/edit/{id}', 'RecipeController@getEdit');
Route::post('/recipe/edit', 'RecipeController@postEdit');

Route::post('/recipe/delete', 'RecipeController@postDelete');

Route::get('/truncate', function() {

    DB::statement('SET FOREIGN_KEY_CHECKS=0'); 
    DB::statement('TRUNCATE recipes');
    DB::statement('TRUNCATE authors');
    DB::statement('TRUNCATE ingredients');
    DB::statement('TRUNCATE tags');
    DB::statement('TRUNCATE recipe_tag');
    DB::statement('TRUNCATE recipe_ingredient');
});

