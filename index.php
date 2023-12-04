<!doctype html>
<html>

<head>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css" />
</head>
<?php
require 'vendor/autoload.php'; // Load Composer autoloader
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
?>

<body class="body">
  <div class="nav">
    <nav>
      <ul>
        <div class="nav">
          <a href="/ship-registration.html">Ship Registration </a>
          <a href="#">Port Entry </a>
          <a href="#">Port Exit </a>
          <a href="#">Crane Operator</a>
          <a href="#">Truck Registration</a>
          <a href="#">Truck Driver Registration</a>
          <a href="#">Container Company Registration</a>
          <a href="#">Port Admin Management</a>
        </div>
    </nav>
</body>

</html>