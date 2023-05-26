<?php
if(isset($_POST['submit'])){
    // Database connection
    $conn = new mysqli("localhost", "root", "", "mydatabase2");

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind statement
    $stmt = $conn->prepare("INSERT INTO product(email,dropdown,qty,mrp,total,image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiiis", $email, $dropdown, $qty, $mrp, $total,$image);

    // Iterate through submitted data
    $emailArr = $_POST['email'];
    $dropdownArr = $_POST['dropdown'];
    $qtyArr = $_POST['qty'];
    $mrpArr = $_POST['mrp'];
    $totalArr = $_POST['total'];
    $imageArr = $_FILES['image'];

    for($i = 0; $i < count($emailArr); $i++){
        $email = $emailArr[$i];
        $dropdown = $dropdownArr[$i];
        $qty = $qtyArr[$i];
        $mrp = $mrpArr[$i];
        $total = $totalArr[$i];
        $image = basename($imageArr['name'][$i]);

        // Move uploaded image to a folder
        move_uploaded_file($imageArr['tmp_name'][$i], "uploads/".$image);

        // Execute the statement
        $stmt->execute();
    }
    // Close statement and connection
    $stmt->close();
    $conn->close();
    header("Location:display.php");
    // echo "Data inserted successfully.";
}
?>
