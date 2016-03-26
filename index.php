<!doctype html>
<html> 
<head> 

    <meta charset="utf-8" />
    <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" /> 	
	<link type="text/css" rel="stylesheet" href="style.css"/>

	<title>Jody's Coding Test</title>

</head> 

<body>

	<header>
		<h1>TV Show Titles Extracted From The TVMase Database Using The TVMase API</h1>
		<h2>The below TV shows have been extracted from the TVMase database using the search words of Red, Green, Blue, and Yellow. The colour of the show title matches the first searched keyword. The show's premier date and runtime are also listed if they are available from the database.</h2><br>
	</header>


<?php

	// function to extract data from the TVMase database
	function displayShow($colour){

		// using cURL to make the http request to access data from the outside web page
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, "http://api.tvmaze.com/search/shows?q=$colour");
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		curl_setopt($ch, CURLOPT_HEADER, FALSE);
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept: application/json"));
		$response = curl_exec($ch);
		curl_close($ch);
		$result = json_decode($response, true);

			// for loop to list the results
			for ($x = 0; $x < count($result); $x++) {

				// regex to identify the first keyword from each show name
				$str = $result[$x]['show']['name'];
				$regex = '/(Red|RED|red|Green|GREEN|green|Blue|BLUE|blue|Yellow|YELLOW|yellow)/';

				if (preg_match($regex, $str, $match))

?>

	<!-- displaying the results in html -->
	<h3 style="color:<?php echo $match[0]; ?>;"><?php echo $str ?></h3>
	<p>Date show premiered: <?php echo $result[$x]['show']['premiered'] ?></p>
	<p>Show runtime: <?php echo $result[$x]['show']['runtime'] ?> minutes</p><br>

<?php
	
	// closing the PHP
	}
	}
?>

	<!-- calling the displayShow() function with CSS styling -->
	<div class="red"><?php displayShow("red"); ?></div>
	<div class="green"><?php displayShow("green"); ?></div>
	<div class="blue"><?php displayShow("blue"); ?></div>
	<div class="yellow"><?php displayShow("yellow"); ?></div>
	
</body>
</html>
