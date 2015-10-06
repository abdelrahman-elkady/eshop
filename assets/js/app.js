$(document).ready(function() {
  $('.dropdown-toggle').dropdown();

  $('#profile_avatar').on('click', function() {
    $('#avatar_update').click();
  });

  $('#add_to_cart_modal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var modal = $(this);


    $.ajax({
      type: "GET",
      url: "php-scripts/productDetails.php?id=" + id,
      dataType: "json",
      success: function(data) {
        modal.find('#product_name').text(data['name']);

        modal.find('#unit_price').text(data['price']);
        modal.find('#unit_price').append("<i class='fa fa-usd currency'></i>");

        modal.find('#product_description').text(data['description']);

      }
    });


  });

});
