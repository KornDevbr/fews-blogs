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
    <p>Hey, <?php echo $_SESSION['username']; ?>!</p>
    <p>You are on the user dasboard page now.</p>
    <p><a href="logout.php">Logout</a></p>
</body>
</html>
