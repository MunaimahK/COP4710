<!doctype html>
<html lang="en">
<?php
require('utils.php');
function login()
{
  $email = $_POST["email"];
  $password = $_POST["password"];

  $conn = createConnection();
  $sql = "SELECT * FROM Users WHERE Email='$email' AND Password='$password'";
  $result = $conn->query($sql);

  if ($result->num_rows == 1) {
    header('Location: /ship-registration.html');
  } else {
    header('Location: /signup.php');
  }

  $conn->close();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  login();
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
    <h1>Login</h1>
    <form action="login.php" method="post">
      <label for="email">Email</label>
      <input type="email" id="email" name="email">
      <div>
        <label for="password">Password</label>
        <input type="password" id="password" name="password">
      </div>
      <button>Log In</button>
    </form>
  </main>
</body>

</html>