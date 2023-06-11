<?php
// Include db_connect.php file on all user panel pages
include("auth_session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasboard | Fews Blogs</title>
</head>
<body>
    <h1 align="center">Hey, <?php echo $_SESSION['username']; ?>!</h1>
    <p align="right"><a href="logout.php">Logout</a></p>
    <h2 align="center">What will you share with us today?</h2>
    <a href="add_article.php">Add Article</a>
    <p> Your Articles </p>
</body>
</html>
