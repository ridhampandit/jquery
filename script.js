$(document).ready(function() {
    // Add row
    $('#add-new-btn').click(function() {
      var row = '<tr>' +
                  '<td><input type="text" class="email form-control" name="email[]" />' +
                  '<span class="error-message-email"></span></td>'+
                  '<td>' +
                  '<select name="myDropdown[]" class="dropdown form-control">' +
                  '<option value="">--Select Product--</option>'+
                  '<option value="Moniter" class="dropdown">Moniter</option>' +
                  '<option value="CPU" class="dropdown">CPU</option>' +
                  '<option value="Keybord" class="dropdown">Keybord</option>' +
                  '<option value="Mouse" class="dropdown">Mouse</option>' +
                  '</select>' +
                  '<span class="error-message-myDropdown"></span></td>'+
                  '</td>' +
                  '<td><input type="number" class="qty form-control" name="qty[]" />' +
                  '<span class="error-message-qty"></span></td>'+
                  '<td><input type="number" class="mrp form-control" name="mrp[]">'+
                  '<span class="error-message-mrp"></span></td>'+
                  '<td><input type="text" class="total form-control" name="total[]" readonly /></td>'+
                  '<td><input type="file" class="file form-control" name="file[]"/></td>'+
                  '<td><button type="button" class="btnDelete" id="btnDelete">Delete</button></td>' +
                '</tr>';
      $('#employee-table').append(row);
    });
  
    // Delete row
    $(document).on('click', '.btnDelete', function() {
      $(this).closest('tr').remove();
    });
    var selectedValues = [];
  
  //   // Event delegation for dynamically added delete buttons
  $('#employee-table').on('click', '#btnDelete', function() {
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

  $(document).on('change', '.dropdown', function() {
    var selectedValue = $(this).val();
    $('.dropdown').not(this).find('option[value="' + selectedValue + '"]').prop('disabled', true);
  });

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

    $("#myform").validate({
      rules:{
       "email[]":{
              required: true,
              email:true 
          },
       "myDropdown[]":{
              required: true
          },
         "qty[]":{
              required: true
          }
         },
          messages: {
           "email[]":{
              required: "Please enter email.",
              email:"Please enter valid email."
          },
           "myDropdown[]": {
             required: "Please selecte product."
         },
         "qty[]": {
             required: "Please enter quantity."
         },
         "mrp[]":{
              required: "Please enter mrp."
          },
     },
     errorPlacement: function(error, element) {
       if (element.attr("name") === "email[]") {
             error.appendTo(".error-message-email");
         }
         if (element.attr("name") === "myDropdown[]") {
             error.appendTo(".error-message-myDropdown");
         }
         if (element.attr("name") === "qty[]") {
             error.appendTo(".error-message-qty");
         }
         if (element.attr("name") === "mrp[]") {
             error.appendTo(".error-message-mrp");
         }
   }
  });

    // Submit data
    $('#btnSubmit').click(function() {
      var emailArr = [];
      var myDropdownArr = [];
      var qtyArr = [];
      var mrpArr = [];
      var fileArr = [];
      var totalArr = [];
  
      $('input[name="email[]"]').each(function() {
        emailArr.push($(this).val());
      });
  
      $('select[name="myDropdown[]"]').each(function() {
        myDropdownArr.push($(this).val());
      });
  
      $('input[name="qty[]"]').each(function() {
        qtyArr.push($(this).val());
      });
      
      $('input[name="mrp[]"]').each(function() {
        mrpArr.push($(this).val());
      });

      $('input[name="file[]"]').each(function() {
        fileArr.push($(this).val());
      });

      $('input[name="total[]"]').each(function() {
        totalArr.push($(this).val());
      });

      $.ajax({
        url: 'save_data.php',
        method: 'POST',
        data: {  emails: emailArr, myDropdowns: myDropdownArr, qtys: qtyArr, mrps: mrpArr, files: fileArr, totals: totalArr},
        success: function(response) {
          alert('Data saved successfully.');
          // You can perform any additional actions here after successful data insertion.
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText);
          alert('An error occurred while saving data.');
        }
      });
    });
  });