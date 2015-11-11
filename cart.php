<?php
require_once 'core/init.php';
include 'includes/head.php'; 
include 'includes/navigation.php';
include 'includes/headerpartial.php';


if($cart_id != ''){
    $cartQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
    $result = mysqli_fetch_assoc($cartQ);
    $items = json_decode($result['items'], true);
    $i = 1;
    $sub_total = 0;
    $item_count = 0;
}
?>


<div class="col-md-12">
    <div class="row">
        <h2 class="text-center">My Shopping Cart</h2><hr>
        <?php if($cart_id == ''): ?>
            <div class="bg-danger">
                <p class="text-center text-danger">Your shopping cart is empty!</p>
            </div>
        <?php else: ?>
            <table class="table table-bordered table-condensed table-striped">
                <thead><th>#</th><th>Item</th><th>Price</th><th>Quantity</th><th>Subtotal</th></thead>
                <tbody>
                   <?php 
                    foreach($items as $item){
                        $product_id = $item['id'];
                        $productQ = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
                        $product = mysqli_fetch_assoc($productQ);
                        $available = $product['quantity'];                       
                    
                    ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?=$product['title']; ?></td>
                        <td><?=money($product['price']); ?></td>
                        <td><?=$item['quantity']; ?></td>
                        <td><?=money($item['quantity']*$product['price']); ?></td>
                    </tr>
                    <?php 
                        $i++;
                        $item_count += $item['quantity'];
                        $sub_total += ($product['price'] * $item['quantity']);
                    
                    } 
                    
                    $tax = TAXRATE * $sub_total;
                    $tax = number_format($tax, 2);
                    $grand_total = $tax + $sub_total;
                    ?>
                </tbody>
            </table>
        
            <table class="table table-bordered table-condensed">
                <legend>Totals</legend>
                <thead class="totals-table-header"><th class="col-sm-1">Total Items</th><th>Subtotal</th><th>Tax</th><th>Grand Total</th></thead>
                <tbody>
                    <tr class="text-center">
                        <td><?=$item_count; ?></td>
                        <td><?=money($sub_total); ?></td>
                        <td><?=money($tax);?></td>
                        <td class="bg-success"><?=money($grand_total);?></td> 
                    </tr>
                </tbody>
            
            </table>
            <!-- Checkout Button trigger modal -->
                <button type="button" class="btn btn-primary btn-md pull-right" data-toggle="modal" data-target="#checkoutModal">
                  <span class="glyphicon glyphicon-shopping-cart"></span>Checkout
                </button>

                <!-- Checkout Modal -->
                <div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModalLabel">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="checkoutModalLabel">Shipping Address</h4>
                      </div>
                      <div class="modal-body">
                        ...
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                      </div>
                    </div>
                  </div>
                </div>
        <?php endif; ?>
    </div>
</div>


<?php
include 'includes/footer.php';
?>    