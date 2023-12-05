<!DOCTYPE html>
<html lang="en">

<?php
require('utils.php');

function createContainer()
{
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $conn = createConnection();
       # $sql = "INSERT INTO Containers () VALUES ();";
       # $res = $conn->query($sql);
        $containerID = $conn->insert_id;
        $sql = "INSERT INTO Containers (ContainerID, CompanyName, SourceID, DestinationID, StorageAreaID) VALUES ('" . $containerID . "', '" . $_POST['CompanyName'] . "', '" . $_POST['SourceID'] . "', '" . $_POST['DestinationID'] . "', '" . $_POST['StorageAreaID'] . "');";
        $res = $conn->query($sql);
        if ($res === TRUE) {
            echo "Container created successfully";
        } else {
            echo "Error creating container: " . $conn->error;
        }
        $conn->close();
    }
}

?>

<head>
    <title>Container Registration</title>
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
        <h1>Create Container</h1>
        <form action="container-registration.php" method="post">
            <label for="CompanyName">Company Name:</label><br>
            <input type="text" id="CompanyName" name="CompanyName"><br>
            <label for="SourceID">Source ID:</label><br>
            <input type="text" id="SourceID" name="SourceID"><br>
            <label for="DestinationID">Destination ID:</label><br>
            <input type="text" id="DestinationID" name="DestinationID"><br>
            <label for="StorageAreaID">Storage Area ID:</label><br>
            <input type="text" id="StorageAreaID" name="StorageAreaID"><br><br>
            <button type="submit">Create Container</button>
        </form>
        <p>
        <?php
        createContainer();
        ?>
    </p>
    </main>
    
</body>

</html>