$(document).ready(function() {
  $('.dropdown-toggle').dropdown();

  $('#profile_avatar').on('click', function() {
    $('#avatar_file').click();
  });

  $(".delete-item").click(function(event) {

    var row = $(this).closest("tr");
    var id = parseInt(row.find('.checkout-product').text());

    row.fadeOut(400, function() {
      $(this).remove();
      displayTotal();
    });

    $.ajax({
      url: "php-scripts/removeFromCart.php?id=" + id,
      success: function(data) {}
    });

  });

  function displayTotal() {
    var total = 0.0;
    $('.cart-table').find('.price').each(function() {
      total += parseFloat($(this).text());
    });
    $('#checkout_total').text('Total : ' + total);
    $('#checkout_total').append(" <i class='fa fa-usd currency'></i>");
  }
  displayTotal();

  $('#add_to_cart_modal').on('show.bs.modal', function(event) {
    var button = $(event.relatedTarget);
    var id = button.data('id');
    var modal = $(this);
    var price = 0;
    var quantitySpinner = modal.find('#cart_quantity');
    var stock;
    quantitySpinner.val(1); // Resetting the value again if another modal was opened before


    $.ajax({
      type: "GET",
      url: "php-scripts/productDetails.php?id=" + id,
      dataType: "json",
      success: function(data) {
        price = data['price'];
        stock = data['stock'];
        modal.find('#product_name').text(data['name']);

        modal.find('#unit_price').text(data['price']);
        modal.find('#unit_price').append("<i class='fa fa-usd currency'></i>");

        modal.find('#product_description').text(data['description']);
        quantitySpinner.attr('max', stock);

        modal.find('#confirmation_total').text("Total : " + data['price']);
        modal.find('#confirmation_total').append(" <i class='fa fa-usd currency'></i>");

        modal.find('#add_to_cart_button').attr('href', 'index.php?id=' + id + '&quantity=' + quantitySpinner.val());

      }
    });

    quantitySpinner.bind('keyup mouseup', function() {

      if (isNaN(quantitySpinner.val()) || quantitySpinner.val() <= 0) {
        quantitySpinner.val(stock);
      } else if (quantitySpinner.val() > stock) {
        quantitySpinner.val(stock);
      }

      modal.find('#confirmation_total').text("Total : " + (parseFloat(quantitySpinner.val()) * price).toFixed(2));
      modal.find('#confirmation_total').append("<i class='fa fa-usd currency'></i>");

      modal.find('#add_to_cart_button').attr('href', 'index.php?id=' + id + '&quantity=' + quantitySpinner.val());
    });

  });

});
