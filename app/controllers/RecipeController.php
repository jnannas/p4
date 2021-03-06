<?php

class RecipeController extends \BaseController {

	public function __construct() {
		parent::__construct();
	}

	public function getIndex()
	{
		
		$format = Input::get('format', 'html');
		$query  = Input::get('query');
		$recipes = Recipe::search($query);
	
		if($format == 'html') {
			return View::make('recipe_index')
				->with('recipes', $recipes)
				->with('query', $query);
		}
	}

	public function getEditElement()
	{
		$authors = Author::getIdNamePair();
		$tags = Tag::getIdNamePair();
		$ingredients = Ingredient::getIdNamePair();
		return View::make('element_edit')
		    ->with('authors',$authors)
    		->with('tags',$tags)
    		->with('ingredients', $ingredients);
	}

	public function postEditElement()
	{
		if(!empty($_POST['newAuthor'])){
		$author = new Author;
   		$author->name = Input::get('newAuthor');
    	$author->save();
	}
	if(!empty($_POST['newIngredient'])){
		$ingredient = new Ingredient;
   		$ingredient->name = Input::get('newIngredient');
    	$ingredient->save();
	}
	if(!empty($_POST['newTag'])){
		$tag = new Tag;
   		$tag->name = Input::get('newTag');
    	$tag->save();
	}
	if(Input::get('author_id')!=1){
		Author::destroy(Input::get('author_id'));
	}
	if(isset($_POST['ingredients'])){
		foreach(Input::get('ingredients') as $ingredient) {
			Ingredient::destroy($ingredient);
		}
	}
	if(isset($_POST['tags'])){
		foreach(Input::get('tags') as $tag) {
			Tag::destroy($tag);
		}
	}
		return Redirect::back()->with('flash_message','Changes Made.');  
	}


	public function getCreate()
	{
			$authors = Author::getIdNamePair();
		$tags = Tag::getIdNamePair();
		$ingredients = Ingredient::getIdNamePair();

    	return View::make('recipe_add')
    		->with('authors',$authors)
    		->with('tags',$tags)
    		->with('ingredients', $ingredients);
	}


	public function postCreate() {

		$recipe = new Recipe();
		$recipe->fill(Input::except('tags','ingredients'));
	
		$recipe->save();
		if(isset($_POST['tags'])){
		foreach(Input::get('tags') as $tag) {
			$recipe->tags()->save(Tag::find($tag));
		}
	}
		if(isset($_POST['ingredients'])){
		foreach(Input::get('ingredients') as $ingredient) {
			$recipe->ingredients()->save(Ingredient::find($ingredient));
		}
	}
		return Redirect::action('RecipeController@getIndex')->with('flash_message','Your recipe has been added.');
	}

	public function getEdit($id) {
		try {
			
			$authors = Author::getIdNamePair();
		    $recipe = Recipe::with('tags')->findOrFail($id);
		    $tags = Tag::getIdNamePair();
		    $ingredients = Ingredient::getIDNamePair();
		}
		catch(exception $e) {
		    return Redirect::to('/recipe')->with('flash_message', 'Recipe not found');
		}
    	return View::make('recipe_edit')
    		->with('recipe', $recipe)
    		->with('authors', $authors)
    		->with('tags', $tags)
    		->with('ingredients', $ingredients);
	}


	public function postEdit() {
		try {
	        $recipe = Recipe::with('tags','ingredients')->findOrFail(Input::get('id'));
	    }
	    catch(exception $e) {
	        return Redirect::to('/recipe')->with('flash_message', 'Recipe not found');
	    }

	    	try {
		    	$recipe->fill(Input::except('tags', 'ingredients'));
		    	$recipe->save();

		    	if(!isset($_POST['tags'])) $_POST['tags'] = array();
		    	$recipe->updateTags($_POST['tags']);

		    	if(!isset($_POST['ingredients'])) $_POST['ingredients'] = array();
		    	$recipe->updateIngredients($_POST['ingredients']);

		   		return Redirect::action('RecipeController@getIndex')->with('flash_message','Changes Saved.');
	
		 	}
		 	catch(exception $e) {
	        return Redirect::to('/recipe')->with('flash_message', 'Error saving changes.');
	    	}

	}

	public function postDelete() {
		try {
	        $recipe = Recipe::findOrFail(Input::get('id'));
	    }
	    catch(exception $e) {
	        return Redirect::to('/recipe/')->with('flash_message', 'Could not delete recipe - not found.');
	    }
	    Recipe::destroy(Input::get('id'));
	    return Redirect::to('/recipe/')->with('flash_message', 'Recipe deleted.');
	}
}