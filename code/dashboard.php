<?php
// Check user session.
include("auth_session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dasboard | Fews Blogs</title>
</head>
<body>
    <h1 align="center">Hey, <?php echo $_SESSION['username']; ?>!</h1>
    <h2 align="center">What will you share with us today?</h2>
    <p align="right"><a href="logout.php">Logout</a></p> 
    <p align="right"><a href="add_article.php">Add Article</a></p>
    <p>Back to <a href="index.php">homepage</a><p>
<?php
    require('db_connection.php');
    $username = $_SESSION['username'];
    $query = mysqli_query($db_connection, "SELECT * FROM `articles` WHERE username='$username'");
    $count = mysqli_num_rows($query);

    if ($count > 0) {
?>
    <table border="1px" width="100%">
        <thead>
            <tr>
                <th colspan="7"> Your Articles </th>
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
                <th>Delte</th>
            </tr>
<?php
        $i = 1;
        while ($item = mysqli_fetch_array($query)) {
            print "<tr>";
                print '<td align="center">' . $i++ . "</td>";
                print '<td> <a href="article_preview.php?id=' . $item['article_id'] . '"</a>' . $item['topic'] . "</td>"; 
                print '<td align="center">' . $item['create_datetime'] . "</td>";
                print '<td align="center">' . $item['edit_datetime'] . "</td>";
                print '<td align="center">' . $item['public'] . "</br>";
                print '<td align="center"> <a href="edit_article.php?id=' . $item['article_id'] . '">edit</a> </td>';
                print '<td align="center"> <a href="#" onclick="delete_article('.$item['article_id'].')">delete</a> </td>';
            print "</tr>";
        }
    } else {
        print "<h3 align='center'>You didn't make any articles yet. :(";
    }
?>
        </tbody>
    </table>
    <script>
            function delete_article(article_id) {
                var r = confirm("Are you sure you want to delete this article?");
                if (r == true) {
                    window.location.assign("article_delete.php?id=" + article_id);
                }
            }
    </script>
</body>
</html>
