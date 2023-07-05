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
            echo "<script> alert('Password and Confirmation password are different. They must be the same.') </script></br>";
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
        $gender     = stripslashes($_REQUEST['gender']);
        $gender     = mysqli_real_escape_string($db_connection, $gender);
        $bio        = stripslashes($_REQUEST['bio']);
        $bio        = mysqli_real_escape_string($db_connection, $bio);
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

        $user_query      = "INSERT into `users` (username, password, email, gender, bio, create_datetime)
                        VALUES ('$username', '" . md5($password) . "', '$email', '$gender', ,'$bio', '$create_datetime')";
        $result     = mysqli_query($db_connection, $user_query);    
        
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
        <p>Create a username</br>
        <input type="text" name="username" placeholder="Username" required> </br>
        Enter your email address </br>
        <input type="email" name="email" placeholder="email@example.com" required> </br>
        Create a strong password </br>
        <input type="password" name="password" placeholder="Password" required> </br>
        <input type="password" name="cpassword" placeholder="Confirm password" required> </br>
        Sex:
            <input type="radio" name="gender" value="Female">Female
            <input type="radio" name="gender" value="Male">Male
            <input type="radio" name="gender" value="Cat">Cat
            <input type="radio" name="gender" value="Yes, please.">Yes, please.
            <input type="radio" name="gender" value="Other" checked>Other </br>
        Bio </br>
        <textarea name="bio" rows="10" cols="60"></textarea> </br>
        <!-- Select your avatar <input type="file" name="avatar" accept="image/png, image/jpeg"> </br> -->
        </br><input type="submit" name="submit" value="Register"></p>
        <p class="link">Already registered? <a href="login.php">Login</a> to our website</p>
        <p>Back to <a href="index.php">Home page</a></p>
    </form>
<?php
    }
?>
</body>
</html>
