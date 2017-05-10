<?php
/**
 * DB connection
 */
$dbname = 'booksbyu';
$userName = 'root';
$password = '';
$serverName = 'localhost';

try {
    $conn = new PDO("mysql:host=$serverName;dbname=$dbname",$userName,$password);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    include('database_error.php');
    exit();
}
?>
