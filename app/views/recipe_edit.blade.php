@extends('_master')

@section('title')
	Edit
@stop

@section('head')

@stop

@section('content')

	<h1>Edit {{{ $recipe['recipeName'] }}} </h1>
	<p>Don't see what you need:<br/>
	<a href='/recipe/elements/edit'>Edit Authors/Ingredients/Tags</a>

	{{---- EDIT -----}}
	{{ Form::open(array('url' => '/recipe/edit')) }}

		{{ Form::hidden('id',$recipe['id']); }}

		<div class='form-group'>
			{{ Form::label('recipeName','Recipe Name') }}
			{{ Form::text('recipeName', $recipe['recipeName']); }}
		</div>

		<div class='form-group'>
			{{ Form::label('author_id', 'Author') }}
			{{ Form::select('author_id', $authors, $recipe->author_id); }}
		</div>

		<div class='form-group'>
			@foreach($ingredients as $id => $ingredient)
				{{ Form::checkbox('ingredients[]', $id, $recipe->ingredients->contains($id)); }} {{ $ingredient }}
				&nbsp;&nbsp;&nbsp;
			@endforeach
		</div>

		<div class='form-group'>
			{{ Form::label('directions','Directions') }}
			{{ Form::textarea('directions',$recipe['directions']); }}
		</div>

		<div class='form-group'>
			@foreach($tags as $id => $tag)
				{{ Form::checkbox('tags[]', $id, $recipe->tags->contains($id)); }} {{ $tag }}
				&nbsp;&nbsp;&nbsp;
			@endforeach
		</div>

		{{ Form::submit('Save'); }}
		<br/>
		<br/>
	{{ Form::close() }}

	<div>
		{{---- DELETE -----}}
		{{ Form::open(array('url' => '/recipe/delete')) }}
			{{ Form::hidden('id',$recipe['id']); }}
			<button onClick='parentNode.submit();return false;'>Delete</button>
		{{ Form::close() }}
	</div>


@stop