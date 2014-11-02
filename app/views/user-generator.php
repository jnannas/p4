<!DOCTYPE html>
<html>
<head>

	<title>Random User Generator</title>
	<meta charset='utf-8'>

	<link rel='stylesheet' href='/css/style.css' type='text/css'>

</head>
<body>
	<a href='/'>&larr; Back to Home </a>

	<h1>Random User Generator</h1>
	
	<form method='POST'>

		<label for="users">How many users:</label>
		<input maxlength="2" name="users" type='text' value="<?php echo $user ?>" id="users"> (Max:99)
		<p>Include:</p>
		<input type="checkbox" name="birthdate" id="birthdate" <?php echo $birthdateOpt ?>>
		<label for='birthdate'>Birthdate</label>
		<br/>
		<input type="checkbox" name="profile" id="profile" <?php echo $profileOpt ?>>
		<label for='profile'>Profile</label>
		<br/>
		<br/>
		<input type="submit" value="Generate">

	</form>
	<br/>



	<?php
		$faker = Faker\Factory::create();
		echo "<ul>";
		For ($i=0; $i < $user; $i++) {
			echo "<li>";
			echo $faker->name;
			if ($birthdateOpt == "checked"){
				echo "<br/>";
				echo $faker->date;
			}
			if ($profileOpt == "checked"){
				echo "<br/>";
				echo $faker->text;
			}
			echo "</li>";
		}
		echo "</ul>"
	?>

</body>
</html>