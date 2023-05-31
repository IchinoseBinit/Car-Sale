<!DOCTYPE html>
<html>

<head>
	<meta charset="UTF-8">
	<title>Add Car</title>
	<link rel="stylesheet" type="text/css" href="style.css">
	<script src="main.js"></script>

	
</head>

<body>

	<?php
	// Establish database connection
	$servername = "localhost";
	$username = "id20824993_cardb";
	$password = "Dc\AO|3>NX>t/ZK$";
	$database = "id20824993_car";
	$conn = new mysqli($servername, $username, $password, $database);



	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}

	if ($_SERVER["REQUEST_METHOD"] == "POST") {


		$sql = "INSERT INTO Car (model, make, year, mileage, location, price, seller_id) VALUES (?, ?, ?, ?, ?, ?, ?)";
		$stmt = $conn->prepare($sql);

		$model = $_POST["model"];
		$make = $_POST["make"];
		$year = $_POST["year"];
		$mileage = $_POST["mileage"];
		$location = $_POST["location"];
		$price = $_POST["price"];
		session_start();
		$id = $_SESSION["id"];
		$stmt->bind_param("sssisdi", $model, $make, $year, $mileage, $location, $price, $id);

		// Attempt to execute the prepared statement
		if ($stmt->execute()) {
			header("location: seller.php");
		} else {
			echo "Something went wrong. Please try again later.";
		}
		$stmt->close();

		$conn->close();
	}
	?>
	<main>
		<h1>Add Car</h1>
		<form id="add-car-form" method="post">
			<label for="make">Make *</label>
			<input type="text" id="make" name="make" required>

			<label for="model">Model *</label>
			<input type="text" id="model" name="model" required>

			<label for="year">Year *</label>
			<input type="text" id="year" name="year" required>

			<label for="mileage">Mileage *</label>
			<input type="number" id="mileage" name="mileage" required>

			<label for="location">Location *</label>
			<input type="text" id="location" name="location" required>

			<label for="price">Price *</label>
			<input type="text" id="price" name="price" required>

			<input type="submit" class="button">Add Car</button>
		</form>
	</main>
	</body>

</html>