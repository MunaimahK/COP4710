<!doctype html>
<html lang="en">
<?php
include 'utils.php';

    function portExit()
    {

        
        
        $conn = createConnection();
        $shipID = $_POST["shipID"] ?? null;
        
        $name = $_POST["name"] ?? null;
        $owner = $_POST["owner"] ?? null;
        $ETime = $_POST["entry"] ?? null;
        $XTime = '00:00:00';
    // Find rows where Ship matches Ship ID is available
       $sql = "SELECT * FROM Ships WHERE VehicleID = '$shipID';";
       $res = $conn->query($sql);

       if($res->num_rows <= 0){
        // ship does not exist
        /*
        $berthID = $conn->insert_id;
        $val = TRUE;
        $sql = "INSERT INTO Berths VALUES ('". $berthID ."', '". $val ."');";
        $res = $conn->query($sql);*/
        echo "Ship is not registered. Go to Ship Registration page.";
       }
       else{
        //retrieve a berth ID
        $s_row = $res->fetch_assoc();
        $berthID = $s_row["BerthID"];
        $sql = "UPDATE Berths SET IsAvailable =TRUE WHERE BerthID='$berthID';";
        $res = $conn->query($sql);

        $sql = "UPDATE Ships SET BerthId = NULL, ExitTime = '$XTime' WHERE VehicleID='$shipID';";
        $res = $conn->query($sql);
        
        if($res == TRUE){
            echo "Port Exit Succesful";
        } else {
            echo "Error Entering Port: " . $conn->error;
        }
       }

        $conn->close();
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
<navbar-component></navbar-component>
    <main>
    <h1>Port Exit Page</h1>
    
    <form action="port-exit.php" method="post">
      <div>
        <label for="shipID">ShipID</label>
        <input type="shipID" id="shipID" name="shipID">
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
        <label for="entry">Exit Time</label>
        <input type="entry" id="entry" name="entry">
      </div>
      <button>Exit Port</button>
      
    </form>
    <?php
        portExit();
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
