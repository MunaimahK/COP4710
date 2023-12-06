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
    $seconds_per_day = 86400;
    setcookie("auth_token", $email, time() + ($seconds_per_day * 30), "/");
    header('Location: /ship-register.php');
  } else {
    header('Location: /login.php?invalid_auth=Invalid login');
  }

  $conn->close();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  login();
}

function checkAuthParams()
{
  if (isset($_GET["invalid_auth"])) {
    echo ($_GET["invalid_auth"]);
  }
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
      <label for="password">Password</label>
      <input type="password" id="password" name="password">
      <button>Log In</button>
    </form>
    <p class="error">
      <?php checkAuthParams(); ?>
    </p>
  </main>
</body>

</html>
