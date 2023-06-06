<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Fews-Blogs</title>
</head>
<body>
    <h1>Login</h1>
    <?php
        require('db_connection.php');
        session_start();
        // When form submitted, check and create user sesion.
        if (isset($_POST['username'])) {
            $username   = stripslashes($_REQUEST['username']); // removes backslashes
            $username   = mysqli_real_escape_string($db_connection, $username);
            $password   = stripslashes($_REQUEST['password']);
            $password   = mysqli_real_escape_string($db_connection, $password);
            // Checkuser is exist in the database.
            $query      = "SELECT * FROM `users` WHERE username='$username' AND password='" . md5($password) . "'";
            $result     = mysqli_query($db_connection, $query) or die(mysql_error());
            $rows       = mysqli_num_rows($result);
            if ($rows == 1) {
                $_SESSION['username'] = $username;
                // Redirect to user dashboard page.
                header("Location: dashboard.php");
            } else {
                echo "<h3>Incoorect Username or password.</h3></br>
                      <p class='link'>Click here to <a href='login.php'>Login</a> again.</p>";
            }
        } else {
    ?>
        <form method="post" name="login">
            <input type="text" name="username" placeholder="Username" autofocus="true"> </br>
            <input type="password" name="password" placeholder="Password"> </br>
            <input type="submit" value="Login" name="submit"> </br>
            <p><a href="registration.php">New Registration</a></p>
        </from>            
    <?php        
        }
    ?>
    <a href="index.php">Go back to home page</a>
</body>
</html>