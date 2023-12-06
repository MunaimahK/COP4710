<!doctype html>
<html lang="en">
<?php

    function portEntry()
    {

        $host = "localhost";
        $username = "root";
        $pwd = "";
        $db_name = "COP4710";
        
        $conn = new mysqli($host, $username, $pwd, $db_name);
        
    // Find rows where Berth is available
       $sql = "SELECT * FROM Berths WHERE IsAvailable = TRUE;";
       $res = $conn->query($sql);

       if($res->num_rows <= 0){
        // Create an available Berth
        $berthID = $conn->insert_id;
        $val = TRUE;
        $sql = "INSERT INTO Berths VALUES ('". $berthID ."', '". $val ."');";
        $res = $conn->query($sql);
       }
       else{
        //retrieve a berth ID
        $b_row = $res->fetch_assoc();
       }
        $shipID = $_POST["id"];
        $berthID = $b_row["BerthID"];
        $name = $_POST["name"] ?? null;
        $owner = $_POST["owner"] ?? null;
        $ETime = $_POST["entry"] ?? null;
        $XTime = '00:00:00';

        $sql = "UPDATE Berths SET IsAvailable =FALSE WHERE BerthID='$berthID';";
        $res = $conn->query($sql);

        $sql = "UPDATE Ships SET BerthId ='$berthID', EntryTime = '$ETime', ExitTime = '$XTime' WHERE Name='$name';";
        $res = $conn->query($sql);
        
        if($res == TRUE){
            echo "Port Entry Succesfull";
        } else {
            echo "Error Entering Port: " . $conn->error;
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
                 echo "<tr><td>" . $row["VehicleID"] . "</td><td>" . $row["Name"] . "</td><td>" . $row["Owner"] . "</td><td>" . $row["EntryTime"] . "</td><td>" . $row["ExitTime"] . "</td><td>" . $row["BerthID"] . " </td></tr>";
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
    <h1>Port Entry Page</h1>
    
    <form action="port-entry.php" method="post">
      <div>
        <label for="id">ShipID</label>
        <input type="id" id="id" name="id">
      </div>
      <div>
        <label for="name">Name</label>
        <input type="name" id="name" name="name">
      </div>
      <div>
        <label for="owner">Captain</label>
        <input type="owner" id="owner" name="owner">
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
