<?php

	require "classes/Database.php";

	session_start();

	$db = new Database;

	if($_SERVER["REQUEST_METHOD"] === "POST") {

		if(isset($_POST["create"])) {
			if($_POST["title"] !== "" && $_POST["title"] !== "") {
				$title = $_POST["title"];
				$body = $_POST["body"];
				
				$db->query("INSERT INTO `posts` (`title`, `body`) VALUES (:title, :body)");
				$db->bind(":title", $title);
				$db->bind(":body", $body);
				$db->execute();

				if($db->lastInsertId()) {
					flash("success", "Post added.");
				}
			} else {
				flash("danger", "Please fill all the fields.");
			}

		} elseif(isset($_POST["update"])) {
			if ($_POST["id"] !== "") {
				$id = (int)$_POST["id"];
				$title = $_POST["title"];
				$body = $_POST["body"];

				if($title === "") {
					$db->query("UPDATE `posts` SET `body` = :body WHERE `id` = :id");
					$db->bind(":body", $body);
				} elseif($body === "") {
					$db->query("UPDATE `posts` SET `title` = :title WHERE `id` = :id");
					$db->bind(":title", $title);
				} elseif($title === "" && $body === "") {
					return;
				} else {
					$db->query("UPDATE `posts` SET `title` = :title, `body` = :body WHERE `id` = :id");
					$db->bind(":title", $title);
					$db->bind(":body", $body);
				}

				$db->bind(":id", $id);
				$db->execute();
				flash("success", "Post updated.");
			} else {
				flash("danger", "Please fill the ID field and other field to update.");
			}

		} elseif(isset($_POST["delete"])) {
			if($_POST["id"] !== "") {
				$id = $_POST["id"];
				$db->query("DELETE FROM `posts` WHERE id = :id");
				$db->bind(":id", $id);
				$db->execute();
				flash("success", "Post deleted.");
			} else {
				flash("danger", "Please fill the ID field to delete a post.");
			}
		}
	}

	$db->query("SELECT * FROM `posts`");
	$rows = $db->resultSet();

	function displayPosts() {
		global $rows;
		foreach ($rows as $row) {
			echo "<h3>".$row["title"]."<em> id: ".$row["id"]."</em>"."</h3>";
			echo "<p>".$row["body"]."</p>";
		}
	}

	function getSession($session) {
		if ($_SERVER["REQUEST_METHOD"] === "GET") {
			if(isset($_SESSION["$session"])) {
				$msg = $_SESSION["$session"];
				session_destroy();
				return $msg;
			}
		}
	}

	function flash($type, $text) {
		$_SESSION["msg"] = "<div class=\"alert alert-$type\">$text</div>";
		header("location: index.php");
	}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Blog</title>
	<link rel="stylesheet" type="text/css" href="https://goo.gl/LLUD4L">
</head>
<body>

	<div class="container mt-3">
		<?= getSession("msg"); ?>
		<h1>Add Post</h1>
		<form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST">
			<fieldset class="form-group">
				<input class="form-control" type="number" name="id" placeholder="ID to Update or Delete">
			</fieldset>
			<fieldset class="form-group">
				<input class="form-control" type="text" name="title" placeholder="Title of the post">
			</fieldset>
			<fieldset class="form-group">
				<textarea class="form-control" name="body" placeholder="Content of the post" rows="5"></textarea>
			</fieldset>
			<input class="btn btn-success" type="submit" name="create" value="Create">
			<input class="btn btn-info" type="submit" name="update" value="Update">
			<input class="btn btn-danger" type="submit" name="delete" value="Delete">
		</form>

		<h1 class="mt-4">All Posts</h1>
		<?php displayPosts(); ?>
	</div>

</body>
</html>