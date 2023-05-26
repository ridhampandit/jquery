<?php include 'connection.php';
$id=$_GET['id'];
$select="SELECT * FROM `product` WHERE `id`='$id'";
$data=mysqli_query($conn,$select);
if($row=mysqli_fetch_assoc($data)){
    $del = $row['image'];
}
unlink("uploads/".$del);
$delete="DELETE FROM `product` WHERE `id`='$id'";
$datas=mysqli_query($conn,$delete);
// $row=mysqli_fetch_array($data);
    header("Location: display.php");
?>