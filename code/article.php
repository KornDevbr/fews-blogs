<?php
    require('db_connection.php'); // Connection to database.
    
    if(!empty($_GET['id'])) {
        $article_id = $_GET['id'];
        $_SESSION['article_id'] = $article_id; // TODO Delete this variable if it changes nothing.

        $query =  mysqli_query($db_connection, "SELECT * FROM `articles` 
            WHERE (article_id,public)=('$article_id','yes')");
        $item  =  mysqli_fetch_array($query);
        $usernmae = $item['username'];
        $user_query = mysqli_query($db_connection, "SELECT * FROM `users` WHERE username='$usernmae'");
        $user_item = mysqli_fetch_array($user_query);
        $count = mysqli_num_rows($query);

        if($count > 0) { 
?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title><?php print $item['topic'] ?> | Fews Blogs</title>
            </head>
            <body>
                <h2 align="center"><?php print $item['topic']?></h2> </br>
                <p align="right">Created by: <a href="user_profile.php?id=<?php print $user_item['id'] ?>"><?php print $item['username']?></a></p>
                <p align="center"><?php print $item['content']?></p>
                <p> <b>Create Time:</b> <?php print $item['create_datetime']?></p>
                <p> <b>Last Edit:</b> <?php print $item['edit_datetime']?></p> </br>
                <p align="center">Back to <a href=index.php>Homepage</a></p>
                <p align="center">POSSIBLE_COMMENT_SECTION_HERE</p>
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
