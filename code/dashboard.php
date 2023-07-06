<?php
    include("auth_session.php");
    include("user_panel.php");
    require('db_connection.php');
    
    $username = $_SESSION['username'];
    $article_query = mysqli_query($db_connection, "SELECT * FROM `articles` 
        WHERE username='$username' ORDER BY create_datetime DESC");
    $user_query = mysqli_query($db_connection, "SELECT * FROM `users` 
        WHERE username='$username'");
    $user_item = mysqli_fetch_array($user_query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard | Fews Blogs</title>
</head>
<body>
    <h1 align="center">Hey, <?php echo $_SESSION['username']; ?>!</h1>
    <h2 align="center">What will you share with us today?</h2>
    <p align="right"><a href="user_profile.php?id=<?php print $user_item['id'] ?>">User profile</a></p>
    <p><a href="my_comments.php">My Comments</a></p>
    <p>Back to <a href="index.php">Homepage</a><p>
    <p align="right"><a href="add_article.php">Add Article</a></p>
<?php
    $count = mysqli_num_rows($article_query);
    // Show user's articles if their quantity is bigger than zero.
    if ($count > 0) {
?>
    <table border="1px" width="100%">
        <thead>
            <tr>
                <th colspan="7">Your Articles</th>
            </tr>
        </thead>
        <tbody>  
            <tr>
                <th>#</th>
                <th>Topic</th>
                <th>Create Time</th>
                <th>Edit Time</th>
                <th>Published</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
<?php
        $i = 1;
        while ($article_item = mysqli_fetch_array($article_query)) {
            print "
                <tr>
                    <td align='center'>".$i++."</td>
            ";  
                // Show article preview depends on it's "publish" status.
                if ($article_item['public'] == "no"){
                    print "
                        <td>
                            <a href='article_preview.php?id=".$article_item['article_id']."'>".$article_item['topic']."</a>
                        </td>
                    "; 
                } else {
                    print "
                        <td>
                            <a href='article.php?id=".$article_item['article_id']."'>".$article_item['topic']."</a>
                        </td>
                    "; 
                }
                print "<td align='center'>".$article_item['create_datetime']."</td>";
                print "<td align='center'>";
                    // Print edit date and time if an article was edited.
                    if ($article_item['edit_datetime'] != null){
                        print $article_item['edit_datetime'];
                    } else {
                        print "Not edited";
                    }
                print "</td>";
                print '<td align="center">'.$article_item['public']."</td>";
                print "
                    <td align='center'>
                        <a href='edit_article.php?id=".$article_item['article_id']."'>Edit</a>
                    </td>
                ";
                print "
                    <td align='center'>
                        <a href='#' onclick='delete_article(".$article_item['article_id'].")'>Delete</a>
                    </td>";
            print "</tr>";
        }
    } else {
        print "<h3 align='center'>You didn't make any articles yet. :(</h3>";
    }
?>
        </tbody>
    </table>
    <script>
            // Function for articles deleting.
            function delete_article(article_id) {
                var r = confirm("Are you sure you want to delete this article?");
                if (r == true) {
                    window.location.assign("article_delete.php?id=" + article_id);
                }
            }
    </script>
</body>
</html>
