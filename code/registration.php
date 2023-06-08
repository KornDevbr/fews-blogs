<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration | Fews Blogs</title>
</head>
<body>
    <h1>Fews Blogs Registration</h1>
    <h3>Please fill the registration form</h3> </br>

<?php
    require('db_connection.php');
    // When form submitted, insert values into the database.
    if (isset($_REQUEST['username'])) {
        // Checking do password are different.
        if ($_REQUEST['password'] != $_REQUEST['cpassword']) {
            echo "<script> alert('Password and Confirmation password you inputed are different. They must be the same.') </script></br>";
            echo "<script> window.location='registration.php' </script>";
            exit();
        }
        // Removes backslashes.
        $username   = stripslashes($_REQUEST['username']);
        // Escapes specail characters in a string.
        $username   = mysqli_real_escape_string($db_connection, $username);
        $email      = stripslashes($_REQUEST['email']);
        $email      = mysqli_real_escape_string($db_connection, $email);
        $password   = stripslashes($_REQUEST['password']);
        $password   = mysqli_real_escape_string($db_connection, $password);
        $cpassword  = stripslashes($_REQUEST['cpassword']);
        $gender     = 'other';
        $gender     = stripslashes($_REQUEST['gender']);
        $gender     = mysqli_real_escape_string($db_connection, $gender);
        $create_datetime = date("Y-m-d H:i:s");
        // Checking does the given username already exist.
        $get_user   = mysqli_query($db_connection, "SELECT * FROM users WHERE username='$username';");
        if (mysqli_num_rows($get_user) > 0){
            echo "<script> alert('This username already exists.') </script></br>";
            echo "<script> window.location='registration.php' </script>";
            exit();
        }
        // Checking does the given email already in use.
        $get_email  = mysqli_query($db_connection, "SELECT * FROM users WHERE email='$email';");
        if (mysqli_num_rows($get_email) > 0){
            echo "<script> alert('This email already in use.') </script></br>";
            echo "<script> window.location='registration.php' </script>";
            exit();
        }

        $query      = "INSERT into `users` (username, password, email, gender, create_datetime)
                        VALUES ('$username', '" . md5($password) . "', '$email', '$gender', '$create_datetime')";
        $result     = mysqli_query($db_connection, $query);    
        
        if ($result) {
            echo "<div class='form'>
                    <h3>You are registered successfully.</h3><br/>
                    <p class='link'>Clickhere to <a href='login.php'>Login</a></p>
                    </div>";
        } else {
            echo "<div class='form'>
                    <h3>Required fields are missin.</h3><br/>
                    <p class='link'>Click here to <a href='registration.php</a>registration</a> again.</p>
                    </div>";
        }
    } else {
?>
    <form action="" method="post">
        <h1>Registration</h1>
        <input type="text" name="username" placeholder="Username" value="<?php ?>" required> </br>
        <input type="email" name="email" placeholder="Email" required> </br>
        <input type="password" name="password" placeholder="Password" required> </br>
        <input type="password" name="cpassword" placeholder="Confirm password" required> </br>
        Gender
            <input type="radio" name="gender" value="female">Female
            <input type="radio" name="gender" value="male">Male
            <input type="radio" name="gender" value="cat">Cat
            <input type="radio" name="gender" value="other" checked>Other </br>
        Select your avatar <input type="file" name="avatar" accept="image/png, image/jpeg"> </br>
        <input type="submit" name="submit" value="Register">
        <p class="link">Already registered? <a href="login.php">Login</a> to the website</p>
        <p> Go back to <a href="index.php">Home</a> page</p>
    </form>
<?php
    }
?>
</body>
</html>