<?php
	// Establish database connection
	$servername = "localhost";
	$username = "id20824993_cardb";
	$password = "Dc\AO|3>NX>t/ZK$";
	$database = "id20824993_car";
	$conn = new mysqli($servername, $username, $password, $database);



	if ($conn->connect_error) {
		// die("Connection failed: " . $conn->connect_error);
		echo "Error connecting";
	}



	// Define variables and initialize with empty values
	$username = $password = "";
	$username_err = $password_err = "";

	// Processing form data when form is submitted
	if ($_SERVER["REQUEST_METHOD"] == "POST") {

		
		// Validate username
		if (empty(trim($_POST["username"]))) {
			$username_err = "Please enter a username.";
		} else if (empty(trim($_POST["password"]))) {
			$password_err = "Please enter a password.";
		} elseif (strlen(trim($_POST["password"])) < 6) {
			$password_err = "Password must have at least 6 characters.";
		} else {
			// Prepare a select statement
			$sql = "SELECT id FROM SELLER WHERE username = ? and password = ?";
			$stmt = $conn->prepare($sql);
			$param_username = trim($_POST["username"]);
			$param_password = trim($_POST["password"]);
			$stmt->bind_param("ss", $param_username, $param_password);
			$stmt->execute();

			$stmt->store_result();

			if ($stmt->num_rows == 1) {

				$stmt->bind_result($id);
				if ($stmt->fetch()) {
					session_start();
					$_SESSION["id"] = $id;
					header('location: index.html');
				}

			} else {
				$username = trim($_POST["username"]);
			}
			$stmt->close();
		}






		$conn->close();
	}


?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="main.js"></script>

		</head>

<body>

	
	<main>
		<h1>Login</h1>
		<form id="login-form" method="post">
			<label for="username">Username *</label>
			<input type="text" id="username" name="username" required>

			<label for="password">Password *</label>
			<input type="password" id="password" name="password" required>
			<button type="submit">Login</button>

		</form>

		<p id="no-account">Don't have an account? <a href="./car_seller_registration.php">Register here</a></p>

		<p id="error"></p>
	</main>
</body>

</html>