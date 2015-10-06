<!-- Modal -->
<div class="modal fade" id="add_to_cart_modal" tabindex="-1" role="dialog" aria-labelledby="add_to_cart_modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
        <h4 class="modal-title" id="exampleModalLabel">Buy product</h4>
      </div>
      <div class="modal-body product-details">
        <h1 class="hidden" id="product_id"></h1>

        <h4 id="product_name"></h4>

        <p id="unit_price" class="pull-right"></p>

        <div class="description-wrapper">
          <p><b>description:</b></p>
          <p id="product_description"></p>
        </div>

        <div class="quantity-wrapper">
          <label for="cart_quantity">quantity:</label>
          <input type="number" id="cart_quantity" name="cart_quantity" value="1" min="0">
        </div>

        <div class="confirmation-total-wrapper">
          <div class="separator pull-right"></div>

          <p id="confirmation_total" class="text-right"></p>

        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary btn-small" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- /Modal -->
