<?php
     session_start();
    // remove all session variables
    session_unset();
    unset($_SESSION["loggedIn"]);

    // destroy the session
    session_destroy();

    header('location: ../index.php');
?>