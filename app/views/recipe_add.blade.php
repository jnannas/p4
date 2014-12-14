@extends('_master')

@section('title')
	Create New Recipe
@stop

@section('content')
	<h1>Create a new recipe</h1>

	{{ Form::open(array('url' => '/recipe/create')) }}

		{{ Form::label('recipeName','Recipe Name') }}
		{{ Form::text('recipeName'); }}
		<br/>
		{{ Form::label('author_id', 'Author') }}
		{{ Form::select('author_id', $authors); }}

		<br/>
		<h3>Ingredents</h3>
		@foreach($ingredients as $id => $ingredient)
			{{ Form::checkbox('ingredients[]', $id); }} {{ $ingredient }}
		@endforeach
		<br/>
		<h3>Directions</h3>
		{{ Form::textarea('directions'); }}
		<br/>
		<h3>Recipe Tags</h3>
		@foreach($tags as $id => $tag)
			{{ Form::checkbox('tags[]', $id); }} {{ $tag }}
		@endforeach

		<br/>
		<br/>
		{{ Form::submit('Create Recipe'); }}

	{{ Form::close() }}

@stop