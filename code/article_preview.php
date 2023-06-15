<?php
    include('auth_session.php'); // Check user session.
    require('db_connection.php'); // Connection to database;

    if(!empty($_GET['id'])) {
        $article_id = $_GET['id'];
        $_SESSION['article_id'] = $article_id; // TODO Delete this variable ifit changes nothing.
        $id_exists = true;

        $query = mysqli_query($db_connection, "SELECT * FROM `articles` WHERE article_id='$article_id'");
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
</body>
</html>
