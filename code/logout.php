<?php
    session_start();
    // Destroy sesion
    if(session_destroy()) {
        // Redirecting to the Home page.
        header("Location: index.php");
    }
?>