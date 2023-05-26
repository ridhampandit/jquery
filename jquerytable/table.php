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
            // Add new row
            $("#addRow").click(function(){
                var markup = "<tr><td><input type='text' name='email[]' class='email form-control'><span class='error-message-email'></span></td><td><select id='dropdown' class='dropdown form-control' name='dropdown[]'><option value=''>--Select Product--</option><option value='Moniter' class='dropdown'>Moniter</option><option value='CPU' class='dropdown'>CPU</option><option value='Keybord' class='dropdown'>Keybord</option><option value='Mouse' class='dropdown'>Mouse</option></select><span class='error-message-dropdown'></span></td> <td><input type='number' class='qty form-control' name='qty[]'><span class='error-message-qty'></span></td><td><input type='number' class='mrp form-control' name='mrp[]'><span class='error-message-mrp'></span></td><td><input type='number' class='total form-control' name='total[]' readonly></td><td><input type='file' class='image form-control' name='image[]'><span class='error-message-image'></span></td><td><i class='deleteRow fas fa-trash-alt' style='color:red'></i></td></tr>";
                $("#myTable tbody").append(markup);
            });

            // Delete row
            $(document).on("click", ".deleteRow", function(){
                $(this).closest("tr").remove();
            });
            $(document).on('change', '.dropdown', function() {
  var selectedValue = $(this).val();
  $('.dropdown').not(this).find('option[value="' + selectedValue + '"]').prop('disabled', true);
});

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
        },
     "dropdown[]":{
            required: true
        },
       "qty[]":{
            required: true
        },
        "mrp[]":{
            required: true
        },
        "image[]":{
        required: true
      }
       },
        messages: {
         "email[]":{
            required: "Please enter email.",
            email:"Please enter valid email."
        },
         "dropdown[]": {
           required: "Please selecte product."
       },
       "qty[]": {
           required: "Please enter quantity."
       },
       "mrp[]":{
            required: "Please enter mrp."
        },
      "image[]":{
        required: "Please upload image."
      }
   },
   errorPlacement: function(error, element) {
     if (element.attr("name") === "email[]") {
           error.appendTo(".error-message-email");
       }
       if (element.attr("name") === "dropdown[]") {
           error.appendTo(".error-message-dropdown");
       }
       if (element.attr("name") === "qty[]") {
           error.appendTo(".error-message-qty");
       }
       if (element.attr("name") === "mrp[]") {
           error.appendTo(".error-message-mrp");
       }
       if (element.attr("name") === "image[]") {
           error.appendTo(".error-message-image");
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
    <form method="POST" id="myform" action="save_data.php" enctype="multipart/form-data">
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
                <th>Action
                </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" class="email form-control" name="email[]">
                    <span class="error-message-email"></span></td> 
                    <td><select id="dropdown" class="dropdown form-control" name="dropdown[]">
                        <option value="">--Select Product--</option>
                        <option value="Moniter" class="dropdown">Moniter</option>
                        <option value="CPU" class="dropdown">CPU</option>
                        <option value="Keybord" class="dropdown">Keybord</option>
                        <option value="Mouse" class="dropdown">Mouse</option>
                    </select>
                    <span class="error-message-dropdown"></span></td>
                    <td><input type="number" class="qty form-control" name="qty[]">
                    <span class="error-message-qty"></span></td>
                    <td><input type="number" class="mrp form-control" name="mrp[]">
                    <span class="error-message-mrp"></span></td> 
                    <td><input type="number" class="total form-control" name="total[]" readonly></td>
                    <td><input type="file" class="image form-control" name="image[]">
                    <span class="error-message-image"></span></td> 
                    <td><i class="deleteRow fas fa-trash-alt" style="color:red"></i></td>
                </tr>
            </tbody>
        </table>
        <button type="button" class = "btn btn-warning" id="addRow">Add Row</button>
        <button type="submit" name="submit" class = "btn btn-success">Submit</button>
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