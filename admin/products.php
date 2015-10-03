<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/site/core/init.php';
    include 'includes/head.php';
    include 'includes/navigation.php';
    if(isset($_GET['add'])) {
    $brandQuery = $db->query("SELECT * FROM brand ORDER BY brand");
    $parentQuery = $db->query("SELECT * FROM categories WHERE parent = 0 ORDER BY category");
   if($_POST){
      $title = sanitize($_POST['title']);
      $brand = sanitize($_POST['brand']);
      $price = sanitize($_POST['price']);
      $list_price = sanitize($_POST['list_price']);
      $categories = sanitize($_POST['child']);
      $quantity = sanitize($_POST['quantity']);
      $description = sanitize($_POST['description']);
      $dbPath = '';
      $errors = array();
      $required = array('title', 'brand', 'parent', 'child', 'quantity');
      foreach($required as $field){
          if($_POST[$field]==''){
           $errors[] = "All fields with an asterisk are required.";
           break;
          }
      }
    if(!empty($_FILES)){
        var_dump($_FILES);
        $photo = $_FILES['photo'];
        $name = $photo['name'];
        $nameArray = explode('.',$name);
        $fileName = $nameArray[0];
        $fileExt = $nameArray[1];
        $mime = explode('/',$photo['type']);
        $mimeType = $mime[0];
        $mimeExt =  $mime[1];
        $tmpLoc = $photo['tmp_name'];
        $fileSize = $photo['size'];
        $allowed = array('png','jpg','jpeg','gif');        
        $uploadName = md5(microtime()).'.'.$fileExt;
        $uploadPath = BASEURL.'images/products/'.$uploadName;
        $dbPath = '/site/images/products/'.$uploadName;
        if($mimeType!='image'){
            $errors[]='The file must be an image.';
        }
        if(!in_array($fileExt, $allowed)){
         $errors[] = 'The file extension must be a png, jpg, jpeg or gif.';   
        }
        if($fileSize > 10000000){
         $errors[] = 'The file size must be under 10mb';
        }
        if($fileExt != $mimeExt && ($mimeExt == 'jpeg' && $fileExt != 'jpg') ){
            $errors[] = 'File extension does not match the file';
        }
    }
    if(!empty($errors)){
        echo display_errors($errors);
     }else{
        //upload file and insert into database
        move_uploaded_file($tmpLoc, $uploadPath);
        $insertSQL = "INSERT INTO products (`title`, `price`, `list_price`, `brand`, `categories`, `image`, `description`, `quantity`) 
        VALUES ('$title', '$price', '$list_price', '$brand', '$categories', '$dbPath', '$description', '$quantity')";
        $db->query($insertSQL);
        header('Location: products.php');
    }
   }
    ?>
    <h2 class="text-center">Add a new product</h2><hr>
    <form action="products.php?add=1" method="POST" enctype="multipart/form-data">
        <div class="form-group col-md-3">
            <label for="title">Title*: </label>
            <input type="text" name="title" class="form-control" id="title" value="<?=((isset($_POST['title']))?sanitize($_POST['title']):''); ?>">
        </div>
        <div class="form-group col-md-3">
            <label for="brand">Brand*:</label>
            <select class="form-control" id="brand" name="brand">
                <option value=""<?=((isset($_POST['brand']) && $_POST['brand'] == '')?' selected':''); ?>></option>
                <?php while($brand = mysqli_fetch_assoc($brandQuery)): ?>
                    <option value="<?=$brand['id'];?>"<?=((isset($_POST['brand']) && $_POST['brand']==$brand['id'])?' selected':'');?>><?= $brand['brand']; ?></option>
                
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="parent">Parent Category*:</label>
            <select class="form-control" id="parent" name="parent">
                <option value=""<?=((isset($_POST['parent']) && $_POST['parent']=='')?' selected':'');  ?>></option>
                <?php while($parent = mysqli_fetch_assoc($parentQuery)): ?>
                    <option value="<?= $parent['id'];?>"<?= ((isset($_POST['parent']) && $_POST['parent'] == $parent['id'])?' select': ''); ?>><?= $parent['category']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="child">Child Category*:</label>
            <select id="child" name="child" class="form-control">
            </select>
        </div>
        <div class="form group col-md-3">
            <label for="price">Price*:</label>
            <input type="text" id="price" name="price" class="form-control" value=""<?=((isset($_POST['price']))?sanitize($_POST['price']):''); ?>></input>
        
        </div>
        <div class="form group col-md-3">
            <label for="price">List Price:</label>
            <input type="text" id="list_price" name="list_price" class="form-control" value=""<?=((isset($_POST['list_price']))?sanitize($_POST['list_price']):''); ?>></input>
        </div>
        <div class = "form-group col-md-3">
            <label>Quantity*:</label>
            <button class="btn btn-default form-control" onclick="$('#quantityModal').modal('toggle'); return false;">Quantity</button>
        </div>
        <div class="form-group col-md-3">
            <label for="quantity">Quantity Preview</label>
            <input class="form-control" type="text" name="quantity" id="qty_prev" value="" readonly>
        </div>
        <div class="form-group col-md-6">
            <label for="photo">Product Photo:</label>
            <input type="file" name="photo" id="photo" class="form-control">
        </div>
        <div class="form-group col-md-6">
            <label for="description">Description:</label>
            <textarea id="description" name="description" class="form-control" rows="6"><?= ((isset($_POST['description']))?sanitize($POST['description']):'');?></textarea>
        </div>
        <div class="form-group pull-right">
            <input type="submit" value="Add product" class="form-control btn btn-success">
        </div><div class="clearfix"></div>    
    </form>
        <!-- Modal -->
    <div class="modal fade" id="quantityModal" tabindex="-1" role="dialog" aria-labelledby="quantityModalLabel">
      <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
         
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="quantityModalLabel">Quantity</h4>       
          <div class="modal-body">             
                <label for="quantity">Quantity</label>
                <input type="number" name="quantity" id="quantity" value="" min="0" class="form-control">            
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" onclick="updateQuantity();$('#quantityModal').modal('toggle'); return false;">Save changes</button>
          </div>
        </div>
      </div>
    </div>
    
    <?php }else{
    $sql = "SELECT * FROM products WHERE deleted = 0";
    $presults = $db->query($sql);
    if(isset($_GET['featured'])){
        $id = (int)$_GET['id'];
        $featured = (int)$_GET['featured'];
        $featuredSql = "UPDATE products SET featured = '$featured' WHERE id = '$id'";
        $db->query($featuredSql);
        header('Location: products.php');
    }
?>
<h2 class="text-center">Products</h2>
<a href="products.php?add=1" class="btn btn-success pull-right" id="add-product-button">Add product</a><div class="clearfix"></div>

<hr>
<table class = "table table-bordered table-condensed table-striped">
    <thead><th></th><th>Product</th><th>Price</th><th>Categories</th><th>Featured</th><th>Sold</th></thead>
    <tbody>
        <?php while($product = mysqli_fetch_assoc($presults)): 
            $childID = $product['categories'];
            $catSql = "SELECT * FROM categories WHERE id = '$childID'";
            $result = $db->query($catSql);
            $child = mysqli_fetch_assoc($result);
            $parentID = $child['parent'];
            $pSql = "SELECT * FROM categories WHERE id = '$parentID'";
            $presult = $db->query($pSql);
            $parent = mysqli_fetch_assoc($presult);
            $category = $parent['category'].'~'.$child['category'];
        
        ?>
            <tr>
                <td>
                    <a href="products.php?edit=<?=$product['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-pencil"></span></a>
                    <a href="products.php?delete=<?=$product['id']; ?>" class="btn btn-xs btn-default"><span class="glyphicon glyphicon-remove"></span></a>
                </td>
                <td><?=$product['title']; ?></td>
                <td><?=money($product['price']); ?></td>
                <td><?=$category; ?></td>
                <td><a href="products.php?featured=<?=(($product['featured'] == 0)?'1':'0'); ?>&id=<?=$product['id']; ?>" class="btn btn-xs btn-default">
                    <span class="glyphicon glyphicon-<?=(($product['featured']==1)?'minus':'plus'); ?>"></span></a>
                    &nbsp <?=(($product['featured']==1)?'Featured product' : ''); ?></td>
                <td>0</td>
            </tr>
        
        <?php endwhile; ?>
    </tbody>
</table>




<?php } include 'includes/footer.php' ?>