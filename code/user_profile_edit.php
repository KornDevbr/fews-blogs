<?php
    include("auth_session.php");
    require("db_connection.php");

    if (isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        $user_query = mysqli_query($db_connection, "SELECT * FROM `users` WHERE username='$username'");
        $user_item = mysqli_fetch_array($user_query);
        
        function edit_user_profile($name,$value) {
            mysqli_qery($db_connection, "UPDATE `users` SET $name='$value' WHERE username='$username'");
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
        <h2>Email</h2>
        <form action="" method="post">
            <p>Enter the email address</p>
                <input type="email" name="email"> <br/>
                <input type="submit" name="change_email" value="Change">
        </form>
<?php
        if (isset($_REQUEST['email'])) {
            $name = "email";
            $value = $_REQUEST['email'];
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
        <h2>Password</h2>
        <form action="" method="post">
            <p>Change password</p>
                <input type="password" name="password" placeholder="Password"></br>
                <input type="cpassword" name="cpassword" placeholder="Confirm password"></br>
                <input type="submit" name="change_password" value="Change">
        </form>
        <h2>Bio</h2>
        <form action="" method="post">
            <p>Change Bio</p>
            <textarea name="bio" rows="10" cols="60"></textarea></br>
            <input type="submit" name="edit_bio" value="Change">
        </form>
    </body>
    </html>
<?php
    }

    if(isset($_REQUEST['changed_item'])){
        $changed  = stringslashes($_REQUEST['changed_item']);

        
    }