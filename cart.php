<?php
require_once 'core/init.php';
include 'includes/head.php'; 
include 'includes/navigation.php';
include 'includes/headerpartial.php';
include 'includes/leftbar.php';


if($cart_id != ''){
    $cartQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
    $result = mysqli_fetch_assoc($cartQ);
    $items = json_decode($result['items'], true);
    $i = 1;
    $sub_total = 0;
    $item_count = 0;
}
?>


<div class="col-md-8">
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
                        $product_id = @$item['id'];
                        $productQ = $db->query("SELECT * FROM products WHERE id = '{$product_id}'");
                        $product = mysqli_fetch_assoc($productQ);
                        $available = $product['quantity'];                       
                        var_dump($items);
                    ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?=$product['title']; ?></td>
                        <td><?=money($product['price']); ?></td>
                        <td>
                            <button class="btn btn-xs btn-default" onclick="updateCart('removeone','<?=$product['id']; ?>');">-</button>
                            <?=@$item['quantity']; ?>
                            <?php if(@$item['quantity']<$available): ?>
                                <button class="btn btn-xs btn-default" onclick="updateCart('addone','<?=$product['id']; ?>');">+</button>
                            <?php else: ?>
                                <span class="text-danger">Max Quantity Reached</span>
                            <?php endif; ?>
                        </td>
                        <td><?=money(@$item['quantity']*$product['price']); ?></td>
                    </tr>
                    <?php 
                        $i++;
                        $item_count += @$item['quantity'];
                        $sub_total += ($product['price'] * @$item['quantity']);
                    
                    } 
                    
                    $tax = TAXRATE * $sub_total;
                    $tax = number_format($tax, 2);
                    $grand_total = $tax + $sub_total;
                    ?>
                </tbody>
            </table>
        
            <table class="table table-bordered table-condensed">
                <legend>Totals</legend>
                <thead class="totals-table-header"><th class="col-sm-2">Total Items</th><th>Subtotal</th><th>Tax</th><th>Grand Total</th></thead>
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
                  <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="checkoutModalLabel">Shipping Address</h4>
                      </div>
                      <div class="modal-body">
                          <div class="row">
                            <form action="checkout_success.php" method="post" id="payment-form">
                                <span class="bg-danger" id="payment-errors"></span>
                                <div id="step1" style="display: block;">
                                    <div class="form group col-md-6">
                                        <label for="full_name">Full Name:</label>
                                        <input type="text" class="form-control" id="full_name" name="full_name">
                                    </div>
                                    <div class="form group col-md-6">
                                        <label for="email">Email:</label>
                                        <input type="text" class="form-control" id="email" name="email">
                                    </div>
                                    <div class="form group col-md-6">
                                        <label for="street">Street Address:</label>
                                        <input type="text" class="form-control" id="street" name="street">
                                    </div>
                                    <div class="form group col-md-6">
                                        <label for="street2">Street Address 2:</label>
                                        <input type="text" class="form-control" id="street2" name="street2">
                                    </div>
                                    <div class="form group col-md-6">
                                        <label for="city">City:</label>
                                        <input type="text" class="form-control" id="city" name="city">
                                    </div>
                                    <div class="form group col-md-6">
                                        <label for="state">State:</label>
                                        <input type="text" class="form-control" id="state" name="state">
                                    </div>
                                    <div class="form group col-md-6">
                                        <label for="zip_code">Zip Code:</label>
                                        <input type="text" class="form-control" id="zip_code" name="zip_code">
                                    </div>
                                    <div class="form group col-md-6">
                                        <label for="country">Country:</label>
                                        <input type="text" class="form-control" id="country" name="country">
                                    </div>
                                    
                                </div>
                                <div id="step2" style="display: none;">
                                    <div class="form-group col-md-3">
                                        <label for="name">Name on Card:</label>
                                        <input type="text" id="name" name="name" class="form-control">
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label for="number">Card Number:</label>
                                        <input type="text" id="number" name="number" class="form-control">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="cvc">CVC:</label>
                                        <input type="text" id="cvc" name="cvc" class="form-control">
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="exp-month">Expire Month:</label>
                                        <select id="exp-month" name="exp-month" class="form-control">
                                            <option value=""></option>
                                            <?php for($i=1; $i<13; $i++): ?>
                                                <option value="<?=$i; ?>"><?=$i; ?></option>
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="exp-year">Expire Year::</label>
                                        <select id="exp-year" name="exp-year" class="form-control">
                                            <option value=""></option>
                                            <?php $year = date("Y"); ?>
                                            <?php for($i=0; $i<11; $i++): ?>
                                                <option value="<?=$year+$i; ?>"><?=$year+$i; ?></option>   
                                            <?php endfor; ?>
                                        </select>
                                    </div>
                                    
                                </div>
                              
                          
                            
                        </div>
                      </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                 
                            <button type="button" class="btn btn-primary" onclick="checkAddress();" id="next_btn">Next</button>
                            <button type="button" class="btn btn-primary" onclick="backAddress();" id="back_btn" style="display: none;">Back</button>
                            <button type="submit" class="btn btn-primary" id="checkout_btn" style="display: none;">Checkout</button>
                    </form>
                 </div>
             </div>
         </div>
    </div>
        <?php endif; ?>
    </div>
</div>
<script>
    
    function backAddress(){
            $('#payment-errors').html('');
             $('#step1').css("display","block");
             $('#step2').css("display","none");
             $('#next_btn').css("display","inline-block");
             $('#back_btn').css("display","none");
             $('#checkout_btn').css("display","none");
             $('#checkoutModalLabel').html("Card Details");   
    
    }
    
    function checkAddress(){
     var data = {
         'full_name': $('#full_name').val(),
         'email': $('#email').val(),
         'street': $('#street').val(),
         'street2': $('#street2').val(),
         'city': $('#city').val(),
         'state': $('#state').val(),
         'zip_code': $('#zip_code').val(),
         'country': $('#country').val(),         
        };
    
    $.ajax({
        url: '/site/admin/parsers/check_address.php',
        method: 'post',
        data: data,
        success: function(result){
            if(result != 'passed'){
             $('#payment-errors').html(result);   
            }
            if(result=='passed'){
             $('#payment-errors').html('');
             $('#step1').css("display","none");
             $('#step2').css("display","block");
             $('#next_btn').css("display","none");
             $('#back_btn').css("display","inline-block");
             $('#checkout_btn').css("display","inline-block");
             $('#checkoutModalLabel').html("Shipping Address");
            
            }
        },
        error: function(){alert("Something went wrong during address check");}
    });    
}

</script>

<?php
include 'includes/rightbar.php';
include 'includes/footer.php';
?>    