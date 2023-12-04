<?php
require('utils.php');
// Step 1: ID Input
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $shipOrTruckID = $_POST['shipOrTruckID'];

    // Step 2: View Container Details
    // Retrieve container details based on the entered ID
    $containers = getContainerDetails($shipOrTruckID);

    // Step 3: Update Container Status
    updateContainerStatus($containers);
}

function getContainerDetails($shipOrTruckID)
{
    // Retrieve container details from the database based on the entered ID
    // Implement your logic here to fetch container details
    // Return an array of container details

    $conn = createConnection();
    $sql = "SELECT * FROM Containers WHERE SourceID = '$shipOrTruckID' OR DestinationID = '$shipOrTruckID';";
    $result = $conn->query($sql);
    $containers = array();
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $containers[] = $row;
        }
    }
    return $containers;
}

function updateContainerStatus($containers)
{
    // Update the container status in the system
    // Implement your logic here to update the container status
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Crane Operator Page</title>
</head>

<body>
    <h1>Crane Operator Page</h1>
    <form method="POST" action="">
        <label for="shipOrTruckID">Enter Ship or Truck ID:</label>
        <input type="text" name="shipOrTruckID" id="shipOrTruckID">
        <button type="submit">Submit</button>
    </form>
    <hr />
    <h2>Container Details</h2>
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
            <?php foreach ($containers as $container) : ?>
                <tr>
                    <td><?php echo $container['ContainerID'] ?></td>
                    <td><?php echo $container['SourceID'] ?></td>
                    <td><?php echo $container['DestinationID'] ?></td>
                    <td><?php echo $container['ContainerStatus'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
</body>

</html>