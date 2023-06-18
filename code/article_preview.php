<?php
    include('auth_session.php'); // Check user session.
    require('db_connection.php'); // Connection to database;

    if(!empty($_GET['id'])) {
        $article_id = $_GET['id'];
        $_SESSION['article_id'] = $article_id; // TODO Delete this variable ifit changes nothing.
        $username = $_SESSION['username'];

        $query = mysqli_query($db_connection, "SELECT * FROM `articles` 
            WHERE (article_id,username)=('$article_id','$username')");
        $item = mysqli_fetch_array($query);
        $count = mysqli_num_rows($query);

        if($count > 0) {
?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title><?php print $item['topic']?> | Fews Blogs</title>
            </head>
            <body>
                <h1>Preview Page</h1>
                <a href="edit_article.php?id=<?php print $item['article_id'] ?>">Edit Article</a>
                <p> <b>Published:</b> <?php print $item['public']?></p>
                <h2 align="center"><?php print $item['topic']?></h2>
                <p align="right">Created by: <a href=user_profile.php><?php print $item['username']?></a></p>
                <p align="center"><?php print $item['content']?></p>
                <p> <b>Create Time:</b> <?php print $item['create_datetime']?></p>
                <p> <b>Edit Time:</b> <?php print $item['edit_datetime']?></p>
                <p>Back to <a href="dashboard.php">Dashboard</p>
            </body>
            </html>
<?php 
        } else {
            include("article_does_not_exist.php");
        }
    } else {
        include("article_does_not_exist.php");
    }
?>
