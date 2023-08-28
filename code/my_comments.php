<?php
    include("auth_session.php");
    require("db_connection.php");

    $username = $_SESSION['username'];
    $comment_query = mysqli_query($db_connection, "SELECT * FROM `comments` 
        WHERE username='$username' ORDER BY create_datetime DESC");
    $user_query = mysqli_query($db_connection, "SELECT * FROM `users` 
        WHERE username='$username'");
    $user_item = mysqli_fetch_array($user_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Comments | Fews Blogs</title>
    <!-- <link href="styles/reset.css" rel="stylesheet" /> -->
    <link href="styles/main.css" rel="stylesheet" />
    <link href="styles/dashboard.css" rel="stylesheet" />
    <link href='https://fonts.googleapis.com/css?family=Space+Mono|Muli|Sofia' rel='stylesheet'>
    <!-- Icons kit. -->
    <script src="https://kit.fontawesome.com/743929e53b.js" crossorigin="anonymous"></script>
</head>
<header class="user_panel">
    <?php include("user_panel.php") ?>
</header>
<body>
    <h1>Your Comments</h1>
<?php
    $count = mysqli_num_rows($comment_query);
    if ($count > 0) {
?>
    <table>
        <tbody>
            <tr>
                <th>#</th>
                <th>Comment</th>
                <th>Article</th>
                <th>Create Time</th>
                <th>Delete</th>
            </tr>
<?php
        $n = 1;
        while ($comment_list = mysqli_fetch_array($comment_query)) {
            print   "<tr>
                        <td align='center'>" . $n++ . "</td>
                        <td align='center'>
                            <a href=article.php?id=". $comment_list['article_id'] . ">" . $comment_list['article_topic'] . "</a>
                        </td>
                        <td align='center'>" . $comment_list['comment'] . "</td>
                        <td align='center'>" . $comment_list['create_datetime'] . "</td>
                        <td align='center'>
                            <a class='table_button' href='#' onclick='comment_delete(".$comment_list['comment_id'].",".$comment_list['article_id'].")'><i class='fa-solid fa-trash'></i></a>
                        </td>
                    </tr>";
        }
    print "
        </tbody>
    </table>
    ";
    } else {
        print "<h3 class='do_not_have_articles'>You didn't leave any comments yet. :(</h3>";
    }
?>
</body>
<footer class="footer">
    <?php include("footer.php") ?>
</footer>
</html>
<script>
// Function for comments deleting.
    function comment_delete(comment_id,article_id) {
        var r = confirm("Delete comment?");
        if (r == true) {
            window.location.assign("comment_delete.php?id=" + comment_id + "&article_id=" + article_id);
        }
    }
</script>
