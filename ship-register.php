<!doctype html>
<html lang="en">
<?php

    function createShip()
    {

        $host = "localhost";
        $username = "root";
        $pwd = "";
        $db_name = "COP4710";

        $name = $_POST["name"] ?? null;
        $owner = $_POST["owner"] ?? null;
        $ETime = $_POST["entry"] ?? null;
        $XTime = $_POST["exit"] ?? null;

        
        $conn = new mysqli($host, $username, $pwd, $db_name);
        $sql1 = "INSERT INTO Vehicles () Values ();";
        $res = $conn->query($sql1);
        $vehicleID = $conn->insert_id;
    
        $sql = "INSERT INTO Ships (VehicleID, Name, Owner) VALUES ('". $vehicleID ."', '". $name ."', '" . $owner . "');";
        $mysqli = new mysqli($host, $username, $pwd, $db_name);
        $res = $mysqli->query($sql);

        
        if($res == TRUE){
            echo "Ship Created Succesfully";
        } else {
            echo "Error Creating Truck: " . $conn->error;
        }

        $conn->close();
    }

    function getShip()
    {
        $host = "localhost";
        $username = "root";
        $pwd = "";
        $db_name = "COP4710";

        $conn = new mysqli($host, $username, $pwd, $db_name);
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
    /*
CREATE TABLE Ships (VehicleID INT PRIMARY KEY, Name CHAR(20), Owner CHAR(20), BerthID INT, EntryTime TIME, ExitTime TIME, FOREIGN KEY (VehicleID) REFERENCES Vehicles (VehicleID), FOREIGN KEY (BerthID) REFERENCES Berths (BerthID));
*/

?>
<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
  <link rel="stylesheet" href="styles.css" />
  <script src="navbar.js"></script>
</head>

<body>
<navbar-component></navbar-component>
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
