<?php
    // Variable to pass article ID from URI.
    $article_id = $url[1];

    include('auth_session.php');
    require('db_connection.php');

    // Check does article id is not empty.
    if(!empty($article_id)) {
        $username = $_SESSION['username'];
        $article_query = mysqli_query($db_connection, "SELECT * FROM `articles` 
            WHERE (article_id,username)=('$article_id','$username')");
        $article_item = mysqli_fetch_array($article_query);
        $count = mysqli_num_rows($article_query);

        // Check does article exists.
        if($count > 0) {
            $user_query = mysqli_query($db_connection, "SELECT * FROM `users` 
                WHERE username='$username'");
            $user_item = mysqli_fetch_array($user_query);
?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title><?php print $article_item['topic']?> | Fews Blogs</title>
                <!-- <link href="styles/reset.css" rel="stylesheet" /> -->
                <link href="/styles/main.css" rel="stylesheet" />
                <link href="/styles/article_preview.css" rel="stylesheet" />
                <link href='https://fonts.googleapis.com/css?family=Space+Mono|Muli|Sofia' rel='stylesheet'>
                <!-- Icons kit. -->
                <script src="https://kit.fontawesome.com/743929e53b.js" crossorigin="anonymous"></script>
            </head>
            <header class="user_panel">
                <?php include("user_panel.php") ?>
            </header>
            <body>
                <div class='title'>
                    <p class='preview'>Preview Page</p>
                    <p class='edit'><a href="/article/<?php print $article_item['article_id'] ?>/edit">Edit Article</a></p>
                </div>
<?php               
                    print "<h2 class='article_topic'>".$article_item['topic']."</h2>";
                    print "<div class='article_info'>";
                        // Show edited time if edit_datetime is not null.
                        if ($article_item['edit_datetime'] != null){
                            print "<p><b>Updated:</b> ".$article_item['edit_datetime']."</p>";
                        } else {
                            print "<p><b>Created:</b> ".$article_item['create_datetime']."</p>";
                        }
                    print "
                        <p><b>Published:</b>".$article_item['public']."</p>
                        <p class='text'>Created by: <a class='link' href='/user/".$user_item['id']."'>".$article_item['username']."</a></p>
                    ";
                print "</div>";
                print "
                    <p class='article_content'>".$article_item['content']."</p>
                ";
                
                print "<p class='comment'>Comments</p>";

                $comment_list_query = mysqli_query($db_connection, "SELECT * FROM `comments` 
                    WHERE article_id='$article_id'");
                $count_comment_list = mysqli_num_rows($comment_list_query);
                // Show comments if comments quantity bigger than zero.
// Show comments if they are exists.
            if ($count_comment_list > 0) {
                $n = 1;
                while ($comment_list_item = mysqli_fetch_array($comment_list_query)){
                    print "
                        <ul class='comment_list'>
                            <li>
                                <p> #".$n++." "."</p>
                            </li>
                            <li>
                                <p>            
                                    <a class='comment_user'href='user_profile.php?id=".$comment_list_item['username_id']."'>".$comment_list_item['username']."</a>
                                </p>
                            </li>";
                    // Show edit date and time if the comment edited.
                    if ($comment_list_item['edit_datetime'] != null){
                        print "<li>
                                    <p>".$comment_list_item['edit_datetime']."</p>
                                </li>";
                    } else {
                        print "<li>
                                    <p>".$comment_list_item['create_datetime']."</p>
                                </li>";
                    }
                    if ($comment_list_item['edit_datetime'] != null){
                        print "<li>
                                    <p class='comment_edited'>Edited</p>
                                </li>";
                    } 
                    print "</ul>";
                    print  "<p class='comment_content'>".$comment_list_item['comment']."</p>";
                }
            }
?>
            <br class='nothing'>
            </body>
            <footer class="footer">
                <?php include("footer.php") ?>
            </footer>
            </html>
<?php
        // Show "Page not found" if article id isn't exists.
        } else {
            include("page_not_found.php");
        }
    // Show "Page not found" error if article without id.
    } else {
        include("page_not_found.php");
    }
?>
