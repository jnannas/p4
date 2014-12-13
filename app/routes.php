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

Route::get('/lorem-ipsum', function()
{
	$paragraph = 0;
	return View::make('lorem-ipsum')->with('paragraph', $paragraph);
});

Route::post('/lorem-ipsum', function()
{
	$paragraph = Input::get("paragraphs");
	return View::make('lorem-ipsum')->with('paragraph', $paragraph);
});

Route::get('/user-generator', function()
{
	$user = 0;
	$birthdateOpt = "";
	$profileOpt = "";
	return View::make('user-generator')->with('user', $user)->with('birthdateOpt', $birthdateOpt)
	->with('profileOpt', $profileOpt);
});

Route::post('/user-generator', function()
{
	$user = Input::get('users');
	$birthdateOpt = Input::get("birthdate");
	if ($birthdateOpt == "on") {
		$birthdateOpt = "checked";
	}
	$profileOpt = Input::get('profile');
	if ($profileOpt == "on") {
		$profileOpt = "checked";
	}
	return View::make('user-generator')->with('user', $user)
	->with('birthdateOpt', $birthdateOpt)->with('profileOpt', $profileOpt);
});
Route::get('mysql-test', function() {

    # Print environment
    echo 'Environment: '.App::environment().'<br>';

    # Use the DB component to select all the databases
    $results = DB::select('SHOW DATABASES;');

    # If the "Pre" package is not installed, you should output using print_r instead
    echo Pre::render($results);

});
Route::get('/debug', function() {

    echo '<pre>';

    echo '<h1>environment.php</h1>';
    $path   = base_path().'/environment.php';

    try {
        $contents = 'Contents: '.File::getRequire($path);
        $exists = 'Yes';
    }
    catch (Exception $e) {
        $exists = 'No. Defaulting to `production`';
        $contents = '';
    }

    echo "Checking for: ".$path.'<br>';
    echo 'Exists: '.$exists.'<br>';
    echo $contents;
    echo '<br>';

    echo '<h1>Environment</h1>';
    echo App::environment().'</h1>';

    echo '<h1>Debugging?</h1>';
    if(Config::get('app.debug')) echo "Yes"; else echo "No";

    echo '<h1>Database Config</h1>';
    print_r(Config::get('database.connections.mysql'));

    echo '<h1>Test Database Connection</h1>';
    try {
        $results = DB::select('SHOW DATABASES;');
        echo '<strong style="background-color:green; padding:5px;">Connection confirmed</strong>';
        echo "<br><br>Your Databases:<br><br>";
        print_r($results);
    } 
    catch (Exception $e) {
        echo '<strong style="background-color:crimson; padding:5px;">Caught exception: ', $e->getMessage(), "</strong>\n";
    }

    echo '</pre>';

});
Route::get('/get-environment',function() {

    echo "Environment: ".App::environment();

});
Route::get('/trigger-error',function() {

    # Class Foobar should not exist, so this should create an error
    $foo = new Foobar;

});
