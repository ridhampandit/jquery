<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="jq/jquery.min.js"></script>
    <script src="jq/jquery.validate.min.js"></script>
    <script src="jq/bootstrap.min.js"></script>
    <script src="script.js"></script>
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
      <h2>Add and Delete Table Rows using jQuery</h2> 
      <button class = "btn btn-danger"><a href="table.php">Add New Entery</a></button>
      <br>
      <br>
      <form method="post" id="myform">
      <table id="employee-table">
        <tr>
        <th>Email
          </th>
          <th>Select Product
          </th>
          <th>Quantity
          </th>
          <th>M.R.P($)
          </th>
            <th>Total($)
          </th>
          <th>Image
          </th>
        </tr>
        <tr>
        <td><input type="text" id="email" class="email form-control" name="email[]" value="<?php echo $row['email'];?>"><span class="error-message-email"></span></td>
        <td><select id="myDropdown" class="dropdown form-control" name="dropdown[]" value="<?php echo $row['dropdown'];?>">
        <option value=""><?php echo $row['dropdown'];?></option>
        <option value="Moniter" class="dropdown">Moniter</option>
        <option value="CPU" class="dropdown">CPU</option>
        <option value="Keybord" class="dropdown">Keybord</option>
        <option value="Mouse" class="dropdown">Mouse</option>
        </select>
        <span class="error-message-myDropdown"></span></td> 
        <td><input type="number" id="qty" class="qty form-control" name="qty[]" value="<?php echo $row['qty'];?>"><span class="error-message-qty"></span></td>
        <td><input type="number" value="<?php echo $row['mrp'];?>" id="mrp" class="mrp form-control" name="mrp[]"><span class="error-message-mrp"></span></td>
        <td><input type="number" value="<?php echo $row['total'];?>" class="total form-control" id="total" name="total[]" readonly></td>
        <td><input type="file" class="image form-control" id="image" name="image[]"></td>
        <td><img src="<?php echo "uploads/". $row['image'];?>"  width="200px" alt='image' class="img-thumbnail"></td>
      </tr>
      </table>
      <input type="submit" name="update"value="Update" class="btn btn-primary">   <button class="btn btn-secondary"><a href="display.php">View</a></button>
      </form>
    </div>		
</body>
</html> -->

<?php
require "connection.php"; 
$id=$_GET['id'];

        //for save data
        if(isset($_POST["update"])){
          // Iterate through submitted data
          $email = $_POST['email'];
          $dropdown = $_POST['dropdown'];
          $qty = $_POST['qty'];
          $mrp = $_POST['mrp'];
          $total = $_POST['total'];
          $image = $_FILES['image'];

          if($image!==""){
             $stmt = $conn->prepare("UPDATE product SET email=?, dropdown=?, qty=?, mrp=?, total=?, image=?,WHERE id=?");
             $stmt->bind_param("ssiiisi", $email, $dropdown, $qty, $mrp, $total,$imagename,$id);
             $imagename = basename($image['name']);

              // Move uploaded image to a folder
              move_uploaded_file($image['tmp_name'], "uploads/".$imagename);

              // Execute the statement
              $stmt->execute();
              $stmt->close();
          }else{
            $stmt = $conn->prepare("UPDATE product SET email=?, dropdown=?, qty=?, mrp=?, total=?,WHERE id=?");
             $stmt->bind_param("ssiiii", $email, $dropdown, $qty, $mrp, $total,$id);

              // Execute the statement
              $stmt->execute();
              $stmt->close();
          }
              $conn->close();
              header("Location:display.php");
        }
    ?>