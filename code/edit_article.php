<?php
// Include db_connection.php file ona all user panelpages
include("auth_session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Article | Fews Blogs</title>
</head>
<body>
    <h1>ARTICLE_NAME Article editing<h1>
    <a href="logout.php">Logout</a>
    <p>Go Back to <a href="dashboard.php">Dashboard</a><p>
<?php
    require('db_connection.php'); // Connect to database.
    if(!empty($_GET['article_id'])) {
        $article_id = $_GET['article_id'];
    }
?>
</body>
</html>