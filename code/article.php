<?php
    require('db_connection.php'); // Connection to database.

    function article_not_found(){ 
?>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <title>Not Found | Fews Blogs</title>
        </head>
        <body>
            <h1 align='center'>The article doesn't exist</h1>
        </body>
<?php
    }
    
    if(!empty($_GET['id'])) {
        $article_id = $_GET['id'];
        $_SESSION['article_id'] = $article_id; // TODO Delete this variable if it changes nothing.

        $query =  mysqli_query($db_connection, "SELECT * FROM `articles` WHERE article_id='$article_id'");
        $item  =  mysqli_fetch_array($query);
        $count = mysqli_num_rows($query);

        if($count > 0) { 
?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title><?php print $item['topic'] . " | Fews Blogs"?></title>
            </head>
            <body>
                <h2 align="center"><?php print $item['topic']?></h2> </br>
                <p align="right">Created by: <?php print $item['username']?></p>
                <p align="center"><?php print $item['content']?></p>
                <p> <b>Create Time:</b> <?php print $item['create_datetime']?></p>
                <p> <b>Last Edit:</b> <?php print $item['edit_datetime']?></p> </br>
                <p align="center">POSSIBLE_COMMENT_SECTION_HERE</p>
            </body>
            </html>
<?php
        } else {
            article_not_found();
        }
    } else {
        article_not_found();
    }
?>
