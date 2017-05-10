<?php
session_start();

/**
 * Simple Logout handler
 */
session_destroy();

header('location:index.html');
?>

