<?php
// Establish a database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'mydatabase2';

$conn = new mysqli($host, $username, $password, $database);
if ($conn->connect_error) {
    die('Connection failed: ' . $conn->connect_error);
}
?>