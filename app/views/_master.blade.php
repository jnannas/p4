<!DOCTYPE html>
<html>
<head>

	<title>@yield('title','Recipe Manager')</title>
	<meta charset='utf-8'>

	<link href="//netdna.bootstrapcdn.com/bootswatch/3.1.1/flatly/bootstrap.min.css" rel="stylesheet">
	<link rel='stylesheet' href='/css/style.css' type='text/css'>

	@yield('head')


</head>
<body>

	@if(Session::get('flash_message'))
		<div class='flash-message'>{{ Session::get('flash_message') }}</div>
	@endif

	<nav class='navbar navbar-default' role='navigation'>
		<ul class="nav nav-pills">
			<li><a href='https://github.com/jnannas/p4'>Github Repository</a></li>
			<li><a href='/recipe'>Home</a></li>
			<li><a href='/recipe/create'>Create Recipe</a></li>
			<li><a href='/recipe/elements/edit'>Edit Recipe Elements</a></li>
		</ul>
	</nav>

	<div class="content">
	@yield('content')
	</div>

	@yield('/body')

</body>
</html>
