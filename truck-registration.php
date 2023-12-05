<!DOCTYPE html>
<html lang="en">

<?php
include 'utils.php';

function createTruck()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $conn = createConnection();
        $sql = "INSERT INTO Vehicles () VALUES ();";
        $res = $conn->query($sql);
        $vehicleID = $conn->insert_id;
        $sql = "INSERT INTO Trucks (VehicleId, DriverName, TruckCompany, LicensePlate) VALUES ('" . $vehicleID . "', '" . $_POST['DriverName'] . "', '" . $_POST['TruckCompany'] . "', '" . $_POST['LicensePlate'] . "');";
        $res = $conn->query($sql);
        if ($res === TRUE) {
            echo "Truck created successfully";
        } else {
            echo "Error creating truck: " . $conn->error;
        }
        $conn->close();
    }
}

function getTrucks()
{
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
}
?>


<head>
    <title>Truck Registration</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css" />
    <script src="navbar.js"></script>
</head>

<body>
    <navbar-component></navbar-component>
    <p>
        <?php
        createTruck();
        ?>
    </p>
    <main>
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
            getTrucks();
            ?>
        </table>
    </main>
</body>

</html>