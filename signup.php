<!doctype html>
<html lang="en">
<?php

    function createUser()
    {

        $host = "localhost";
        $username = "root";
        $pwd = "";
        $db_name = "COP4710";

        $name = $_POST["name"];
        $email = $_POST["email"];
        $password = $_POST["password"];
        // var_dump($name, $email, $password);
        if(empty($_POST["name"]))
        {
            print_r("Name is required");
        }

              
        $mysqli = new mysqli("localhost", "root", "", "COP4710");
        $id = $mysqli->insert_id;
        $query = "INSERT INTO Users VALUES ('". $mysqli->insert_id ."', '". $name ."', '" . $email . "', '". $password ."');";
        $mysqli->query($query);
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
 
        <?php
         createUser();
        ?>


    </body>

</html>
