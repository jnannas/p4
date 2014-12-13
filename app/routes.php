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

Route::get('/practice-creating', function() {

    $author = new Author;
    $author->name = 'Alton Brown';
    $author->save();

    $ingredient = new Ingredient;
    $ingredient->name = 'flour';
    $ingredient->save();

    $tag = new Tag;
    $tag->name = 'dessert';
    $tag->save();

    # Instantiate a new recipe model class
    $recipe = new Recipe();

    # Set 
    $recipe->recipeName = 'Cookies';
    $recipe->directions = 'mix ingredients and bake at 375';
    $recipe->author()->associate($author);
    # This is where the Eloquent ORM magic happens
    $recipe->save();

    $recipe->ingredients()->attach($ingredient);
    $recipe->tags()->attach($tag);
    return 'A new recipe has been added! Check your database to see...';

});

Route::get('/practice-reading', function() {

$recipes = Recipe::with('tags','author')->get(); 

foreach($recipes as $recipe) {

    echo $recipe->recipeName.' by '.$recipe->author->name.'<br>';
    foreach($recipe->tags as $tag) {
        echo $tag->name.", ";
        }
    foreach($recipe->ingredients as $ingredient) {
        echo $ingredient->name.", ";
        }
    echo "<br><br>";

}

});

Route::get('/practice-updating', function() {

    # First get a recipe to update
    $recipe = Recipe::where('recipeName', 'LIKE', '%Cookies%')->first();

    # If we found the recipe, update it
    if($recipe) {

        # Give it a different title
        $recipe->recipeName = 'Chocolate Chip Cookies';

        # Save the changes
        $recipe->save();

        return "Update complete; check the database to see if your update worked...";
    }
    else {
        return "recipe not found, can't update.";
    }

});

Route::get('/practice-deleting', function() {

    # First get a recipe to delete
    $recipe = Recipe::where('recipeName', 'LIKE', '%Chocolate Chip Cookies%')->first();

    # If we found the recipe, delete it
    if($recipe) {

        # Goodbye!
        $recipe->delete();

        return "Deletion complete; check the database to see if it worked...";

    }
    else {
        return "Can't delete - recipe not found.";
    }

});

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
