<?php
require_once 'core/init.php';
include 'includes/head.php'; 
include 'includes/navigation.php';
include 'includes/headerpartial.php';
include 'includes/leftbar.php';
$sql = "SELECT * FROM  products WHERE featured = 1";
$featured = $db->query($sql);
?>
   

            <!-- Main Content -->
            <div class="col-md-8">
                <div class="row"> 
                    <h2 class="text-center">Featured Products</h2>
                    <?php while($product = mysqli_fetch_assoc($featured)) : ?>
                        <div class="col-md-3">
                            <h4><?= $product['title']; ?></h4>
                            <img src="<?= $product['image'];?>" alt="<?= $product['title']; ?>" class="img-thumb"/>
                            <p class="list-price text-danger">List Price <s><?= money($product['list_price']);?></s></p>
                            <p class="price">Our Price: <?= money($product['price']);?></p>
                            <button type="button" class="btn btn-sm btn-info" onclick="detailsmodal(<?= $product['id']; ?>)" >Details</button>
                        </div>
                    <?php endwhile; ?>
                   
                </div>
            </div>

<?php
include 'includes/rightbar.php';
include 'includes/footer.php';
?>       