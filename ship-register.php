<!doctype html>
<html lang="en">
<?php
include 'utils.php';

function createShip()
{
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $conn = createConnection();

    $name = $_POST["name"] ?? null;
    $owner = $_POST["owner"] ?? null;

    $sql = "INSERT INTO Vehicles () Values ();";
    $res = $conn->query($sql);
    $vehicleID = $conn->insert_id;

    $sql = "INSERT INTO Ships (VehicleID, Name, Owner) VALUES ('" . $vehicleID . "', '" . $name . "', '" . $owner . "');";
    $res = $conn->query($sql);


    if ($res == TRUE) {
      echo "Ship Created Succesfully";
    } else {
      echo "Error Creating Truck: " . $conn->error;
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
      echo "<tr><td>" . $row["VehicleID"] . "</td><td>" . $row["Name"] . "</td><td>" . $row["Owner"] . "</td></tr>";
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
    <h1>Ship Registration</h1>
    <form action="ship-register.php" method="post">
      <label for="name">Name</label>
      <input type="name" id="name" name="name">
      <div>
        <label for="owner">Captain</label>
        <input type="owner" id="owner" name="owner">
      </div>
      <button>Register</button>
      <br>
    </form>
    <?php
    createShip();
    ?>
    <div>
      <table>
        <tr>
          <th>ShipID</th>
          <th>Name</th>
          <th>Captain</th>
        </tr>
        <?php
        getShip();
        ?>
      </table>
    </div>
  </main>
</body>

</html>
