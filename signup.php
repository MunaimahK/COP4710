<!doctype html>
<html lang="en">
<?php
include 'utils.php';

function createUser()
{
  $name = $_POST["name"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $conn = createConnection();
  $query = "INSERT INTO Users(Name, Email, Password) VALUES ('" . $name . "', '" . $email . "', '" . $password . "');";
  $conn->query($query);
  $conn->close();
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  createUser();
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
    <h1>Signup</h1>

    <form action="signup.php" method="post">
      <div>
        <label for="name">Name</label>
        <input type="text" id="name" name="name">
      </div>
      <label for="email">Email</label>
      <input type="email" id="email" name="email">
      <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
      </div>
      <button>Sign Up</button>

    </form>


  </main>


</body>

</html>