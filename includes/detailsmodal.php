<?php
require_once '../core/init.php';
$id = $_POST['id'];
$id = (int)$id;
$sql = "SELECT * FROM products WHERE id = '$id'";
$result = $db->query($sql);
$product = mysqli_fetch_assoc($result);
$brand_id = $product['brand'];
$sql = "SELECT brand FROM brand WHERE id = '$brand_id'";
$brand_query = $db->query($sql);
$brand = mysqli_fetch_assoc($brand_query);
?>

<!-- Details Modal -->
    <?php ob_start(); ?>
    <div class="modal fade details-1" id="details-modal" tabindex="-1" role="dialog" aria-labelledby="details-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <button class="close" type="button" onclick="closeModal()" aria-label="Close">
                    <span aria-hidden="true">&times; </span>
                </button>
                <h4 class="modal-title text-center"><?= $product['title']; ?></h4>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row">
                       <span id="modal_errors" class="bg-danger"></span> 
                        <div class="col-sm-6">
                            <div class="center-block">
                                <img src="<?= $product['image']; ?>" alt="<?= $product['title']; ?>" class="details img-responsive">
                            </div>
                        </div>
                        <div class="col-sm-6"> 
                            <h4>Details</h4>
                            <p><?= nl2br($product['description']); ?></p>
                            <hr>
                            <p>Price: <?= $product['price']; ?> &euro; </p>
                            <p>Brand: <?= $brand['brand']; ?></p>
                            <p>Available: <?=$product['quantity'];?></p>
                            <form action="add_cart.php" method="post" id="add_product_form">
                                <input type="hidden" name="product_id" value="<?=$id; ?>">
                                <input type="hidden" name="available" id="available" value="<?=$product['quantity'];?>">
                                <div class="form-group">
                                    <div class="col-xs-4">
                                        <br><br>
                                        <label for="quantity">Quantity:</label>
                                        <input type="number" class="form-control" id="quantity" name="quantity" min="0">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button class="btn btn-default" onclick="closeModal()">Close</button>
                <button class="btn btn-warning" onclick="addToCart(); return false;"><span class="glyphicon glyphicon-shopping-cart"></span>Add To Cart</button>
            </div>
        
        </div>
   </div>
</div>
<script> 
    function closeModal(){
       $('#details-modal').modal('hide');
        setTimeout(function(){
            $('#details-modal').remove();
            $('.modal-backdrop').remove();
        },500);
        
    }
</script>
<?php echo ob_get_clean(); ?>