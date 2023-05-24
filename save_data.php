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

// Retrieve the submitted data
$emails = $_POST['emails'];
$myDropdowns = $_POST['myDropdowns'];
$qtys = $_POST['qtys'];
$mrps = $_POST['mrps'];
$totals = $_POST['totals'];


// Insert data into the database
if (!empty($emails) && !empty($myDropdowns) && !empty($qtys) && !empty($mrps) && count($emails) === count($myDropdowns) && count($emails) === count($qtys) && count($emails) === count($mrps)) {
    $rowCount = count($emails);

    $sql = 'INSERT INTO product (email, myDropdown, qty, mrp, total) VALUES (?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($sql);

    for ($i = 0; $i < $rowCount; $i++) {
        $stmt->bind_param('sssdd', $emails[$i], $myDropdowns[$i], $qtys[$i], $mrps[$i], $totals[$i]);
        $stmt->execute();
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>
