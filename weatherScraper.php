<?php include "displayHTML.php"; ?>
<?php include "withoutAccent.php"; ?>

<?php

	$weather = '';
	$err = '';
	$typed_city = '';

	if(array_key_exists("city", $_GET)) {
		$typed_city = $_GET["city"];
		// formating the city name
		$city__ = preg_replace("/\s+/", "-", $_GET["city"]);
		$city_ = strtr($city__, $without_accent);
		$city = strtolower($city_);
		$_GET["city"] = $city;
		// checking if the page is loaded
		$url = "https://www.weather-forecast.com/locations/$city/forecasts/latest";
		$headers = @get_headers($url);
		if($headers[0] !== "HTTP/1.1 404 Not Found" && $headers[20] !== "Status: 404 Not Found") {
			$forecatsPage = file_get_contents($url);
			$cut1 = explode('</div><a class="forecast-magellan-target" name="forecast-part-0"><div data-magellan-destination="forecast-part-0"></div></a><p class="summary">', $forecatsPage);
			// checking if split ok 1
			if(sizeof($cut1) > 1) {
				$cut2 = explode('</span></span></span></p><div class="forecast-cont"><div class="units-cont"><a class="units metric active">', $cut1[1]);
				// checking if split ok 2
				if(sizeof($cut2) > 1) {
					$finalCut = $cut2[0];
					// formating the msg
					$splitted = explode(":", $finalCut);
					$title = $splitted[0];
					$body = $splitted[1];
					$str = $title."<br>".$body;
					$weather = display("div", $str, ['class="alert alert-info my-4"', 'role="alert"']);
				} else {
					$str = "Sorry, something went wrong with our system, please try later.";
					$err = display("div", $str, ['class="alert alert-danger my-4"', 'role="alert"']);
				}
			} else {
				$str = "Sorry, something went wrong with our system, please try later.";
				$err = display("div", $str, ['class="alert alert-danger my-4"', 'role="alert"']);
			}
		} else {
			$str = "City not found. Make sure that this city exists.";
			$err = display("div", $str, ['class="alert alert-danger my-4"', 'role="alert"']);
		}
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Weather Scraper</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/css/bootstrap.min.css" integrity="sha384-Zug+QiDoJOrZ5t4lssLdxGhVrurbmBWopoEl+M6BdEfwnCJZtKxi1KgxUyJq13dy" crossorigin="anonymous">
	<style type="text/css">

		.container-fluid {
			height: 100vh;
			display: flex;
			align-items: center;
			background: url(https://goo.gl/PxNrMv) center center fixed no-repeat;
			background-size: cover;
		}

		.container {
			text-align: center;
			color: white;
		}

		.text-shadow {
			text-shadow: 
			0px 4px 3px rgba(0,0,0,0.4),
			0px 8px 13px rgba(0,0,0,0.1),
			0px 18px 23px rgba(0,0,0,0.1);
		}

		input.form-control {
			width: 320px;
			font-size: 1.3em;
			text-align: center;
			margin: 0 auto;
		}

		.alert {
			width: 320px;
			margin: 0 auto;
		}

		.alert b {
			display: block;
			margin-bottom: 0.5em;
		}

	</style>
</head>
<body>

	<div class="container-fluid">
		<div class="container">
			<h1 class="display-3 text-shadow">What's The Weather</h1>
			<p class="lead text-shadow">Enter the name of a city</p>
			<form>
				<fieldset class="form-group">
					<input class="form-control" type="text" name="city" value="<?php echo $typed_city ?>" placeholder="Eg: London, New York">
				</fieldset>
				<input class="btn btn-primary btn-lg" type="submit" value="Search">
			</form>
			<?php
				if($weather || $err) {
					echo $weather.$err;
				}
			?>
		</div>
	</div>


	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
</body>
</html>