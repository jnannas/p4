@extends('_master')

@section('title')
	Create New Recipe
@stop

@section('content')
	<h1>Edit Recipe Elements</h1>
	<p>Select a value to delete it or enter a new value in the text boxes below.</p>
	{{ Form::open(array('url' => '/recipe/elements/edit')) }}
		{{ Form::label('author_id', 'Author') }}
		{{ Form::select('author_id', $authors); }}
		<br/>
		{{ Form::label('newAuthor', 'Input a New Author:') }}
		{{ FORM::text('newAuthor'); }}
		<br/>
		<h3>Ingredients</h3>
		@foreach($ingredients as $id => $ingredient)
			{{ Form::checkbox('ingredients[]', $id); }} {{ $ingredient }}
		@endforeach
		<br/>
		{{ Form::label('newIngredient', 'Input a New Ingredient:') }}
		{{ FORM::text('newIngredient'); }}
		<br/>
		<h3>Recipe Tags</h3>
		@foreach($tags as $id => $tag)
			{{ Form::checkbox('tags[]', $id); }} {{ $tag }}
		@endforeach
		<br/>
		{{ Form::label('newTag', 'Input a New Tag:') }}
		{{ FORM::text('newTag'); }}
		<br/>
		<br/>
		{{ Form::submit('Submit Changes'); }}

@stop