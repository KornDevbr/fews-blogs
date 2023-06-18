<?php
    // Include db_connection.php file ona all user panelpages
    include("auth_session.php");
    require("db_connection.php");

    if (!empty($_GET['id'])) {
        $article_id = $_GET['id'];
        $_SESSION['article_id'] = $article_id; // TODO Delete this varoabe if it changes nothing.
        $username = $_SESSION['username'];

        $query = mysqli_query($db_connection, "SELECT * FROM `articles` 
            WHERE (article_id,username)=('$article_id','$username')");
        $item = mysqli_fetch_array($query);
        $count = mysqli_num_rows($query);

        if($count > 0){
?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Edit Article | Fews Blogs</title>
            </head>
            <body>
                <h1>Editing: <?php print $item['topic']?></h1>
                <p>Back to <a href="dashboard.php">Dashboard</a></p>
                <p><b>Created:</b> <?php print $item['create_datetime']?></p>
                <p><b>Last Edit:</b> <?php print $item['edit_datetime']?></p>
                <p> Published: <?php print $item['public']?> </p>
                <form acion="" method="post">
                    <p>Topic</p>
                    <textarea name="topic" rows="2" cols="60" required><?php print $item['topic']?></textarea>
                    <p>Content</p>
                    <textarea name="content" rows="20" cols="60" required><?php print $item['content']?></textarea></br>
                    Publish? 
                    <input type="checkbox" name="publish[]" value="yes"> 
                    <input type="submit" value="Edit" name="edit"> </br>
                </form>
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

<?php
    if(isset($_REQUEST['topic'])) {
        $topic      = mysqli_real_escape_string($db_connection, $_REQUEST['topic']);
        $content    = mysqli_real_escape_string($db_connection, $_REQUEST['content']);
        $username   = $_SESSION['username'];
        $edit_datetime = date("Y-m-d H:i:s");

        // Checking the Publish checkbox value
        if (isset($_POST['publish'])){
            $publish = "yes";
        } else {
            $publish = "no";
        }

        $query = mysqli_query($db_connection, "UPDATE `articles` 
            SET topic='$topic', content='$content', edit_datetime='$edit_datetime', public='$publish' 
            WHERE article_id='$article_id'") or die(mysqli_error());

        if ($query) {
            print "<p>The article <b>" . $item['topic'] . "</b> was successfully edited!</p>";
            print "<p>Back to <a href='dashboard.php'>Dashboard</a></p>";
        }
    }
?>