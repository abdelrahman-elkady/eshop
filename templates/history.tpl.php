<h2 class="centered">Your purchase history</h2>

<table class="table table-hover history-table">
  <tr>
    <th>Name</th>
    <th>Price</th>
    <th>Units</th>
    <th>Total</th>
    <th>Date</th>
  </tr>

  <?php foreach ($history as $product): ?>
    <tr>

      <td>
        <?php echo $product['name']; ?>
      </td>

      <td>
        <?php echo $product['price']; ?> <i class="fa fa-usd"></i>
      </td>

      <td>
        <?php echo $product['quantity']; ?>
      </td>

      <td class="price">
        <?php echo round(floatval($product['price']) * floatval($product['quantity']), 2); ?> <i class="fa fa-usd"></i>
      </td>

      <td>
        <?php echo $product['purchase_date'] ?>
      </td>

    </tr>
  <?php endforeach; ?>
</table>

<a href="index.php" class="btn btn-success btn-wide">HOME</a>
