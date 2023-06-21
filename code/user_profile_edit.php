<?php
    session_start();
    include("auth_session.php");
    require("db_connection.php");

    if (isset($_SESSION['username'])){
        $username = $_SESSION['username'];
        $user_query = mysqli_query($db_connection, "SELECT * FROM `users` WHERE username='$username'");
        $user_item = mysqli_fetch_array($user_query);
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>User Profile Edit | Fews News</title>
    </head>
    <body>
        <h1>User Profile Edit</h1>
        
    </body>
    </html>
<?php
    }