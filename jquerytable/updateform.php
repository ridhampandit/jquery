<?php include 'connection.php';
$id=$_GET['id'];
$select="SELECT * FROM `product` WHERE `id`='$id'";
$data=mysqli_query($conn,$select);
$row=mysqli_fetch_array($data);
$image_name="";
//for save data
if(isset($_POST["update"])){
    // Iterate through submitted data
    $email = $_POST['email'];
    $dropdown = $_POST['dropdown'];
    $xyz1=implode($dropdown);
    $qty = $_POST['qty'];
    $mrp = $_POST['mrp'];
    $total = $_POST['total'];
    $imageArr = $_FILES['image'];
    $image_name = basename($imageArr['name']);

    if($imageArr !== ""){
        $select="SELECT * FROM `product` WHERE `id`='$id'";
        $data=mysqli_query($conn,$select);
        if($row=mysqli_fetch_assoc($data)){
            $del = $row['image'];
        }
        unlink("uploads/".$del);
        move_uploaded_file($imageArr['tmp_name'], "uploads/".$image_name);
       $query = "UPDATE `product` SET `email`='$email', `dropdown`='$xyz1', `qty`='$qty', `mrp`='$mrp', `total`='$total', `image`='$image_name' WHERE `id`='$id'";
       
       // Move uploaded image to a folder
       $data = mysqli_query($conn,$query);
    }
    else{
        $query = "UPDATE `product` SET `email`='$email', `dropdown`='$xyz1', `qty`='$qty', `mrp`='$mrp', `total`='$total' WHERE `id`='$id'";
        $data = mysqli_query($conn,$query);
    }
        $conn->close();
        header("Location:display.php");
  }
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add/Delete Table Rows</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="css/bootstrap.min.css" rel="stylesheet"> 
    <script src="jq/jquery.min.js"></script>
    <script src="jq/jquery.validate.min.js"></script>
    <script src="jq/bootstrap.min.js"></script>
    <script src="jq/a076d05399.js"></script>
    <script>
        $(document).ready(function(){
            function calculateTotal() {
            var totalQuantity = 0;
            var totalPrice = 0;

        $('#myTable tr').each(function() {
            var quantity = parseInt($(this).find('.qty').val()) || 0;
            var price = parseFloat($(this).find('.mrp').val()) || 0;
            var total = quantity * price;

            $(this).find('.total').val(total.toFixed(2));

            totalQuantity += quantity;
            totalPrice += total;
    });

        $('#totalQuantity').text(totalQuantity);
        $('#totalPrice').text(totalPrice.toFixed(2));
  }
    $('#myTable').on('input', '.mrp, .qty', function() {
        calculateTotal();
  });
  $("#myform").validate({
    rules:{
     "email[]":{
            required: true,
            email:true 
        }
       },
        messages: {
         "email[]":{
            required: "Please enter email.",
            email:"Please enter valid email."
        }
   },
   errorPlacement: function(error, element) {
     if (element.attr("name") === "email[]") {
           error.appendTo(".error-message-email");
       }
 }
});
});
    </script>
    <style>#container{
      margin:0 auto;
      width:800px;
      text-align:center}
      #myTable{
        width:800px;
        border:1px solid #aaa}
    </style>
</head>
<body>
<div id="container">
<h2>Add and Delete Table Rows using jQuery</h2> 
    <form method="POST" id="myform" action="" enctype="multipart/form-data">
        <table id="myTable">
            <thead>
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
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" class="email form-control" value="<?php echo $row['email'];?>" name="email">
                    <span class="error-message-email"></span></td> 
                    <td><select id="dropdown" class="dropdown form-control" name="dropdown[]">
                        <option value=""><?php echo $row['dropdown'];?></option>
                        <option value="Moniter" class="dropdown">Moniter</option>
                        <option value="CPU" class="dropdown">CPU</option>
                        <option value="Keybord" class="dropdown">Keybord</option>
                        <option value="Mouse" class="dropdown">Mouse</option>
                    </select></td>
                    <td><input type="number" class="qty form-control" value="<?php echo $row['qty'];?>" name="qty"></td>
                    <td><input type="number" class="mrp form-control" value="<?php echo $row['mrp'];?>" name="mrp"></td> 
                    <td><input type="number" class="total form-control" value="<?php echo $row['total'];?>" name="total" readonly></td>
                    <td><input type="file" class="image form-control" name="image"></td> 
                    <td><img src="<?php echo "uploads/". $row['image'];?>"  width="200px" alt='image' class="img-thumbnail"></td>
                </tr>
            </tbody>
        </table>
        <button type="submit" name="update" class = "btn btn-success">Update</button>
        <a href="display.php" class = "btn btn-secondary">View</a>    
    </form>
</div>
</body>
</html>


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
    <script src="script.js"></script> -->
    <!-- <script src="jq/a076d05399.js"></script>
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
      <button id="add-new-btn" class="btn btn-danger">Add New Row</button>
      <br>
      <br>
      <form method="post" id="myform" enctype="multipart/form-data">
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
          <th>Action
          </th>
        </tr>
        <tr>
        <td><input type="text" id="email" class="email form-control" name="email[]"><span class="error-message-email"></span></td>
        <td><select id="myDropdown" class="dropdown form-control" name="myDropdown[]">
        <option value="">--Select Product--</option>
        <option value="Moniter" class="dropdown">Moniter</option>
        <option value="CPU" class="dropdown">CPU</option>
        <option value="Keybord" class="dropdown">Keybord</option>
        <option value="Mouse" class="dropdown">Mouse</option>
        </select>
        <span class="error-message-myDropdown"></span></td> 
        <td><input type="number" id="qty" class="qty form-control" name="qty[]"><span class="error-message-qty"></span></td>
        <td><input type="number" id="mrp" class="mrp form-control" name="mrp[]"><span class="error-message-mrp"></span></td>
        <td><input type="number" class="total form-control" id="total" name="total[]" readonly></td>
        <td><input type="file" class="file form-control" id="file" name="file[]"/></td>
        <td><i class="btnDelete fas fa-trash-alt" style="color:red"></i></td>
      </tr>
      </table>
      <input type="submit" value="submit" id="btnSubmit" class = "btn btn-primary">
      </form>
      <a href="display.php" class = "btn btn-secondary">View</a>
    </div>		
</body>
</html> -->