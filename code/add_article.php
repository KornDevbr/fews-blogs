<?php
    include("auth_session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Article | Fews Blogs</title>
    <!-- <link href="styles/reset.css" rel="stylesheet" /> -->
    <link href="styles/main.css" rel="stylesheet" />
    <link href="styles/add_edit_article.css" rel="stylesheet" />
    <link href='https://fonts.googleapis.com/css?family=Space+Mono|Muli|Sofia' rel='stylesheet'>
    <!-- Icons kit. -->
    <script src="https://kit.fontawesome.com/743929e53b.js" crossorigin="anonymous"></script>
</head>
<header class="user_panel">
    <?php include("user_panel.php") ?>
</header>
<body>
    <h1>Add Article</h1>
<?php
    require('db_connection.php');
    
    if(isset($_REQUEST['topic'])) {
        $topic    = stripslashes($_REQUEST['topic']);
        $topic      = mysqli_real_escape_string($db_connection, $topic);
        $content    = stripslashes($_REQUEST['content']);
        $content    = mysqli_real_escape_string($db_connection, $content);
        $username   = $_SESSION['username'];
        $create_datetime = date("Y-m-d H:i:s");
        $edit_datetime   = date("Y-m-d H:i:s");
        
        // Checking the Publish checkbox value
        if (isset($_POST['publish'])){
            $publish = "yes";
        } else {
            $publish = "no";
        }
    
        $article_add_query = "INSERT INTO `articles` (topic, content, username, create_datetime, public) 
            VALUES ('$topic', '$content', '$username', '$create_datetime', '$publish')";
        $result = mysqli_query($db_connection, $article_add_query) or die(mysqli_error());
        
        if ($result) {
            print "
                <div class='congrats'>
                    <p class='congrats_title'>Congratulations!</p> 
                    <p class='congrats_text'>You added the article!</p>
                    <p><a href='add_article.php'>Add another article</a></p>
                </div>";
        } else {
            echo "<p>ERROR: Something went wrong. Article wasn't add. :(</p>";
        }
    } else {
?>
        <form action="" method="post">
            <p class='title'>Topic</p>
            <div class='align_textarea>'>
                <textarea name="topic" rows="2" cols="60" required></textarea>
            </div>
            <p class='title'>Content</p>
            <textarea name="content" rows="20" cols="60" required></textarea>
            <div class='add_button'>
                <input type="submit" value="Add" name="add">
                <p class='publish'>Publish? <input type="checkbox" name="publish[]" value="yes"></p>
            </div>
        </form>
<?php 
    } 
?>
</body>
<footer class="footer">
    <?php include("footer.php") ?>
</footer>
</html>
