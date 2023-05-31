<!DOCTYPE html>
<html>

<head>
  <title>Search Page</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Car Sale Homepage</title>
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
        <li><a href="./car_seller_registration.php">Car Seller</a></li>
        <li><a href="./seller.php">Seller</a></li>
        <li><a href="#">Search</a></li>
        <li><a href="./contact_us.html">Contact Us</a></li>
        <li><a href="./about_us.html">About Us</a></li>
      </ul>
    </nav>
  </header>
  <h1>Search Page</h1>
  <main>

    <form method="post">
      <label for="model">Model:</label>
      <input type="text" id="model" name="model"><br><br>
      <label for="location">Location:</label>
      <input type="text" id="location" name="location"><br><br>
      <button type="submit">Search</button>
    </form>
    <br>
    <br>
    <div id="search-results">
      <?php
      $servername = "localhost";
      $username = "id20824993_cardb";
      $password = "Dc\AO|3>NX>t/ZK$";
      $database = "id20824993_car";
      $conn = new mysqli($servername, $username, $password, $database);

      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $model = $_POST["model"];
        $location = $_POST["location"];
        $sql = "SELECT * FROM Car WHERE model = ? and location = ?";

        $stmt = $conn->prepare($sql);

        $stmt->bind_param("ss", $model, $location);

        $stmt->execute();

        $result = $stmt->get_result();



        if ($result->num_rows > 0) {
          echo "<h3>Matching Cars</h3>";
          echo "<table>";
          echo "<tr>";
          echo "<th>Make</th>";
          echo "<th>Model</th>";
          echo "<th>Year</th>";
          echo "<th>Mileage</th>";
          echo "<th>Location</th>";
          echo "<th>Price</th>";
          echo "</tr>";

          while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["make"] . "</td>";
            echo "<td>" . $row["model"] . "</td>";
            echo "<td>" . $row["year"] . "</td>";
            echo "<td>" . $row["mileage"] . "</td>";
            echo "<td>" . $row["location"] . "</td>";
            echo "<td>" . $row["price"] . "</td>";
            echo "</tr>";
          }

          echo "</table>";
        } else {
          echo "<h3>No Cars Listed</h3>";
        }
      }
      ?>
    </div>
  </main>
  </body>

</html>