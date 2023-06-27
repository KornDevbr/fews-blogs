<?php
    session_start();
    include("user_panel.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Fews Blogs</title>
</head>
<body>
<?php
    require("db_connection.php");
?>
    <h1 align="center">Fews Blogs</h1>
    <h2 align="center">Share us any of your thoughts</h2> </br> </br>
<?php
    print "Today is " . date("j M Y");
    if(isset($_SESSION['username'])) {
        print "<p>Go to <a href='dashboard.php'>Dashboard</a></p>";
    }
    $query      = mysqli_query($db_connection, "SELECT * FROM `articles` WHERE public='yes'") or die(mysqli_error());
    $item       = mysqli_fetch_array($query);
    $username   = $item['username'];
    $user_query = mysqli_query($db_connection, "SELECT * FROM `users` WHERE username='$username'");
    $user_item  = mysqli_fetch_array($user_query);

    while ($item = mysqli_fetch_array($query)) {
?>
        <h2 align="center"><a href="article.php?id=<?php print $item['article_id'] ?>"><?php print $item['topic'] ?></a></h2>
        <p><b>Create Time: </b><?php print $item['create_datetime'] ?> <b>Last Edit: </b><?php print $item['edit_datetime'] ?></p>
        <p align="right">Created by: <a href="user_profile.php?id=<?php print $user_item['id'] ?>"><?php print $item['username'] ?></a></p>
        <p><?php print $item['content'] ?></p>        
<?php
    }
?>
</body>
</html>
