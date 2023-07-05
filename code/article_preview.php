<?php
    include('auth_session.php'); // Check user session.
    require('db_connection.php'); // Connection to database;
    include('user_panel.php');

    if(!empty($_GET['id'])) {
        $article_id = $_GET['id'];
        $_SESSION['article_id'] = $article_id; // TODO Delete this variable ifit changes nothing.
        $username = $_SESSION['username'];
        $article_query = mysqli_query($db_connection, "SELECT * FROM `articles` 
            WHERE (article_id,username)=('$article_id','$username')");
        $article_item = mysqli_fetch_array($article_query);
        $count = mysqli_num_rows($article_query);

        if($count > 0) {
            $user_query = mysqli_query($db_connection, "SELECT * FROM `users` 
                WHERE username='$username'");
            $user_item = mysqli_fetch_array($user_query);
?>             
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title><?php print $article_item['topic']?> | Fews Blogs</title>
            </head>
            <body>
                <h1>Preview Page</h1>
                <p><a href="dashboard.php">My Articles</a></p>
                <a href="edit_article.php?id=<?php print $article_item['article_id'] ?>">Edit Article</a>
                <p> <b>Published:</b> <?php print $article_item['public']?></p>
<?php           if ($article_item['public'] == "yes") {
                    print "<a href='article.php?id=" . $article_id . "'>Show published article</a>";
                }           
?>
                <h2 align="center"><?php print $article_item['topic']?></h2>
                <p align="right">Created by: <a href="user_profile.php?id=<?php print $user_item['id'] ?>"><?php print $article_item['username']?></a></p>
                <p> <b>Create Time:</b> <?php print $article_item['create_datetime']?></br>
                <b>Edit Time:</b> <?php print $article_item['edit_datetime']?></p>
                <p align="center"><?php print $article_item['content']?></p>
<?php
                $comment_query = mysqli_query($db_connection, "SELECT * FROM `comments` WHERE article_id='$article_id'");
                $count = mysqli_num_rows($comment_query);
                if ($count > 0) {
                    print "<p align='center'>Comments</p>";
                    $n = 1;
                    while ($comment_list_item = mysqli_fetch_array($comment_query)){
                        print "<p>#" . $n++ . " " . "<a href='user_profile.php?id=" . $comment_list_item['username_id'] . "'>"
                        . $comment_list_item['username'] . "</a> " . $comment_list_item['create_datetime'] . "</br>";
                        if ($comment_list_item['edit_datetime'] != null){
                            print "Edited: " . $comment_list_item['edit_datetime'] . "</br>";
                        }
                   print  $comment_list_item['comment'] . "</br>";
                    }
                }
?>
            </body>
            </html>
<?php 
        } else {
            include("page_not_found.php");
        }
    } else {
        include("page_not_found.php");
    }
?>
