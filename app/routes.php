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

    # Instantiate a new recipe model class
    $recipe = new Recipe();

    # Set 
    $recipe->recipeName = 'Cookies';
    $recipe->ingredients = 'flour, eggs, sugar';
    $recipe->directions = 'mix ingredients and bake at 375';

    # This is where the Eloquent ORM magic happens
    $recipe->save();

    return 'A new recipe has been added! Check your database to see...';

});

Route::get('/practice-reading', function() {

    # The all() method will fetch all the rows from a Model/table
    $recipes = Recipe::all();

    # Make sure we have results before trying to print them...
    if($recipes->isEmpty() != TRUE) {

        # Typically we'd pass $recipes to a View, but for quick and dirty demonstration, let's just output here...
        foreach($recipes as $recipe) {
            echo $recipe->recipeName.'<br>';
        }
    }
    else {
        return 'No recipes found';
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