<?php
require('utils.php');
$unloaded_containers = array();
$loaded_containers = array();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $shipOrTruckID = $_POST['shipOrTruckID'];

    $conn = createConnection();

    $sql = "SELECT * FROM Containers WHERE ContainerStatus='at source' AND SourceID = '$shipOrTruckID';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $unloaded_containers[] = $row;
        }
    }
    $sql = "UPDATE Containers SET ContainerStatus = 'in port' WHERE ContainerStatus='at source' AND SourceID = '$shipOrTruckID';";
    $conn->query($sql);


    $sql = "SELECT * FROM Containers WHERE ContainerStatus='in port' AND DestinationID = '$shipOrTruckID';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $loaded_containers[] = $row;
        }
    }
    $sql = "UPDATE Containers SET ContainerStatus = 'at destination' WHERE ContainerStatus='in port' AND DestinationID = '$shipOrTruckID';";
    $conn->query($sql);

    $conn->close();
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Crane Operator Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
    <link rel="stylesheet" href="styles.css" />
    <script src="navbar.js"></script>
</head>

<body>
    <navbar-component logged-in></navbar-component>

    <main>
        <h1>Crane Operator Page</h1>
        <form method="POST" action="">
            <label for="shipOrTruckID">Enter Ship or Truck ID:</label>
            <input type="text" name="shipOrTruckID" id="shipOrTruckID">
            <button type="submit">Submit</button>
        </form>
        <hr />
        <h2>Unloaded Containers</h2>
        <table>
            <thead>
                <tr>
                    <th>Container ID</th>
                    <th>Source ID</th>
                    <th>Destination ID</th>
                    <th>Container Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($unloaded_containers as $container) : ?>
                    <tr>
                        <td><?php echo $container['ContainerID'] ?></td>
                        <td><?php echo $container['SourceID'] ?></td>
                        <td><?php echo $container['DestinationID'] ?></td>
                        <td>At Source -> In Port</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <hr />
        <h2>Loaded Containers</h2>
        <table>
            <thead>
                <tr>
                    <th>Container ID</th>
                    <th>Source ID</th>
                    <th>Destination ID</th>
                    <th>Container Status</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($loaded_containers as $container) : ?>
                    <tr>
                        <td><?php echo $container['ContainerID'] ?></td>
                        <td><?php echo $container['SourceID'] ?></td>
                        <td><?php echo $container['DestinationID'] ?></td>
                        <td>In Port -> At Destination</td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </main>
</body>

</html>
