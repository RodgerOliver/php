<?php include "displayHTML.php"; ?>
<?php include "withoutAccent.php"; ?>

<?php

	$msg = '';
	$typed_city = '';

	if(array_key_exists("city", $_GET)) {
		$typed_city = $_GET["city"];
		// formating the city name
    $city = urlencode($_GET["city"]);
    $url = "http://api.openweathermap.org/data/2.5/weather?q=".$city."&appid=936e315759d9941bab7cf1d6190a2b41";
    $data_ = file_get_contents($url);
    if(!!$data_) {
        $data = json_decode($data_, true); // true to return an associative array
        $description = $data["weather"][0]["description"];
        $temp = $data["main"]["temp"] - 273;
        $str = "The weather for ".$data["name"]." is ".$description.".";
        $str .= "<br>"."The temperature is ".$temp."&degC.";
        $str .= "<br>"."The probability for today is ".$data["weather"][0]["main"].".";
        $str .= "<br>"."The wind speed is ".$data["wind"]["speed"]." km/h.";
        $msg = display("div", $str, array('class="alert alert-info"', 'role="alert"'));
    } else {
      $msg = display("div", "Sorry, this city could not be found.", array('class="alert alert-danger"', 'role="alert"'));
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
			height: 100%;
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
			margin: 1em auto 0 auto;
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
				if($msg) {
					echo $msg;
				}
			?>
		</div>
	</div>


	<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
</body>
</html>