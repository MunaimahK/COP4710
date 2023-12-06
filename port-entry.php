<!doctype html>
<html lang="en">
<?php
require('utils.php');
requireAuth();

function portEntry()
{
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = createConnection();

    // Find rows where Berth is available
    $sql = "SELECT * FROM Berths WHERE IsAvailable = TRUE;";
    $res = $conn->query($sql);

    if ($res->num_rows <= 0) {
      // Create an available Berth
      $berthID = $conn->insert_id;
      $val = TRUE;
      $sql = "INSERT INTO Berths VALUES ('" . $berthID . "', '" . $val . "');";
      $res = $conn->query($sql);
    } else {
      //retrieve a berth ID
      $b_row = $res->fetch_assoc();
    }
    $berthID = $b_row["BerthID"];
    $shipID = $_POST["shipID"] ?? null;
    $ETime = $_POST["entry"] ?? null;
    $XTime = '00:00:00';

    $sql = "UPDATE Berths SET IsAvailable =FALSE WHERE BerthID='$berthID';";
    $res = $conn->query($sql);

    $sql = "UPDATE Ships SET BerthId ='$berthID', EntryTime = '$ETime', ExitTime = '$XTime' WHERE VehicleID='$shipID';";
    $res = $conn->query($sql);

    if ($res == TRUE) {
      echo "Port Entry Succesfull";
    } else {
      echo "Error Entering Port: " . $conn->error;
    }

    $conn->close();
  }
}

function getShip()
{
  $conn = createConnection();
  $sql = "SELECT * FROM Ships;";
  $res = $conn->query($sql);
  if ($res->num_rows > 0) {
    while ($row = $res->fetch_assoc()) {
      echo "<tr><td>" . $row["VehicleID"] . "</td><td>" . $row["Name"] . "</td><td>" . $row["Owner"] . "</td><td>" . $row["EntryTime"] . "</td><td>" . $row["ExitTime"] . "</td><td>" . $row["BerthID"] . " </td></tr>";
    }
  } else {
    echo "<tr><td colspan='4'>No results</td></tr>";
  }
  $conn->close();
}

?>

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
  <link rel="stylesheet" href="styles.css" />
  <script src="navbar.js"></script>
</head>

<body>
  <navbar-component logged-in></navbar-component>
  <main>
    <h1>Port Entry Page</h1>

    <form action="port-entry.php" method="post">
      <div>
        <label for="shipID">ShipID</label>
        <input type="shipID" shipID="shipID" name="shipID">
      </div>
      <div>
        <label for="entry">Entry Time</label>
        <input type="entry" id="entry" name="entry">
      </div>
      <button>Enter Port</button>
    </form>

    <?php
    portEntry();
    ?>

    <div>
      <table>
        <tr>
          <th>ShipID</th>
          <th>Name</th>
          <th>Captain</th>
          <th>Entry Time</th>
          <th>Exit Time</th>
          <th>Berth</th>
        </tr>
        <?php
        getShip();
        ?>
      </table>
    </div>

  </main>

</body>

</html>
