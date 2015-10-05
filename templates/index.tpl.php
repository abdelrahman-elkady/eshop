<?php foreach ($products as $product) : ?>
  <div class="col-md-4">
    <div class="product">
      <img src="<?php echo $product['picture']; ?>" alt="product" />

      <div class="product-info">
        <p class="product-name"><?php echo $product['name']; ?></p>
        <h6 class="product-class"><?php echo $product['price']; ?> <i class="fa fa-usd currency"></i></h6>
      </div>

      <a href="#" class="btn btn-success btn-wide btn-block">Add</a>
    </div>
  </div>
<?php endforeach; ?>
