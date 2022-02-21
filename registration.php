<!DOCTYPE HTML>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>COMP333 Homework 2</title>
    <link rel="stylesheet" href="style.css">
<title>Songs Registration Form</title>
</head>

<body>
	<?php
		$servername = "localhost";
		$username = "root";
		$password = "";
		$dbname = "music_db";

		$conn = new mysqli($servername, $username, $password, $dbname);

		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}

		$out_value = "";

		// User Registration 
		if(isset($_REQUEST["registration_button"])){

			$s_username = $_REQUEST['username-reg'];
			$s_password = $_REQUEST['password'];

			if(!empty($s_username) && !empty($s_password)){
				$sql_query = "SELECT * FROM users WHERE username = ('$s_username')";
				$result = mysqli_query($conn, $sql_query);

				if (mysqli_num_rows($result) > 0) {
                    $out_value = $s_username . " is taken. Please use another username.";
                }
				else {
					$sql_query = "INSERT INTO users(username, password) VALUES ('$s_username','$s_password')";
					$result = mysqli_query($conn, $sql_query);

					$sql_query = "SELECT * FROM users WHERE username = ('$s_username')";
					$result = mysqli_query($conn, $sql_query);

					// double verification
					if (mysqli_num_rows($result) > 0) {
						$out_value = "Registration completed";
					}
					else {
						$out_value = "User:" . $s_username . " was unable to be registered.";
					}
				}
			}
			else {
				$out_value = "Please enter a username and password.";
			}
		}

		// Song Retrieval 
		if(isset($_REQUEST["retrieval_button"])){

			$s_username = $_REQUEST['username-retr'];

			if(!empty($s_username)){
				$sql_query = "SELECT * FROM users WHERE username = ('$s_username')";
				$result = mysqli_query($conn, $sql_query);
				if (mysqli_num_rows($result) > 0) {
					$sql_query = "SELECT * FROM ratings WHERE username = ('$s_username')";
					$result = mysqli_query($conn, $sql_query);

					if (mysqli_num_rows($result) > 0) {
						while ($r = mysqli_fetch_assoc($result)) {
                            $out_value = $out_value . $r['song'] . " -> " . $r['rating'] . "<br>";
                        }
					}
					else {
						$out_value = $s_username . ", you have no ratings.";
					}
				}
				else {
					$out_value = "You have entered an invalid username.";
				}
			}
			else {
				$out_value = "Enter a username";
			}
		}
		
		$conn->close();
	?>

	<!-- HTML -->

	<div class="flex-container" style="width: 100%;">
        <div><h1>music-db</h1></div>
        <div>
			<h2>Registration:</h2>
			<form method="GET" action="">
				Username: <input type="text" name="username-reg" placeholder="" /><br>
				Password: <input type="password" name="password" placeholder="" /><br>
			<input type="submit" name="registration_button" value="Register"/>
			</form>
		</div>
        <div>
			<h2>Song Retrieval:</h2>
			<form method="GET" action="">
				Username: <input type="text" name="username-retr" placeholder="" /><br>
			<input type="submit" name="retrieval_button" value="Retrieve"/>
			</form>
		</div> 
        <div>
			<p><?php 
			if(!empty($out_value)){
				echo $out_value;
			}
			?></p>
		</div>
    </div>

</body>
</html>