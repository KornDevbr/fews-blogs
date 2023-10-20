<?php
    include("auth_session.php");

    // Variables to passing arguments from URL.
    $article =  $url[0];
    $article_id = $url[1];

    if($_SERVER['REQUEST_METHOD'] == "GET") {
        require("db_connection.php");
        $article_id = $url[1];
        $username = $_SESSION['username'];
        $article_delete_query = mysqli_query($db_connection, "DELETE FROM `articles` 
            WHERE (article_id,username)=('$article_id','$username')");
        header("location:/dashboard");
        die();
    }
