<?php foreach ($products as $product) : ?>
  <div class="col-md-4">
    <div class="product">
      <img src="<?php echo $product['picture']; ?>" alt="product" />

      <div class="product-info">
        <p class="product-name"><?php echo $product['name']; ?></p>
        <h6 class="product-class"><?php echo $product['price']; ?> <i class="fa fa-usd currency"></i></h6>
      </div>

      <?php if ($userObj->isSignedIn()): ?>
        <?php if (intval($product['stock']) == 0): ?>
          <button href="#" class="btn disabled btn-wide btn-block out-of-stock">OUT OF STOCK</button>
        <?php else: ?>
          <button href="#" class="btn btn-success btn-wide btn-block" data-toggle="modal" data-target="#add_to_cart_modal" data-id="<?php echo $product['product_id'];?>">BUY</button>
        <?php endif; ?>

      <?php else: ?>
        <a href="login.php" class="btn btn-success btn-wide btn-block">BUY</a>
      <?php endif; ?>

    </div>
  </div>
<?php endforeach; ?>

<?php include_once 'includes/addToCartModal.php'; ?>
