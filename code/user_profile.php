<?php
    $user_id = $url[1];
    session_start();
    require("db_connection.php");
    // Check does user id is not empty.
    if(!empty($user_id)) {
        $user_query = mysqli_query($db_connection, "SELECT * FROM `users` 
            WHERE id='$user_id'");
        $user_item  = mysqli_fetch_array($user_query);
        $count = mysqli_num_rows($user_query);
        // Check does user exists.
        if($count > 0) {
            $username   = $user_item['username'];
            $article_query = mysqli_query($db_connection, "SELECT * FROM `articles` 
                WHERE (username,public)=('$username','yes') ORDER BY create_datetime DESC");
?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title><?php print $username ?> | Fews Blogs</title>
                <link href="/styles/main.css" rel="stylesheet" />
                <link href="/styles/user_profile.css" rel="stylesheet" />
                <link href='https://fonts.googleapis.com/css?family=Space+Mono|Muli|Sofia' rel='stylesheet'>
                <!-- Icons kit. -->
                <script src="https://kit.fontawesome.com/743929e53b.js" crossorigin="anonymous"></script>
            </head>
            <header class="user_panel">
                <?php include("user_panel.php") ?>
            </header>
            <body>
<?php           print "<h1>".$username."'s profile page</h1>";
                // Check does user logged in.
                if(isset($_SESSION['username'])){
                    // Check does logged and watching the page usernames are the same.
                    if($_SESSION['username'] == $username){
                        print "<p class='edit'><a href='user_profile_edit.php'>Edit profile page</a></p>";
                    }
                }
?>              <div class="user_info">
                    <p class="first_item">Registration date:</p>
                    <p class="second_item"> <?php print $user_item['create_datetime'] ?> </p>
                </div>
                <div class="user_info">
                    <p class="first_item">Sex:</p>
                    <p class="second_item"><?php print $user_item['gender'] ?></p>
                </div>
                <div class="user_info">
                    <p class="first_item">Email:</p>
                    <p class="second_item"><a href="mailto:<?php print $user_item['email'] ?>"><?php print $user_item['email'] ?></a></p>
                </div>
                <div class="user_info">
                    <p class="first_item">Bio:</p>
<?php               print "<p class='second_item'>".$user_item['bio']."</p>";
                    print "</div>";
                // Function for showing printed articles not for page owner.
                function articles_list(){
                    global $user_item, $article_query;
                    print "<h2>".$user_item['username']."'s published articles</h2>";
                    $count = mysqli_num_rows($article_query);
                    // Show articles if their quantity is more than zero.
                    if ($count > 0) {
                        while ($article_item = mysqli_fetch_array($article_query)) {
                            print "<div class='article_list'>";
                                print "<p><a href='article.php?id=" . $article_item['article_id'] . "'>" . $article_item['topic'] . "</a></p>";
                                if ($article_item['edit_datetime'] != null) {
                                    print "<p class='article_date'><b>Updated:</b> " . $article_item['edit_datetime'] . "</p>";
                                } else {
                                    print "<p class='article_date'><b>Created:</b> " . $article_item['create_datetime'] . "</p>";
                                }
                            print "</div>";
                        }
                    // Show message if user didn't make any article.
                    } else {
                        print "<h3>This user didn't make any articles yet. :(</h3>";
                    }
                }
                // Check does user logged in.
                articles_list();
?>          </body>
            <footer class="footer">
                <?php include("footer.php") ?>
            </footer>
            </html>
<?php   } else {
            // Show the "Page not found" error, if a user id isn't exists.
            include("page_not_found.php");
        }
    } else {
        // Show "Page not found" error if an article without id.
        include("page_not_found.php");
    }
?>
