<?php
require('utils.php');

if (isset($_GET['truckID'])) {
    $conn = createConnection();
    $truckID = $_GET['truckID'];
    $truckIDMessage = "Truck ID: " . $truckID;
    $sql = "SELECT StorageAddress FROM Containers JOIN StorageAreas ON Containers.StorageAreaID = StorageAreas.StorageAreaID WHERE SourceID = '$truckID';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        //set unload direction to the results of the query StorageAreaID
        $unloadingDirection = "Loading address: " . $result->fetch_assoc()['StorageAddress'];
    }
    $sql = "SELECT StorageAddress FROM Containers JOIN StorageAreas ON Containers.StorageAreaID = StorageAreas.StorageAreaID WHERE DestinationID = '$truckID';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        //set load direction to the results of the query StorageAreaID
        $loadingDirection = "Unloading address: " . $result->fetch_assoc()['StorageAddress'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Truck Driver Reistraion</title>
</head>

<body>
    <!-- form for check in, using get -->
    <form action="truck-driver-registration.php" method="get">
        <label for="truckID">Truck ID:</label><br>
        <input type="text" id="truckID" name="truckID"><br><br>
        <button type="submit">Check In</button>
        <hr />
        <h2><?php echo $truckIDMessage ?></h2>
        <p><?php echo $unloadingDirection ?></p>
        <p><?php echo $loadingDirection ?></p>
</body>

</html>