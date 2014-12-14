@extends('_master')

@section('title')
	Recipe Manager
@stop

@section('content')

	<h1>Recipe Manager</h1>

	<h2><a href="/recipe/create">Create New Recipe</a></h2>
	@if($query)
		<h2>You searched for {{{ $query }}}</h2>
	@endif

	@if(sizeof($recipes) == 0)
		No results
	@else

		@foreach($recipes as $recipe)
			<section class='recipe'>

				<h2>{{ $recipe['recipeName'] }}</h2>

				<p>
					<a href='/recipe/edit/{{$recipe['id']}}'>Edit</a>
				</p>

				<p>
					{{ $recipe['author']['name'] }} 
				</p>

				<p>
					@foreach($recipe['tags'] as $tag)
						<span class='tag'>{{{ $tag->name }}}</span>
					@endforeach
				</p>
			</section>
		@endforeach

	@endif

@stop

