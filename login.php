<!doctype html>
<html lang="en">
<?php

    function login()
    {

        $host = "localhost";
        $username = "root";
        $pwd = "";
        $db_name = "COP4710";

        $email = $_POST["email"] ?? null;
        $password = $_POST["password"] ?? null;

        $conn = new mysqli($host, $username, $pwd, $db_name);
        $query = "SELECT * FROM Users WHERE Email='$email' AND Password='$password'";
        $result = $conn->query($query);

        if($result->num_rows == 1)
        {
          // Login Succesfull; tuple found
          // print_r("Success!");
          header('Location: https://localhost/ship-registration.html');
          exit();

        }
        else {
          // login failed;
         header('Location: https://localhost/signup.php');
          exit();
        }

        $conn->close();
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
    <?php
         login();
        ?>

    </main>

    </body>

</html>
