<?php
    session_start();
    require('db_connection.php');
    // Check does article ID is not empty.
    if(!empty($_GET['id'])) {
        $article_id = $_GET['id'];
        $article_query =  mysqli_query($db_connection, "SELECT * FROM `articles` 
            WHERE (article_id,public)=('$article_id','yes')");
        $article_item  =  mysqli_fetch_array($article_query);
        $count = mysqli_num_rows($article_query);

        // Check does article exists.
        if($count > 0) {
            $username = $article_item['username'];
            $article_user_query = mysqli_query($db_connection, "SELECT * FROM `users` 
                WHERE username='$username'");
            $article_user_item = mysqli_fetch_array($article_user_query);
?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title><?php print $article_item['topic'] ?> | Fews Blogs</title>
                <!-- <link href="styles/reset.css" rel="stylesheet" /> -->
                <link href="styles/main.css" rel="stylesheet" />
                <link href="styles/article.css" rel="stylesheet" />
                <link href='https://fonts.googleapis.com/css?family=Space+Mono|Muli|Sofia' rel='stylesheet'>
                <!-- Icons kit. -->
                <script src="https://kit.fontawesome.com/743929e53b.js" crossorigin="anonymous"></script>
            </head>
            <header class="user_panel">
                <?php include("user_panel.php") ?>
            </header>
            <body>
<?php
                print "
                <h2 class='topic'>".$article_item['topic']."</h2>
                <ul class='article_info'>
                    <li class='right'>
                        <p class='text'>Created by
                            <a href='user_profile.php?id=".$article_user_item['id']."'>".$article_item['username']."</a>
                        </p>
                    </li>";
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
            print "</ul>";
?>
                <p class="article_content"><?php print $article_item['content']?></p>
                <p class="comment">Comments</p>
<?php           
                // Show the "Add Comment" form for logged in users.
                if (isset($_SESSION['username'])) {
?>
                    <form action="" method="post">
                        <textarea 
                            name="comment" 
                            rows="2" 
                            cols="60"
                            placeholder="Start to enter a comment..."
                            required></textarea> </br>
                        <input type="submit" name="add_comment" value="Add">
                    </form>
<?php           }
            // Add comment block.
            if(isset($_REQUEST['comment'])) {
                $comment_username       = $_SESSION['username'];
                $comment_user_query     = mysqli_query($db_connection, "SELECT * FROM `users` 
                    WHERE username='$comment_username'");
                $comment_user_item      = mysqli_fetch_array($comment_user_query);
                $comment                = stripslashes($_REQUEST['comment']);
                $comment                = mysqli_real_escape_string($db_connection, $comment);
                $create_datetime        = date("Y-m-d H:i:s");
                $article_id             = $article_item['article_id'];
                $article_topic          = $article_item['topic'];
                $comment_username_id    = $comment_user_item['id'];
                $comment_username_email = $comment_user_item['email'];
                $comment_create_query = mysqli_query($db_connection, "INSERT 
                    INTO `comments` 
                        (comment, create_datetime,
                         article_id, article_topic,
                         username, username_id, username_email)
                    VALUES 
                        ('$comment', '$create_datetime',
                         '$article_id', '$article_topic', 
                         '$comment_username', '$comment_username_id', '$comment_username_email')") 
                    or die(mysqli_error());

                if ($comment_create_query){
                    print "<p class='comment_info'>The comment added!</p>";
                } else{
                    print "ERROR: The wasn't add.";
                }
            }
            $comment_list_query = mysqli_query($db_connection, "SELECT * FROM `comments` 
                WHERE article_id='$article_id' ORDER BY create_datetime");
            $count_comment_list = mysqli_num_rows($comment_list_query);
            // Show comments if they are exists.
            if ($count_comment_list > 0) {
                $n = 1;
                while ($comment_list_item = mysqli_fetch_array($comment_list_query)){
                    print "
                        <ul class='comment_list'>
                            <li class='left'>
                                <p> #".$n++." "."</p>
                            </li>
                            <li class='left'>
                                <p>            
                                    <a class='comment_user'href='user_profile.php?id=".$comment_list_item['username_id']."'>".$comment_list_item['username']."</a>
                                </p>
                            </li>";
                    // Show edit date and time if the comment edited.
                    if ($comment_list_item['edit_datetime'] != null){
                        print "<li class='left'>
                                    <p>".$comment_list_item['edit_datetime']."</p>
                                </li>";
                    } else {
                        print "<li class='left'>
                                    <p>".$comment_list_item['create_datetime']."</p>
                                </li>";
                    }
                    // Show "Edit" and "Delete" links for the comment owner.
                    if(isset($_SESSION['username'])){
                        if($_SESSION['username'] == $comment_list_item['username']){
                            print "<li class='left'>
                                        <div class='comment_dropdown'>
                                            <button class='comment_dropdown_button'><i class='fa-solid fa-bars'></i></button>
                                                <div class='comment_dropdown_content'>
                                                    <a href='comment_edit.php?id=".$comment_list_item['comment_id']."&article_id=".$comment_list_item['article_id']."'>Edit</a>
                                                    <a href='#' onclick='comment_delete(".$comment_list_item['comment_id'].",".$comment_list_item['article_id'].")'>Delete</a>
                                                </div>
                                        </div>
                                    </li>";
                        }
                    }
                    if ($comment_list_item['edit_datetime'] != null){
                        print "<li class='left'>
                                    <p class='comment_edited'>Edited</p>
                                </li>";
                    } 
                    print "</ul>";
                    print  "<p class='comment_content'>".$comment_list_item['comment']."</p>";
                }
            } else {
                    print "<h3 align='center'>Nobody hasn't left any comment yet. Be the first one!</h3>";
            }
?>
            <script>
            // Function for comments deleting.
                function comment_delete(comment_id,article_id) {
                    var r = confirm("Delete comment?");
                    if (r == true) {
                        window.location.assign("comment_delete.php?id=" + comment_id + "&article_id=" + article_id);
                    }
                }
            </script>
            </body>
            <footer class="footer">
                <?php include("footer.php") ?>
            </footer>
            </html>
<?php   
        } else {
            // Show the "Page not found" error, if an article id isn't exists.
            include("page_not_found.php");
        }
    } else {
        // Show "Page not found" error if an article without id.
        include("page_not_found.php");
    }
?>
