<!DOCTYPE html>
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
      <button id="add-new-btn">Add New Row</button>
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
          <th>
            Image
          </th>
            <th>Total($)
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
        <td><input type="file" class="file form-control" name="file[]"/></td>
        <td><input type="number" class="total form-control" id="total" name="total[]" readonly></td>'
        <td><button type="button" class="btnDelete">Delete</button></td>
      </tr>
      </table>
      <input type="submit" value="submit" id="btnSubmit">
      </form>
    </div>		
</body>
</html>