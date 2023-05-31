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
$user = $userpw = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

	// Validate username
	if (empty(trim($_POST["username"]))) {
		$username_err = "Please enter a username.";
	} else {
		// Prepare a select statement
		$sql = "SELECT id FROM SELLER WHERE username = ?";
		$stmt = $conn->prepare($sql);
		$param_username = trim($_POST["username"]);
		$stmt->bind_param("s", $param_username);
		$stmt->execute();
		$stmt->store_result();

		if ($stmt->num_rows == 1) {
			$username_err = "This username is already taken.";
		} else {
			$user = trim($_POST["username"]);
		}
		$stmt->close();
	}

	// Validate password
	if (empty(trim($_POST["password"]))) {
		$password_err = "Please enter a password.";
	} elseif (strlen(trim($_POST["password"])) < 6) {
		$password_err = "Password must have at least 6 characters.";
	} else {
		$userpw = trim($_POST["password"]);
	}



	// Check input errors before inserting into database
	if (empty($username_err) && empty($password_err)) {
		// Prepare an insert statement

		$sql = "INSERT INTO SELLER (username, password, email, address, phone_number) VALUES (?, ?, ?, ?, ?)";
		$stmt = $conn->prepare($sql);



		$email = $_POST["email"];
		$address = $_POST["address"];
		$phone_number = $_POST["phone"];


		$stmt->bind_param("sssss", $user, $userpw, $email, $address, $phone_number);



		// Attempt to execute the prepared statement
		if ($stmt->execute()) {
			// Registration successful, redirect to login page
			// echo "Done execution";

			header("location: index.html");
		} else {
			echo "Something went wrong. Please try again later.";
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
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Car Seller Registration</title>

	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="main.js"></script>

		</head>

<body>
	<header>
		<div class="logo">
			<img src="logo.jpeg" alt="Company Logo">
		</div>
		<nav>
			<ul>
				<li><a href="./index.html">Home</a></li>
				<li><a href="#">Cars Seller</a></li>
				<li><a href="./seller.php">Seller</a></li>
				<li><a href="./search.php">Search</a></li>
				<li><a href="./contact_us.html">Contact Us</a></li>
				<li><a href="./about_us.html">About Us</a></li>
			</ul>
		</nav>
	</header>
	<main>
		<h1>Car Seller Registration</h1>
		<form id="registration-form" method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
			<label for="name">Name:</label>
			<input type="text" id="name" name="name" required>
			<label for="address">Address:</label>
			<input type="text" id="address" name="address" required>
			<label for="phone">Phone Number:</label>
			<input type="tel" id="phone" name="phone" required>
			<label for="email">Email Address:</label>
			<input type="email" id="email" name="email" required>
			<label for="username">Username:</label>
			<input type="text" id="username" name="username" required>
			<label for="password">Password:</label>
			<input type="password" id="password" name="password" required>
			<button type="submit">Register</button>
		</form>
	</main>
	<footer>
		<p>&copy; 2023 Car Sale. All rights reserved.</p>
	</footer>
	</body>

</html>