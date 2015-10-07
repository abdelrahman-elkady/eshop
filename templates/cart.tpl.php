<h2 class="centered">Your purchase</h2>

<table class="table table-hover cart-table">
  <tr>
    <th>Name</th>
    <th>Price</th>
    <th>Units</th>
    <th>Total</th>
    <th></th>
  </tr>

  <?php foreach ($cart as $product): ?>
    <tr>
      <!-- TODO: id vs class ? -->
      <td class="hidden checkout_product" >
        <?php echo $product['product_id']; ?>
      </td>

      <td>
        <?php echo $product['name']; ?>
      </td>

      <td>
        <?php echo $product['price']; ?> <i class="fa fa-usd"></i>
      </td>

      <td>
        <?php echo $product['quantity']; ?>
      </td>

      <td>
        <?php echo intval($product['price']) * intval($product['quantity']); ?> <i class="fa fa-usd"></i>
      </td>

      <td>
        <a href="#" ><i class="delete-item fa fa-minus"></i></a>
      </td>
    </tr>
  <?php endforeach; ?>
</table>

<div class="confirmation-total-wrapper">
  <div class="separator pull-right"></div>

  <p id="checkout_total" class="text-right"></p>

</div>

<a href="confirm.php" class="btn btn-success btn-wide btn-block">CHECKOUT</a>
