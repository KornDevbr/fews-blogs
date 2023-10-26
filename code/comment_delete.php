<?php
    include("auth_session.php");

    // Variables to passing arguments from URL.
    $comment =  $url[0];
    $comment_id = $url[1];

    if($_SERVER['REQUEST_METHOD'] == "GET") {
        require("db_connection.php");
        $comment_id = $url[1];
        //$article_id = $_GET['article_id'];
        $username = $_SESSION['username'];
        $comment_delete_query = mysqli_query($db_connection, "DELETE FROM `comments`
            WHERE (comment_id,username)=('$comment_id','$username')");

        header("location:$_SERVER[HTTP_REFERER]");
        die();

//        if (isset($article_id)) {
//            header("location:article.php?id=".$article_id);
//            die();
//        } else {
//            header("location:my_comments.php");
//            die();
//        }
    }
