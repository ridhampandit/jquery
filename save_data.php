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

$files=$_FILES["file"]["name"];
            $tmp_name=$_FILES["file"]["tmp_name"];
            $path="upload/".$files;
            move_uploaded_file($tmp_name,$path);

// Insert data into the database
if (!empty($emails) && !empty($myDropdowns) && !empty($qtys) && !empty($mrps) && !empty($files) && count($emails) === count($myDropdowns) && count($emails) === count($qtys) && count($emails) === count($mrps) && count($emails) === count($files)) {
    $rowCount = count($emails);

    $sql = 'INSERT INTO product (email, myDropdown, qty, mrp, files, total) VALUES (?, ?, ?, ?, ?, ?)';
    $stmt = $conn->prepare($sql);

    for ($i = 0; $i < $rowCount; $i++) {
        $stmt->bind_param('ssssdd', $emails[$i], $myDropdowns[$i], $qtys[$i], $mrps[$i], $files[$i],$totals[$i]);
        $stmt->execute();
    }

    $stmt->close();
}

// Close the database connection
$conn->close();
?>
