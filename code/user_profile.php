<?php
    session_start();
    include("user_panel.php");
    require("db_connection.php");

    if(!empty($_GET['id'])) {
        $user_id = $_GET['id'];
        $user_query = mysqli_query($db_connection, "SELECT * FROM `users` WHERE id='$user_id'");
        $user_item  = mysqli_fetch_array($user_query);
        $count = mysqli_num_rows($user_query);

        if($count > 0) {
            $username   = $user_item['username'];
            $article_query = mysqli_query($db_connection, "SELECT * FROM `articles` WHERE (username,public)=('$username','yes') ORDER BY create_datetime DESC");
?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title><?php print $username ?> | Fews Blogs</title>
            </head>
            <body>
<?php           print "<h1>" . $username . "'s profile page</h1>";
                if(isset($_SESSION['username'])){
                    if($_SESSION['username'] == $username){
                        print "<a href='user_profile_edit.php'>Edit user profile</a>";
                    }
                }

?>              <p><b>Registration date:</b> <?php print $user_item['create_datetime'] ?></p>
                <p><b>Sex:</b> <?php print $user_item['gender'] ?></p>
                <p><b>Email:</b> <a href="mailto:<?php print $user_item['email'] ?>"><?php print $user_item['email'] ?></a></br>
                <p><b>Bio:</b></br>               
<?php           print $user_item['bio'];
                print "<p>Back to <a href='index.php'>Homepage</a></p>";

                function articles_list(){
                    global $user_item, $article_query;
                    print "<h2 align='center'>" . $user_item['username'] . "'s articles</h2>";
                    $count = mysqli_num_rows($article_query);
                    if ($count > 0) {
                        while ($article_item = mysqli_fetch_array($article_query)) {
                            print "<h3><a href='article.php?id=" . $article_item['article_id'] . "'>" . $article_item['topic'] . "</a></h3>";
                            print "<p><b>Created:</b> " . $article_item['create_datetime'] . "</p>";
                        }
                    } else {
                        print "<h3 align='center'>This user didn't make any articles yet. :(</h3>";
                    }
                }
                if(isset($_SESSION['username'])){
                    if($_SESSION['username'] == $username){
                        print "<a href='dashboard.php'>My Articles</a></br>";
                        print "<a href='my_comments.php'>My Comments</a>";
                    } else {
                        articles_list();
                    }
                } else {
                    articles_list();
                }
?>          </body>
            </html>
<?php   } else {
            include("page_not_found.php");
        }
    } else {
        include("page_not_found.php");
    }
?>
