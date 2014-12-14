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

	<a href='https://github.com/jwnannas/p4'>Github Repository</a>
	<br/>
	<a href='/recipe'>Home</a>
	@yield('content')

	@yield('/body')

</body>
</html>
