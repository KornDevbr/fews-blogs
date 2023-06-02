<?php
    // Database connection.
    $db_connection = mysqli_connect("mariadb", "fews-blogs", "fews-blogs", "fews-blogs");
    // Check connection.
    if (mysqli_connect_errno()){
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
?>
