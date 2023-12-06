<?php
require('utils.php');

if (isset($_GET['truckID'])) {
    $conn = createConnection();
    $truckID = $_GET['truckID'];
    $truckIDMessage = "Truck ID: " . $truckID;
    $sql = "SELECT StorageAddress FROM Containers JOIN StorageAreas ON Containers.StorageAreaID = StorageAreas.StorageAreaID WHERE SourceID = '$truckID';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $unloadingDirection = "<p>Loading address: " . $result->fetch_assoc()['StorageAddress'] . "</p>";
    }
    $sql = "SELECT StorageAddress FROM Containers JOIN StorageAreas ON Containers.StorageAreaID = StorageAreas.StorageAreaID WHERE DestinationID = '$truckID';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $loadingDirection = "<p>Unloading address: " . $result->fetch_assoc()['StorageAddress'] . "</p>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Truck Driver Reistraion</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="styles.css" />
    <script src="navbar.js"></script>
</head>

<body>
    <navbar-component></navbar-component>
    <main>
        <h1>Truck Driver Registration</h1>
        <form action="truck-driver-registration.php" method="get">
            <label for="truckID">Truck ID:</label><br>
            <input type="text" id="truckID" name="truckID"><br><br>
            <button type="submit">Check In</button>
            <hr />
            <h2><?php echo $truckIDMessage ?></h2>
            <?php echo $unloadingDirection ?>
            <?php echo $loadingDirection ?>
        </form>
    </main>
</body>

</html>