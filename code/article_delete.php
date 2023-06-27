<?php
    include("auth_session.php");

    if($_SERVER['REQUEST_METHOD'] == "GET") {
        require("db_connection.php");
        $article_id = $_GET['id'];
        $username = $_SESSION['username'];
        $query = mysqli_query($db_connection, "DELETE FROM `articles` 
            WHERE (article_id,username)=('$article_id','$username')");
        header("location:dashboard.php");
    }
?>
