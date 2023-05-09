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
      <button class="deleteRow">Delete</button>
      <br>
      <br>
      <table id="employee-table">
        <tr>
          <th>Select Product
          </th>
          <th>Product Id
          </th>
          <th>Order No
          </th>
          <th>M.R.P
          </th>
          <th>Action
          </th>
        </tr>
      </table>
      <input type="submit" value="submit">
    </div>		
</body>
<script src="jq/jquery-3.6.4.min.js"></script>
<script>
 $(document).ready(function() {
  // Collection to store selected values
  var selectedValues = [];

  // Event delegation for dynamically added delete buttons
  $('#employee-table').on('click', '.deleteRow', function() {
    var row = $(this).closest('tr');
    var dropdown = row.find('.dynamicDropdown');
    var selectedValue = dropdown.val();

    // Remove the selected value from the array
    var index = selectedValues.indexOf(selectedValue);
    if (index !== -1) {
      selectedValues.splice(index, 1);
    }

    // Remove the row from the table
    row.remove();
  });

  // Event delegation for dynamically added dropdowns
  $('#employee-table').on('change', '.dynamicDropdown', function() {
    var selectedValue = $(this).val();

    // Check if selected value already exists in the collection
    if (selectedValues.includes(selectedValue)) {
      alert('Duplicate selection. Please choose a different option.');
      // Perform any other necessary actions
      $(this).val(''); // Clear the duplicate selection
    } else {
      // Add the selected value to the collection
      selectedValues.push(selectedValue);
    }
  });

  // Add a new row on button click
  $('#add-new-btn').click(function() {
    var newRow = '<tr>' +
                  '<td>' +
                  '<select class="dynamicDropdown">' +
                  '<option value="">Select an option</option>' +
                  '<option value="1">Option 1</option>' +
                  '<option value="2">Option 2</option>' +
                  '</select>' +
                  '</td>' +
                  '<td>' +
                  '<button class="deleteRow">Delete</button>' +
                  '</td>' +
                  '</tr>';

    $('#employee-table').append(newRow);
  });
});

</script>
</html>