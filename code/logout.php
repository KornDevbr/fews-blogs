<?php
    session_start();
    // Destroy session
    if(session_destroy()) {
        // Redirecting to the home page.
        header("Location: /");
    }
