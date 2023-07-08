<?php
    session_start();
    include("user_panel.php");
    require("db_connection.php");
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
    <p align="right"><a href="about_us.php">About us</a></p>
    <h1 align="center">Fews Blogs</h1>
    <h2 align="center">Share us any of your thoughts</h2>
<?php
    print "<p>Today is " . date("j M Y") . "</p>";
    // Show links for logged in users.
    if(isset($_SESSION['username'])) {
        print "<p>
                <a href='dashboard.php'>My Articles</a>
                </br>
                <a href='add_article.php'>Add Article</a>
            </p>";
    }
    $article_query      = mysqli_query($db_connection, "SELECT * FROM `articles`
        WHERE public='yes' ORDER BY create_datetime DESC") or die(mysqli_error());

    while ($article_item = mysqli_fetch_array($article_query)) {
        $username   = $article_item['username'];
        $user_query = mysqli_query($db_connection, "SELECT * FROM `users`
            WHERE username='$username'");
        $user_item  = mysqli_fetch_array($user_query);
?>
        <h2 align="center">
            <a href="article.php?id=<?php print $article_item['article_id'] ?>"><?php print $article_item['topic'] ?></a>
        </h2>
        <p><b>Create: </b><?php print $article_item['create_datetime'] ?>
        </br>
<?php   
        // Show "Edited" time if article was edit.
        if ($article_item['edit_datetime'] != null){
            print "<b>Edited: </b>" . $article_item['edit_datetime'] . "</p>";
        } else {
            print "</p>";
        }

        print "
            <p align='right'>Created by: 
                <a href='user_profile.php?id=".$user_item['id']."'>".$article_item['username']."</a>
            </p>
        ";
        print "<p>".$article_item['content']."</p>";
        $comment_query = mysqli_query($db_connection, "SELECT * FROM `comments` 
            WHERE article_id='$article_item[article_id]'");
        $comment_count = mysqli_num_rows($comment_query);
        print "<p>Comments(".$comment_count.")</p>";
    }
?>
</body>
</html>
