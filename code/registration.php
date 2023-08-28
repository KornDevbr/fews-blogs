<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration | Fews Blogs</title>
    <link href="styles/main.css" rel="stylesheet"/>
    <link href="styles/registration.css" rel="stylesheet"/>
    <link href='https://fonts.googleapis.com/css?family=Space+Mono|Muli|Sofia' rel='stylesheet'>
    <!-- Icons kit. -->
    <script src="https://kit.fontawesome.com/743929e53b.js" crossorigin="anonymous"></script>
</head>
<header class="user_panel">
    <?php include("user_panel.php") ?>
</header>
<body>
<?php
    require('db_connection.php');
    // When form submitted insert values into the database.
    if (isset($_REQUEST['username'])) {
        // Check do passwords are different.
        if ($_REQUEST['password'] != $_REQUEST['cpassword']) {
            echo "<script> alert('Password and Confirmation password are different. They must be the same.') </script></br>";
            echo "<script> window.location='registration.php' </script>";
            exit();
        }
        $username   = stripslashes($_REQUEST['username']); // Removes backslashes.
        $username   = mysqli_real_escape_string($db_connection, $username); // Escapes special characters in a string.
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
        $get_user   = mysqli_query($db_connection, "SELECT * FROM users 
            WHERE username='$username';");
        // Checking does the given username already exist.
        if (mysqli_num_rows($get_user) > 0){
            echo "<script> alert('This username already exists.') </script></br>";
            echo "<script> window.location='registration.php' </script>";
            exit();
        }
        $get_email = mysqli_query($db_connection, "SELECT * FROM users 
            WHERE email='$email';");
        // Checking does the given email already in use.
        if (mysqli_num_rows($get_email) > 0){
            echo "<script> alert('This email already in use.') </script></br>";
            echo "<script> window.location='registration.php' </script>";
            exit();
        }

        $user_create_query = "INSERT into `users` (username, password, email, gender, bio, create_datetime)
                        VALUES ('$username', '" . md5($password) . "', '$email', '$gender', '$bio', '$create_datetime')";
        $result = mysqli_query($db_connection, $user_create_query);    
        
        if ($result) {
            echo "<div class='info_msg'>
                        <p class='info_msg_text'>You are registered successfully.</p>
                        <p class='info_msg_link'>Click here to <a href='login.php'>Login</a></p>
                    </div>";
        } else {
            echo "<div class='info_msg'>
                        <p class='info_msg_text'>Required fields are missing.</p>
                        <p class='info_msg_link'>Click here to <a href='registration.php</a>registration</a> again.</p>
                    </div>";
        }
    // Show a registration form if there isn't a registration user query.    
    } else {
?>
    <form action="" method="post">
        <h1>Registration</h1>
        <div class="inline">
            <p>Username</p>
            <p class="asterisk">*</p>
        </div>
        <input type="text" name="username" required>
        <div class="inline">
            <p>Email</p>
            <p class="asterisk">*</p>
        </div>
        <input type="email" name="email" placeholder="email@example.com" required>
        <div class="inline">
            <p>Password</p>
            <p class="asterisk">*</p>
        </div>
        <input type="password" name="password" required>
        </br>
        <input type="password" name="cpassword" placeholder="Confirm password" required>
        <p>Sex</p>
            <input type="radio" name="gender" value="Female">Female
            <input type="radio" name="gender" value="Male">Male
            <input type="radio" name="gender" value="Cat">Cat
            <input type="radio" name="gender" value="Yes, please.">Yes, please.
            <input type="radio" name="gender" value="Other" checked>Other
        <p>Bio</p>
        <textarea name="bio" rows="10" cols="60"></textarea><br>
        <!-- Select your avatar <input type="file" name="avatar" accept="image/png, image/jpeg"> </br> -->
        <input type="submit" name="submit" value="Register"></p>
        <p class="link">Already registered? <a href="login.php">Login</a> to our website</p>
    </form>
<?php
    }
?>
</body>
<footer class="footer">
    <?php include("footer.php") ?>
</footer>
</html>
