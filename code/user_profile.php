<?php
    session_start();
    require("db_connection.php");

    if(!empty($_GET['id'])) {
        $user_id = $_GET['id'];
        
        $user_query = mysqli_query($db_connection, "SELECT * FROM `users` WHERE id='$user_id'");
        $user_item  = mysqli_fetch_array($user_query);
        $count = mysqli_num_rows($user_query);

        if($count > 0) {
            $username   = $user_item['username'];
            $article_query = mysqli_query($db_connection, "SELECT * FROM `articles` WHERE (username,public)=('$username','yes')");
            $article_item  = mysqli_fetch_array($article_query);
?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title><?php print $username ?> | Fews Blogs</title>
            </head>
            <body>
                <h1><?php print $username ?>'s profile page</h1>
                <p><b>Registration date:</b> <?php print $user_item['create_datetime'] ?></p>
                <p><b>Sex:</b> <?php print $user_item['gender'] ?></p>
                <p><b>Emal:</b> <a href="mailto:<?php print $user_item['email'] ?>"><?php print $user_item['email'] ?></a>
<?php
                if(isset($_SESSION['username'])){
                    if($_SESSION['username'] == $username){
                        print "</br><a href='user_profile_edit?id=" . $user_item['id'] . "'>Edit profile page</a>";
                    }
                }
?>
                <p>Back to <a href="index.php">Homepage</a></p>
                <h2 align="center"><?php print $user_item['username'] ?>'s articles</h2>
<?php
                while ($article_item = mysqli_fetch_array($article_query)) {
?> 
                    <h3><a href="article.php?id=<?php print $article_item['article_id'] ?>"><?php print $article_item['topic'] ?></a></h3>
                    <p><b>Created:</b> <?php print $article_item['create_datetime'] ?></p>
<?php
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
