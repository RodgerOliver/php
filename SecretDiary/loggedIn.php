<?php include "loggedInPHP.php"; ?>

<!DOCTYPE html>
<html>
<head>
	<title>Secret Diary</title>
	<link rel="stylesheet" type="text/css" href="https://goo.gl/LLUD4L">
	<style type="text/css">

		html {
			background: url("https://goo.gl/Ej2woq") no-repeat center center fixed;
			background-size: cover;
			height: 100%;
			width: 100%;
			display: flex;
			align-items: center;
		}

		body {
			background: none;
			margin: 0 auto;
		}

		#container {
			color: #fff;
			text-align: center;
		}

		#diary {
			height: 400px;
			width: 800px;
		}

	</style>
</head>
<body>

	<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top">
		<a class="navbar-brand" href="#">Your Secret Diary</a>
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
			<ul class="nav navbar-nav ml-auto">
				<li class="nav-item">
					<?php if(isset($logoutLink)) {echo $logoutLink;} ?>
				</li>
			</ul>
		</div>
	</nav>
	<div id="container" class="container">
		<textarea id="diary" class="form-control"><?php echo $diary; ?></textarea>
	</div>


<script src="https://code.jquery.com/jquery-3.2.1.js" integrity="sha256-DZAnKJ/6XZ9si04Hgrsxu/8s717jcIzLy3oi35EouyE=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.3/js/bootstrap.min.js" integrity="sha384-a5N7Y/aK3qNeh15eJKGWxsqtnX/wWdSZSKp+81YjTmS15nvnvxKHuzaWwXHDli+4" crossorigin="anonymous"></script>
<script>

	$("#diary").bind("input propertychange", function() {
		// ajax request to update the database
		$.ajax({
			method: "POST",
			url: "updateDatabase.php",
			data: {content: $("#diary").val()}
		});
	});

</script>
</body>
</html>