<?php
    session_start();
    include("user_panel.php");
    require('db_connection.php'); // Connection to database.
    
    if(!empty($_GET['id'])) {
        $article_id = $_GET['id'];
        $article_query =  mysqli_query($db_connection, "SELECT * FROM `articles` 
            WHERE (article_id,public)=('$article_id','yes')");
        $article_item  =  mysqli_fetch_array($article_query);
        $count = mysqli_num_rows($article_query);

        if($count > 0) {
            $username = $article_item['username'];
            $user_query = mysqli_query($db_connection, "SELECT * FROM `users` WHERE username='$username'");
            $user_item = mysqli_fetch_array($user_query);
?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title><?php print $article_item['topic'] ?> | Fews Blogs</title>
            </head>
            <body>
                <h2 align="center"><?php print $article_item['topic']?></h2> </br>
                <p align="right">Created by: <a href="user_profile.php?id=<?php print $user_item['id'] ?>"><?php print $article_item['username']?></a></p>
                <p align="center"><?php print $article_item['content']?></p>
                <p> <b>Create Time:</b> <?php print $article_item['create_datetime']?></p>
                <p> <b>Last Edit:</b> <?php print $article_item['edit_datetime']?></p> </br>
                <p align="center">Back to <a href=index.php>Homepage</a></p>
                <p align="center">Comments</p>
<?php           if (isset($_SESSION['username'])) {
?>
                <form action="" method="post">
                    <p>Add Comment</p>
                    <textarea 
                        name="comment" 
                        rows="2" 
                        cols="60"
                        placeholder="Text here"
                        required></textarea> </br>
                    <input type="submit" name="add_comment" value="Add Comment">
                </form>
<?php           }
?>
            </body>
            </html>
<?php
            if(isset($_REQUEST['comment'])) {
                $comment        = mysqli_real_escape_string($db_connection, $_REQUEST['comment']);
                $create_datetime = date("Y-m-d H:i:s");
                $article_id     = $article_item['article_id'];
                $article_topic  = $article_item['topic'];
                $username_id    = $user_item['id'];
                $username_email = $user_item['email'];
                
                $comment_query = mysqli_query($db_connection, "INSERT INTO `comments` (comment, create_datetime, article_id, article_topic, username, username_id, username_email)
                    VALUES ('$comment', '$create_datetime', '$article_id', '$article_topic', '$username', '$username_id', '$username_email')") or die(mysqli_error());
                
                if ($comment_query){
                    print "The comment has been add.";
                } else{
                    print "ERROR: The comment hasn't add.";
                }
            }
            print "<p>COMMENT_LIST</p>";
        } else {
            include("page_not_found.php");
        }
    } else {
        include("page_not_found.php");
    }
?>
