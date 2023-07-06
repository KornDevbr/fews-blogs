<?php
    include('auth_session.php');
    require('db_connection.php');
    include('user_panel.php');

    // Check does article id is not empty.
    if(!empty($_GET['id'])) {
        $article_id = $_GET['id'];
        $username = $_SESSION['username'];
        $article_query = mysqli_query($db_connection, "SELECT * FROM `articles` 
            WHERE (article_id,username)=('$article_id','$username')");
        $article_item = mysqli_fetch_array($article_query);
        $count = mysqli_num_rows($article_query);

        // Check does article exists.
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
                <a href="dashboard.php">My Articles</a></br>
                <a href="edit_article.php?id=<?php print $article_item['article_id'] ?>">Edit Article</a>
                <p><b>Published:</b> <?php print $article_item['public']?></p>
<?php
                // Appear "Show published article link when article is published."
                if ($article_item['public'] == "yes") {
                    print "<a href='article.php?id=" . $article_id . "'>Show published article</a>";
                }

                print "<p><b>Create Time:</b> ".$article_item['create_datetime']."</br>";
                // Show edited time if edit_datetime is not null.
                if ($article_item['edit_datetime'] != null){
                    print "<b>Edit Time:</b> ".$article_item['edit_datetime']."</p>";
                }

                print "
                    <h2 align='center'>".$article_item['topic']."</h2>
                    <p align='right'>Created by: <a href='user_profile.php?id=".$user_item['id']."'>".$article_item['username']."</a></p>
                    <p align='center'>".$article_item['content']."</p>
                ";

                $comment_query = mysqli_query($db_connection, "SELECT * FROM `comments` 
                    WHERE article_id='$article_id'");
                $count = mysqli_num_rows($comment_query);
                // Show comments if comments quantity bigger than zero.
                if ($count > 0) {
                    print "<p align='center'>Comments</p>";
                    $n = 1;
                    while ($comment_list_item = mysqli_fetch_array($comment_query)){
                        print "
                            <p>#".$n++." "."
                            <a href='user_profile.php?id=".$comment_list_item['username_id']."'>".$comment_list_item['username']."</a> "
                            .$comment_list_item['create_datetime']."</br>
                        ";
                        if ($comment_list_item['edit_datetime'] != null){
                            print "Edited: ".$comment_list_item['edit_datetime']."</br>";
                        }
                   print  $comment_list_item['comment']."</br>";
                    }
                }
?>
            </body>
            </html>
<?php
        // Show "Page not found" if article id isn't exists.
        } else {
            include("page_not_found.php");
        }
    // Show "Page not found" error if article without id.
    } else {
        include("page_not_found.php");
    }
?>
