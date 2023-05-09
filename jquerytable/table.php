<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/bootstrap.min.css">
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
      <button id="add-new-btn" >Add New Row
      </button>
      <br>
      <br>
      <table id="employee-table">
        <tr>
          <th>Select Product
          </th>
          <th>Quentity
          </th>
          <th>M.R.P($)
          </th>
            <th>Total($)
          </th>
          <th>Action
          </th>
        </tr>
      </table>
      <input type="submit" value="submit" id="submit">
    </div>		
</body>
<script src="jq/jquery-3.6.4.min.js"></script>
<script>

   $(document).ready(function() {
  // Collection to store selected values
  var selectedValues = [];

    // Event delegation for dynamically added delete buttons
  $('#employee-table').on('click', '#delete', function() {
    var row = $(this).closest('tr');
    var dropdown = row.find('.dropdown');
    var selectedValue = dropdown.val();

    // Remove the selected value from the array
    var index = selectedValues.indexOf(selectedValue);
    if (index !== -1) {
      selectedValues.splice(index, 1);
    }
    // Remove the row from the table
    row.remove();
  });


  $("#add-new-btn").click(function(){
        var row ='<tr class="data" id="data"><td><select id="myDropdown" class="dropdown" name="myDropdown"><option value="">--Select Product--</option>'
        +'<option value="Moniter" class="dropdown">Moniter</option>'
        +'<option value="CPU" class="dropdown">CPU</option>'
        +'<option value="Keybord" class="dropdown">Keybord</option>'
        +'<option value="Mouse" class="dropdown">Mouse</option>'
        +'</select></td>'
        +'<td><input type="number" class="qty"></td>'
        +'<td><input type="number" class="mrp"></td>'
        +'<td><input type="number" class="total" readonly></td>'
        +'<td><input type="button" id="delete" value="delete"/></td></tr>';
       
        $("#employee-table").append(row);
    });

  // Event delegation for dynamically added dropdowns
 $(document).on('change', '.dropdown', function() {
  // Code to execute when the dropdown value changes
  var selectedValue = $(this).val();
  console.log('Selected value: ' + selectedValue);
  // Check if selected value already exists in the collection
    if (selectedValues.includes(selectedValue)){
      // alert('Product is already selected, Please selecte a different product.');
      $(".dropdown option[value='"+selectedValue+"']").prop('disabled', true);
      $(this).val(); // Clear the duplicate selection
    }
    else{
      // Add the selected value to the collection
      selectedValues.push(selectedValue);
    }
});

// For calculation
function calculateTotal() {
    var totalQuantity = 0;
    var totalPrice = 0;

    $('#employee-table tr').each(function() {
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
  $('#employee-table').on('input', '.mrp, .qty', function() {
    calculateTotal();
  });
});
</script>
</html>