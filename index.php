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
		<h1>Movies Extracted From The Rotten Tomatoes Database Using The Rotten Tomatoes API</h1>
		<h2>The below movies have been extracted from The Rotten Tomatoes database using the search words of Red, Green, Blue, and Yellow. The colour of the movie matches the first searched keyword. The movie's year and runtime are also listed.</h2><br>
	</header>


<?php
	
	// function to extract data from the Rotten Tomatoes database
	function displayShow($colour){

		$apikey = '6qvrmbehyspcu57hma2q222z';

		$q = urlencode($colour);

		// setting the API endpoint
		$endpoint = 'http://api.rottentomatoes.com/api/public/v1.0/movies.json?apikey=' . $apikey . '&q=' . $q;

		// using cURL to make the http request to access data from the outside web page
		$session = curl_init($endpoint);

		curl_setopt($session, CURLOPT_RETURNTRANSFER, true);

		$data = curl_exec($session);

		curl_close($session);

		$search_results = json_decode($data);

		if ($search_results === NULL) die('Error parsing json');

		$movies = $search_results->movies;

		echo '<ul>';

		foreach ($movies as $movie) {

?>

<!-- displaying the results in HTML and CSS -->
<h3 style="color:<?php echo $colour; ?>; list-style: none;"><?php echo '<li> Title: ' . $movie->title . " /   Year: " . $movie->year . " /   Runtime: " . $movie->runtime . " minutes </li>"; ?></h3>
	
<?php
		}

		echo '</ul>';

}

		// calling the displayShow function
		displayShow("red");
		displayShow("green");
		displayShow("blue");
		displayShow("yellow");
?>
	
</body>
</html>
