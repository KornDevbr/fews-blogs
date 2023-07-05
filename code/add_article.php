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
</head>
<body>
    <h1>Add Article</h1>
<?php
    require('db_connection.php');
    
    if(isset($_REQUEST['topic'])) {
        $topic      = mysqli_real_escape_string($db_connection, $_REQUEST['topic']);
        $content    = mysqli_real_escape_string($db_connection, $_REQUEST['content']);
        $username   = $_SESSION['username'];
        $create_datetime = date("Y-m-d H:i:s");
        $edit_datetime   = date("Y-m-d H:i:s");
        
        // Checking the Publish checkbox value
        if (isset($_POST['publish'])){
            $publish = "yes";
        } else {
            $publish = "no";
        }
    
        $query = "INSERT INTO `articles` (topic, content, username, create_datetime, public) 
            VALUES ('$topic', '$content', '$username', '$create_datetime', '$publish')";
        $result = mysqli_query($db_connection, $query) or die(mysqli_error());
        
        if ($result) {
            print "
                <h2>Congratulations!</h2> 
                <h3>You added the article!</h3>
                <p><a href='dashboard.php'>My Articles</a></p></br>
                <p><a href='add_article.php'>Add another</a> article</p>";
        } else {
            echo "Something went wrong. Article wasn't add. :(";
        }
    } else {
?>
        <form action="" method="post">
            <p>Topic</p>
            <textarea name="topic" rows="2" cols="60" required></textarea> </br>
            <p>Content</p>
            <textarea name="content" rows="20" cols="60" required></textarea> </br>
            Publish? <input type="checkbox" name="publish[]" value="yes"> 
            <input type="submit" value="Add" name="add"> </br>
            </br> <p>Back to <a href="dashboard.php">Dashboard</a></p> </br>
        </form>
<?php 
    } 
?>
</body>
</html>
