<!DOCTYPE html>
<html>
<head>

	<title>@yield('title','Recipes')</title>
	<meta charset='utf-8'>

	<link href="//netdna.bootstrapcdn.com/bootswatch/3.1.1/flatly/bootstrap.min.css" rel="stylesheet">
	<link rel='stylesheet' href='/css/foobooks.css' type='text/css'>

	@yield('head')


</head>
<body>

	@if(Session::get('flash_message'))
		<div class='flash-message'>{{ Session::get('flash_message') }}</div>
	@endif

	<nav>
		<ul>
			<li><a href='/recipe/create'>Add Book</a></li>
		</ul>
	</nav>

	<a href='https://github.com/jwnannas/p4'>View on Github</a>

	@yield('content')

	@yield('/body')

</body>
</html>
