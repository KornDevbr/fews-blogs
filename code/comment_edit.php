<?php
    include('auth_session.php');
    require('db_connection.php');

    if (!empty($_GET['id'])) {
        $comment_id = $_GET['id'];
        $username = $_SESSION['username'];

        $comment_query = mysqli_query($db_connection, "SELECT * FROM `comments` 
            WHERE (comment_id,username)=('$comment_id','$username')");
        $comment_item = mysqli_fetch_array($comment_query);
        $count = mysqli_num_rows($comment_query);
        $article_id = $comment_item['article_id'];

        if($count > 0){
?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Edit Comment | Fews Blogs</title>
            </head>
            <body>
                <h3>Edit Comment</h3>
                <p>Go to <a href="article.php?id=<?php print $article_id ?>">Article</a></p>
                <p>Go to <a href="dashboard.php">Dashboard</a></p>
                <form action="" method="post">
                    <p>Comment</p>
                    <textarea 
                        name="edit_comment"
                        rows="2"
                        cols="60"
                        placeholder="Text here"
                        required><?php print $comment_item['comment'] ?></textarea></br>
                    <input type="submit" value="Edit" name="edit">
                </form>
            </body>
            </html>
<?php
        } else {
            include('page_not_found.php');
        }
    } else {
        include('page_not_found.php');
    }

    if (isset($_REQUEST['edit_comment'])) {
        $comment = mysqli_real_escape_string($db_connection, $_REQUEST['edit_comment']);
        $edit_datetime = date("Y-m-d H:i:s");

        $comment_edit_query = mysqli_query($db_connection, "UPDATE `comments`
            SET comment='$comment', edit_datetime='$edit_datetime'
            WHERE comment_id='$comment_id'");
        
        if ($comment_edit_query) {
            print "Comment was successfully updated";
        } else {
            print "ERROR: Comment wasn't updated";
        }
    }
