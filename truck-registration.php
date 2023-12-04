<!DOCTYPE html>
<html lang="en">

<?php
require 'vendor/autoload.php'; // Load Composer autoloader
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
?>


<head>
    <title>Truck</title>
</head>

<body>
    <p>
        <?php
        include 'utils.php';
        //get trucks
        $conn = createConnection();
        // check if method is post
        // if it is, create truck
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            //insert into vehicles
            $sql = "INSERT INTO Vehicles () VALUES ();";
            $res = $conn->query($sql);
            // get vehicle id
            $vehicleID = $conn->insert_id;
            // insert into trucks

            $sql = "INSERT INTO Trucks (VehicleId, DriverName, TruckCompany, LicensePlate) VALUES ('" . $vehicleID . "', '" . $_POST['DriverName'] . "', '" . $_POST['TruckCompany'] . "', '" . $_POST['LicensePlate'] . "');";
            $res = $conn->query($sql);
            if ($res === TRUE) {
                echo "Truck created successfully";
            } else {
                echo "Error creating truck: " . $conn->error;
            }
        }
        $conn->close();
        ?>
    </p>
    <h1>Create Truck</h1>
    <form action="truck-registration.php" method="post">
        <label for="DriverName">Driver Name:</label><br>
        <input type="text" id="DriverName" name="DriverName"><br>
        <label for="TruckCompany">Truck Company:</label><br>
        <input type="text" id="TruckCompany" name="TruckCompany"><br>
        <label for="LicensePlate">License Plate:</label><br>
        <input type="text" id="LicensePlate" name="LicensePlate"><br><br>
        <button type="submit">Create Truck</button>
    </form>
    <h2>All Trucks</h2>
    <hr />
    <table>
        <tr>
            <th>TruckID</th>
            <th>DriverName</th>
            <th>TruckCompany</th>
            <th>LicensePlate</th>
        </tr>
        <?php
        $conn = createConnection();
        $sql = "SELECT * FROM Trucks;";
        $res = $conn->query($sql);
        if ($res->num_rows > 0) {
            while ($row = $res->fetch_assoc()) {
                echo "<tr><td>" . $row["VehicleID"] . "</td><td>" . $row["DriverName"] . "</td><td>" . $row["TruckCompany"] . "</td><td>" . $row["LicensePlate"] . "</td></tr>";
            }
        } else {
            echo "<tr><td colspan='4'>No results</td></tr>";
        }
        $conn->close();
        ?>
    </table>
</body>

</html>