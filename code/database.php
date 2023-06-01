<?php
    // Database connection.
    $connection = mysqli_connect("mariadb", "fews-blogs", "fews-blogs", "fews-blogs");
    // Check connection.
    if (mysqli_connect_errno()){
        echo "Failed to connect tot MySQL: " . mysqli_connect_error();
    }
?>
