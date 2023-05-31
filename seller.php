<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Seller Page</title>
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="main.js"></script>

</head>

<body>
    <?php

    session_start();
    if (!isset($_SESSION["id"]) || empty($_SESSION["id"])) {
        header("location: login.php");
    }
    ?>
    <header>
        <nav>
            <ul>
                <li><a href="./index.html">Seller Home</a></li>
                <li id="add-car-link"><a href="add_car.php">Add Car</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1>Seller Page</h1>
        <p>Welcome to your seller page. Here you can manage your car advertisements.</p>
        <div id="cars-table-body"></div>
        <?php
            $servername = "localhost";
            $username = "id20824993_cardb";
            $password = "Dc\AO|3>NX>t/ZK$";
            $database = "id20824993_car";
            $conn = new mysqli($servername, $username, $password, $database);
        
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            $sql = "SELECT * FROM Car";


            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                echo "<h3>Currently Listed Cars</h3>";
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
        ?>
    </main>

    <footer>
        <p>&copy; 2023 Online Car Sale</p>
    </footer>
</body>

</html>