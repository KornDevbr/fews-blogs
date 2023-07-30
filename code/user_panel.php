<head>
    <link href="styles/user_panel.css" rel="stylesheet"></link>
</head>
<ul>
    <li><a class="left_a" href="index.php">Homepage</a></li>
<?php
    require("db_connection.php");
    // Show register and login invitation for not logged in users.
    if(!isset($_SESSION['username'])) {
        print "
        <li class='right_a'><a href='login.php'>Log In</a></li>
        <li class='right_a'><a href='registration.php'>Register</a></li>
        <li class='right_a'><a href='about_us.php'>About us</a></li>
        ";
    // Show username and logout link for logged in users.
    } else {
        $login_user = $_SESSION['username'];
        $login_user_query = mysqli_query($db_connection, "SELECT * FROM `users` 
            WHERE username='$login_user'");
        $login_user_id = mysqli_fetch_array($login_user_query);
        print "
            <li class='left_a'><a href='dashboard.php'>My Articles</a></li>
            <li class='left_a'><a href='my_comments.php'>My Comments</a></li>
            <li class='right_a'><a href='logout.php'>Log out</a></li>
            <li class='right_a' class='border-none'><a href='user_profile.php?id=".$login_user_id['id']."'>".$_SESSION['username']."</a></li>
            <li class='right_p'><p>You logged in as: </p></li>
            <li class='right_a'><a href='about_us.php'>About us</a></li>
        ";
    }
?>
</ul>
