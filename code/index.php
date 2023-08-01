<?php
    session_start();
    require("db_connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home | Fews Blogs</title>
    <!-- <link href="styles/reset.css" rel="stylesheet" /> -->
    <link href="styles/main.css" rel="stylesheet" />
    <link href="styles/homepage.css" rel="stylesheet" />
    <link href='https://fonts.googleapis.com/css?family=Space+Mono|Muli|Sofia' rel='stylesheet'>
    <!-- Icons kit. -->
    <script src="https://kit.fontawesome.com/743929e53b.js" crossorigin="anonymous"></script>
</head>
<header class="user_panel">
    <?php include("user_panel.php") ?>
</header>
<body>
    <h1 class="sitename">Fews Blogs</h1>
    <h2 class="slogan">Share us any of your thoughts</h2>
<?php
    $article_query      = mysqli_query($db_connection, "SELECT * FROM `articles`
        WHERE public='yes' ORDER BY create_datetime DESC") or die(mysqli_error());
    print "<div class='article'>";
    while ($article_item = mysqli_fetch_array($article_query)) {
        $username   = $article_item['username'];
        $user_query = mysqli_query($db_connection, "SELECT * FROM `users`
            WHERE username='$username'");
        $user_item  = mysqli_fetch_array($user_query);
?>
        <h3 class="topic">
            <a href="article.php?id=<?php print $article_item['article_id'] ?>"><?php print $article_item['topic'] ?></a>
        </h3>
        <ul class="article_info">
            <li class="right">
                <p class="text">Created by
                    <a class="user" href="user_profile.php?id=<?php print $user_item['id']?>"><?php print $article_item['username'] ?></a>
                </p>
            </li>
<?php   
        // Show "Edited" time if article was edit.
        if ($article_item['edit_datetime'] != null){
            print "
                <li class='left'>
                        <p class='text'>
                            Last Edit: 
                        </p>
                        <p class='datetime'>
                            " . $article_item['edit_datetime'] . "
                        </p>
                    </li>";
        } else {
            print "
                <li class='left'>
                    <p class='text'>
                        Create: 
                    </p>
                    <p class='datetime'>
                        ".$article_item['create_datetime']."
                    </p>
                </li>";
        }
        print "</ul>
                <br>";
        print "<p class='article_content'>".$article_item['content']."</p>";
        $comment_query = mysqli_query($db_connection, "SELECT * FROM `comments` 
            WHERE article_id='$article_item[article_id]'");
        $comment_count = mysqli_num_rows($comment_query);
        print "<a class='comment' href='article.php?id=".$article_item['article_id']."'>Comments(".$comment_count.")</a>";
    }
?>
        </div>
</body>
<footer class="footer">
    <?php include("footer.php") ?>
</footer>
</html>
