$(document).ready(function() {
  // Add row
  $('#add-row').click(function() {
    var html = '<tr>' +
      '<td><input type="text" name="name[]"></td>' +
      '<td><input type="text" name="email[]"></td>' +
      '<td><input type="file" name="image[]"></td>' +
      '<td><button type="button" class="delete-row">Delete</button></td>' +
      '</tr>';
    $('#myTable').append(html);
  });

  // Delete row
  $(document).on('click', '.delete-row', function() {
    $(this).closest('tr').remove();
  });
});
