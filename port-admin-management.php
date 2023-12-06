<?php
require('utils.php');
requireAuth();

function getShip()
{
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = createConnection();
    if (isset($_POST['shipID']) && $_POST['shipID'] != "") {
      $shipID = $_POST['shipID'];
      $sql = "SELECT * FROM Ships WHERE VehicleID = " . $shipID;
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "Ship Found! <br>Name: " . $row["Name"] . " | " . "Owner: " . $row["Owner"] . " | " . "Berth ID: " . $row["BerthID"] . " | " . "Entry Time: " . $row["EntryTime"] . " | " . "Exit Time: " . $row["ExitTime"];
        }
      } else {
        echo "Ship not found";
      }
    }
  }
}
function getTruck()
{
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = createConnection();
    if (isset($_POST['truckID']) && $_POST['truckID'] != "") {
      $truckID = $_POST['truckID'];
      $sql = "SELECT * FROM Trucks WHERE VehicleID = " . $truckID;
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "Truck Found! <br>Driver Name: " . $row["DriverName"] . " | " . "Truck Company: " . $row["TruckCompany"] . " | " . "License Plate: " . $row["LicensePlate"];
        }
      } else {
        echo "Truck not found";
      }
    }
  }
}
function getContainer()
{
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = createConnection();
    if (isset($_POST['containerID']) && $_POST['containerID'] != "") {
      $containerID = $_POST['containerID'];
      $sql = "SELECT * FROM Containers WHERE ContainerID = " . $containerID;
      $result = $conn->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo "Container Found! <br>Company Name: " . $row["CompanyName"] . " | " . "Source ID: " . $row["SourceID"] . " | " . "DestinationID: " . $row["DestinationID"] . " | " . "Storage Area ID: " . $row['StorageAreaID'] . " | " . "Container Status: " . $row['ContainerStatus'];
        }
      } else {
        echo "Container not found";
      }
    }
  }
}

function getBerths()
{
  $conn = createConnection();
  $sql = "SELECT * FROM Berths;";
  $res = $conn->query($sql);
  if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
      echo "<tr><td>" . $row["BerthID"] . "</td><td>" . $row["IsAvailable"] . "</td></tr>";
    }
  } else {
    echo "<tr><td colspan='4'>No results</td></tr>";
  }
  $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>Port Admin Management</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
  <link rel="stylesheet" href="styles.css" />
  <script src="navbar.js"></script>
</head>

<body>
  <navbar-component logged-in></navbar-component>

  <main>
    <h1>Truck Information</h1>
    <form method="POST" action="port-admin-management.php">
      <label for="truckID">Enter Truck ID:</label>
      <input type="text" name="truckID" id="truckID">
      <button type="submit" id="button1">Submit</button>
    </form>
    <p>
      <?php
      getTruck();
      ?>
    </p>

    <h1>Ship Information</h1>
    <form method="POST" action="port-admin-management.php">
      <label for="shipID">Enter Ship ID:</label>
      <input type="text" name="shipID" id="shipID">
      <button type="submit" id="button2">Submit</button>
    </form>
    <p>
      <?php
      getShip();
      ?>
    </p>
    <h1>Container Information</h1>
    <form method="POST" action="port-admin-management.php">
      <label for="containerID">Enter Container ID:</label>
      <input type="text" name="containerID" id="containerID">
      <button type="submit" id="button3">Submit</button>
    </form>
    <p>
      <?php
      getContainer();
      ?>
    </p>
    <h2>All Berths</h2>
    <hr />
    <table>
      <tr>
        <th>BerthID</th>
        <th>IsAvailable</th>
      </tr>
      <?php
      getBerths();
      ?>
    </table>


  </main>
</body>

</html>
