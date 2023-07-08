<?php
    include("auth_session.php");
    include("user_panel.php");
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
</head>
<body>
    <h2>Your Comments</h2>
    <p align="right">
        <a href="user_profile.php?id=<?php print $user_item['id'] ?>">User profile</a>
    </p>
    <p>
        <a href="dashboard.php">My Articles</a>
        </br>
        Back to <a href="index.php">Homepage</a>
    </p>
<?php
    $count = mysqli_num_rows($comment_query);
    if ($count > 0) {
?>
    <table border="1px" width="100%">
        <thead>
            <tr>
                <th colspan="4">Your Comments</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th>#</th>
                <th>Comment</th>
                <th>Article</th>
                <th>Create Time</th>
            </tr>
<?php
        $n = 1;
        while ($comment_list = mysqli_fetch_array($comment_query)) {
            print   "<tr>
                        <td align='center'>" . $n++ . "</td>
                        <td align='center'>" . $comment_list['comment'] . "</td>
                        <td align='center'>
                            <a href=article.php?id=". $comment_list['article_id'] . ">" . $comment_list['article_topic'] . "</a>
                        </td>
                        <td align='center'>" . $comment_list['create_datetime'] . "</td>
                    </tr>";
        }
    print "
        </tbody>
    </table>
    ";
    } else {
        print "<h3 align='center'>You didn't leave any comments yet. :(</h3>";
    }
?>
</body>
</html>
