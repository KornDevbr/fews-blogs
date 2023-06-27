<?php
    require("db_connection.php");
    if(!isset($_SESSION['username'])) {
        print "<p><a href='registration.php'>Register</a></br>
               <a href='login.php'>Log In</a></p>";
    } else {
        $login_user = $_SESSION['username'];
        $login_user_query = mysqli_query($db_connection, "SELECT * FROM `users` WHERE username='$login_user'");
        $login_user_id = mysqli_fetch_array($login_user_query);
        print "
        <p>You logged in as <a href='user_profile.php?id=" . $login_user_id['id'] . "'>" . $_SESSION['username'] . "</a></br>
        <a href='logout.php'>Log out</a></p>
        ";
    }
