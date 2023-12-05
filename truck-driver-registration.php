<?php
require('utils.php');

if (isset($_GET['truckID'])) {
    $conn = createConnection();
    $truckID = $_GET['truckID'];
    $truckIDMessage = "Truck ID: " . $truckID;
    $sql = "SELECT StorageAddress FROM Containers JOIN StorageAreas ON Containers.StorageAreaID = StorageAreas.StorageAreaID WHERE SourceID = '$truckID';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $unloadingDirection = "Loading address: " . $result->fetch_assoc()['StorageAddress'];
    }
    $sql = "SELECT StorageAddress FROM Containers JOIN StorageAreas ON Containers.StorageAreaID = StorageAreas.StorageAreaID WHERE DestinationID = '$truckID';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $loadingDirection = "Unloading address: " . $result->fetch_assoc()['StorageAddress'];
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Truck Driver Reistraion</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css" />
    <script src="navbar.js"></script>
</head>

<body>
    <navbar-component></navbar-component>
    <main>
        <form action="truck-driver-registration.php" method="get">
            <label for="truckID">Truck ID:</label><br>
            <input type="text" id="truckID" name="truckID"><br><br>
            <button type="submit">Check In</button>
            <hr />
            <h2><?php echo $truckIDMessage ?></h2>
            <p><?php echo $unloadingDirection ?></p>
            <p><?php echo $loadingDirection ?></p>
        </form>
    </main>
</body>

</html>