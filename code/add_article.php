<?php
    include("auth_session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add | Fews Blogs</title>
</head>
<body>
    <h1>Add an article</h1>
<?php
    require('db_connection.php');
    if(isset($_REQUEST['topic'])) {
        $topic      = mysqli_real_escape_string($db_connection, $_REQUEST['topic']);
        $content    = mysqli_real_escape_string($db_connection, $_REQUEST['content']);
        $username   = $_SESSION['username'];
        $create_datetime = date("Y-m-d H:i:s");
        $edit_datetime   = date("Y-m-d H:i:s");
        // Checking the checkbox value
        if (isset($_POST['publish'])){
            $publish = "yes";
        } else {
            $publish = "no";
        }
    $query = "INSERT INTO `articles` (topic, content, username, create_datetime, edit_datetime, public) 
              VALUES ('$topic', '$content', '$username', '$create_datetime', '$edit_datetime', '$publish')";
    $result = mysqli_query($db_connection, $query) or die(mysqli_error());
    if ($result) {
        echo "Congratulations! You added the article!</br>";
        echo "Go back to <a href='dashboard.php'>Dashboard</a></br>";
        echo "<a href='add_article.php'>Add another one</a>";
    } else {
        echo "Something went wrong. Article wasn't add. :(";
    }
    } else {
?>
    <form action="" method="post">
        <p>Article topic:</p>
        <input type="text" name="topic" placeholder="Enter the topic of an article..." required>
        <p> Content of an article </p>
        <textarea name="content" rows="20" cols="60" required></textarea> </br>
        Publish? <input type="checkbox" name="publish[]" value="yes"> 
        <input type="submit" value="Add article" name="add"> </br>
        </br> <a href="dashboard.php">Go back to Dashboard</a> </br>
    </form>
<?php 
    } 
?>
</body>
</html>
