<?php include"connection.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="jq/a076d05399.js"></script>
    <script src="jq/bootstrap.min.js"></script>
    <title>Add Delete Tr With jquery</title>
    <style>#container{
      margin:0 auto;
      width:800px;
      text-align:center}
      #employee-table{
        width:800px;
        border:1px solid #aaa}
    </style>
</head>
<body>
<div id="container">
      <h2>All Data</h2> 
     <a href="table.php" class = "btn btn-warning">Add New Entery</a>
      <br>
      <br>
      <table id="employee-table" class="table table-bordered">
        <tr>
        <th>#
          </th>
        <th>Email
          </th>
          <th>Product Name
          </th>
          <th>Quantity
          </th>
          <th>M.R.P($)
          </th>
            <th>Total($)
          </th>
          <th>Image
          </th>
          <th>Action
          </th>
        </tr>
        <?php
     $query="SELECT * FROM `product`";
     $data = mysqli_query($conn,$query);
     $result=mysqli_num_rows($data);
if($result){
    while($row=mysqli_fetch_assoc($data)){
        ?>
      <tbody>
      <tr>
            <td><?php echo $row['id'];?></td>
            <td><?php echo $row['email'];?></td>
            <td><?php echo $row['dropdown'];?></td>
            <td><?php echo $row['qty'];?></td>
            <td><?php echo $row['mrp'];?></td>
            <td><?php echo $row['total'];?></td>
            <td><img src="<?php echo "uploads/". $row['image'];?>"  width="200px" alt='image' class="img-thumbnail"></td>
            <td><a href="updateform.php?id=<?php echo $row['id'];?>"><i class="fas fa-edit"></i></a> <a href="delete.php?id=<?php echo $row['id'];?>" onclick="return confirm('Are you shure want to delete?')"><i class="fas fa-trash-alt" style="color:red"></i></a></td>
            </tr>
        <?php
    }
} else{
    ?>
    <tr>
        <td>No Record Found</td>
    </tr>
    <?php
}
?>
      </table>
      <!-- <input type="submit" value="submit" id="btnSubmit"> -->
    </div>
</body>
</html>