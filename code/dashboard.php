<?php
// Include db_connect.php file on all user panel pages
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
    require('db_connection.php');
    $query = mysqli_query($db_connection, "SELECT * FROM `articles` WHERE username='user'");

    $i = 1;
    while ($item = mysqli_fetch_array($query)) {
        print "<tr>";
            print '<td align="center">' . $i++ . "</td>";
            print '<td> <a href="article_preview.php?id=' . $item['article_id'] . '"</a>' . $item['topic'] . "</td>"; 
            print '<td align="center">' . $item['create_datetime'] . "</td>";
            print '<td align="center">' . $item['edit_datetime'] . "</td>";
            print '<td align="center">' . $item['public'] . "</br>";
            print '<td align="center"> <a href="edit_article.php?article_id=' . $item['article_id'] . '">edit</a> </td>';
            print '<td align="center"> <a href="">delete</a> </td>';
        print "</tr>";
    }
?>
        </tbody>
    </table>
</body>
</html>
