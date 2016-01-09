<?php
    $cat_id = ((isset($_REQUEST['cat']))?sanitize($_REQUEST['cat']):'');
    $product_name = ((isset($_REQUEST['product_name']))?sanitize($_REQUEST['product_name']):'');
    $price_sort = ((isset($_REQUEST['price_sort']))?sanitize($_REQUEST['price_sort']):'');
    $min_price = ((isset($_REQUEST['min_price']))?sanitize($_REQUEST['min_price']):'');
    $max_price = ((isset($_REQUEST['max_price']))?sanitize($_REQUEST['max_price']):'');
    $b  = ((isset($_REQUEST['brand']))?sanitize($_REQUEST['brand']):'');
    $brandQ = $db->query("SELECT * FROM brand ORDER BY brand")
?>
<h3 class="text-center">Search</h3>

<form action="search.php" method="post">
    <input type="hidden" name="cat" value="<?=$cat_id;?>">
    <input type="hidden" name="price_sort" value="0">
    <h4 class="text-left">Name:</h4>
    <input type="text" class="form-control" name="product_name" placeholder="Product name" value="<?=$product_name;?>" style="width: 180px;"><br>
    
    <h4 class="text-left">Price:</h4>
        <input type="radio" name="price_sort" value="low"<?=(($price_sort=='low')?' checked':''); ?>>Ascending<br>
        <input type="radio" name="price_sort" value="high"<?=(($price_sort=='high')?' checked':''); ?>>Descending<br><br>     
        <input type="text" name="min_price" class="price-range form-control" placeholder="Min $" value="<?=$min_price;?>"> to
        <input type="text" name="max_price" class="price-range form-control" placeholder="Max $" value="<?=$max_price;?>">
     
    <br><br>
    
    <h4 class="text-left">Brand:</h4>
        <input type="radio" name="brand" value=""<?=(($b =='')?' checked':''); ?>>All<br>
        <?php while($brand = mysqli_fetch_assoc($brandQ)): ?>
            <input type="radio" name="brand" value="<?=$brand['id'] ;?>"<?=(($b==$brand['id'])?' checked':'') ;?>><?=$brand['brand']; ?> <br> 
        <?php endwhile;?>
    <br>
    <input type="submit" value="Search" class="btn btn-sm btn-primary">
    

</form>