<?php
    include("auth_session.php");
    require("db_connection.php");

    $username = $_SESSION['username'];
    $user_query = mysqli_query($db_connection, "SELECT * FROM `users` WHERE username='$username'");
    $user_item = mysqli_fetch_array($user_query);

    function edit_user_profile($name, $value) {
        global $username, $db_connection;
        $user_query = mysqli_query($db_connection, "UPDATE `users` SET $name='$value'
            WHERE username='$username'") or die(mysqli_error());
        if($user_query){
            print "The " . $name . " has changed successfully.";
        } else {
            print "The " . $name . " wasn't changed.";
        }
    }
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Profile Edit | Fews News</title>
    </head>
    <body>
        <h1>User Profile Edit</h1>
        <p>Back to <a href="user_profile.php?id=<?php print $user_item['id'] ?>">Profile page</a>
        <h2>Email</h2>
        <form action="" method="post">
            <p>Enter the email address</p>
                <input type="email" name="email"> <br/>
                <input type="submit" name="change_email" value="Change">
        </form>
<?php
        if (isset($_REQUEST['email'])) {
            $name = "email";
            $value = mysqli_real_escape_string($db_connection, $_REQUEST['email']);
            edit_user_profile($name, $value);
        }
?>
        <h2>Gender</h2>
        <form action="" method="post">
            <p>Change gender</p>
                <input type="radio" name="gender" value="female">Female
                <input type="radio" name="gender" value="male">Male
                <input type="radio" name="gender" value="cat">Cat
                <input type="radio" name="gender" value="other" checked>Other</br>
                <input type="submit" name="change_gender" value="Change">
        </form>
<?php
        if (isset($_REQUEST['gender'])){
            $name = "gender";
            $value = mysqli_real_escape_string($db_connection, $_REQUEST['gender']);
            edit_user_profile($name, $value);
        }
?>
        <h2>Password</h2>
        <form action="" method="post">
            <p>Change password</p>
                <input type="password" name="password" placeholder="Password"></br>
                <input type="password" name="cpassword" placeholder="Confirm password"></br>
                <input type="submit" name="change_password" value="Change">
        </form>
<?php
        if (isset($_REQUEST['password'])){
            if ($_REQUEST['password'] == $_REQUEST['cpassword']){
                $name = "password";
                $password = mysqli_real_escape_string($db_connection, $_REQUEST['password']);
                $value = md5($password);
                edit_user_profile($name, $value);
            } else {
                print "ERROR: Password and Confirmation password are different. Password wasn't changed.";
            }
        }
?>
        <h2>Bio</h2>
        <form action="" method="post">
            <p>Change Bio</p>
            <textarea name="bio" rows="10" cols="60"></textarea></br>
            <input type="submit" name="edit_bio" value="Change">
        </form>
<?php
        if (isset($_REQUEST['bio'])){
            $name = "bio";
            $value = mysqli_real_escape_string($db_connection, $_REQUEST['bio']);
            edit_user_profile($name,$value);
        }
?>
    </body>
    </html>
