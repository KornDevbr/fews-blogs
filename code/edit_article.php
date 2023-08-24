<?php
    include("auth_session.php");
    require("db_connection.php");

    // Check does article id is not empty.
    if (!empty($_GET['id'])) {
        $article_id = $_GET['id'];
        $username = $_SESSION['username'];

        $article_query = mysqli_query($db_connection, "SELECT * FROM `articles` 
            WHERE (article_id,username)=('$article_id','$username')");
        $article_item = mysqli_fetch_array($article_query);
        $count = mysqli_num_rows($article_query);

        // Check does article exists.
        if($count > 0){
?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Edit Article | Fews Blogs</title>
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
                <h1>Edit Article: "<?php print $article_item['topic']?>"</h1>
                <div class='info_panel'>
                    <div class='article_info'>
<?php
                        if ($article_item['edit_datetime'] != null){
                            print "<p><b>Updated:</b> ".$article_item['edit_datetime']."</p>";
                        } else {
                            print "<p><b>Created:</b> ".$article_item['create_datetime']."</p>";
                        }
?>
                        <p><b>Published:</b> <?php print $article_item['public']?> </p>
                    </div>
                </div>
                <form action="" method="post">
                    <p class='title'>Topic</p>
                    <textarea name="topic" rows="2" cols="60" required><?php print $article_item['topic']?></textarea>
                    <p class='title'>Content</p>
                    <textarea name="content" rows="20" cols="60" required><?php print $article_item['content']?></textarea>
                    <div class='add_button'>
                        <input type="submit" value="Edit" name="edit">
                        <p class='publish'>Publish?<input type="checkbox" name="publish[]" value="yes"></p>
                </form>
<?php 
                } else {
                    // Show the "Page not found" error, if article id isn't exists.
                    include("page_not_found.php");
                }
            } else {
                // Show "Page not found" error if article without id.
                include("page_not_found.php");
            }

            // Updated the `article` table if there is a 'topic' request. 
            if(isset($_REQUEST['topic'])) {
                $topic      = mysqli_real_escape_string($db_connection, $_REQUEST['topic']);
                $content    = mysqli_real_escape_string($db_connection, $_REQUEST['content']);
                $edit_datetime = date("Y-m-d H:i:s");

                // Checking the Publish checkbox value.
                if (isset($_POST['publish'])){
                    $publish = "yes";
                } else {
                    $publish = "no";
                }

                $article_update_query = mysqli_query($db_connection, "UPDATE `articles` 
                    SET topic='$topic', content='$content', edit_datetime='$edit_datetime', public='$publish' 
                    WHERE article_id='$article_id'") or die(mysqli_error());

                if ($article_update_query) {
                    print "<p class='publish'>The article <b>" . $article_item['topic'] . "</b> was successfully edited!</p>";
                } else {
                    print "<p class='publish'>ERROR: The article <b>" . $article_item['topic'] . "</b> wasn't edited.</p>";
                }
            }
            print "</div>";
        ?>
            </body>
            <footer class="footer">
                <?php include("footer.php") ?>
            </footer>
            </html>
