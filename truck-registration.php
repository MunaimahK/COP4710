<!DOCTYPE html>
<html lang="en">

<?php
require('utils.php');
requireAuth();

function createTruck()
{
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = createConnection();
    // check if truck with same values already exists
    $sql = "SELECT * FROM Trucks WHERE DriverName = '" . $_POST['DriverName'] . "' AND TruckCompany = '" . $_POST['TruckCompany'] . "' AND LicensePlate = '" . $_POST['LicensePlate'] . "';";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
      echo '<p class="error">Truck already exists!</p>';
      return;
    }

    $sql = "INSERT INTO Vehicles () VALUES ();";
    $res = $conn->query($sql);
    $vehicleID = $conn->insert_id;

    $sql = "INSERT INTO Trucks (VehicleId, DriverName, TruckCompany, LicensePlate) VALUES ('" . $vehicleID . "', '" . $_POST['DriverName'] . "', '" . $_POST['TruckCompany'] . "', '" . $_POST['LicensePlate'] . "');";
    $res = $conn->query($sql);
    echo "<p>Truck created successfully</p>";
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
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
  <link rel="stylesheet" href="styles.css" />
  <script src="navbar.js"></script>
</head>

<body>
  <navbar-component logged-in></navbar-component>

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
    <?php
    createTruck();
    ?>
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
