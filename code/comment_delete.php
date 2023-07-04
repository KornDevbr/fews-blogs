<?php
    include("auth_session.php");

    if($_SERVER['REQUEST_METHOD'] == "GET") {
        require("db_connection.php");
        $comment_id = $_GET['id'];
        $article_id = $_GET['article_id'];
        $username = $_SESSION['username'];
        $comment_delete_query = mysqli_query($db_connection, "DELETE FROM `comments`
            WHERE (comment_id,username)=('$comment_id','$username')");
        if (isset($article_id)) {
            header("location:article.php?id=".$article_id);
            die();
        } else {
            header("location:dashboard.php");
            die();
        }
    }
