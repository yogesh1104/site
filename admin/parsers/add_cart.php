<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/site/core/init.php';
$product_id = sanitize($_POST['product_id']);
$available = sanitize($_POST['available']);
$quantity = sanitize($_POST['quantity']);
$item = array();
$item[] = array(
    'id'       => $product_id,
    'quantity' => $quantity,
    );

//$domain = '.'.$_SERVER['HTTP_POST'];
$query = $db->query("SELECT * FROM products WHERE id='$product_id'");
$product = mysqli_fetch_assoc($query);
$_SESSION['success_flash'] = $product['title'].' was added to the cart.';

//check to see if the cart cookie exists
if($cart_id != ''){
    $cartQuery = $db->query("SELECT * FROM cart WHERE id = '$cart_id'");
    $cart = mysqli_fetch_assoc($cartQuery);
    $previous_items = json_decode($cart['items'], true);
    $item_match = 0;
    $new_items = array();
    foreach($previous_items as $pitem){
        if($item[0]['id'] == $pitem['id']){
            $pitem['quantity'] = $pitem['quantity'] + $item[0]['quantity'];
            if($pitem['quantity']>$available){
             $pitem['quantity'] = $available;   
            }
            $item_match = 1;
          }
          $new_items[] = $pitem;
        }
    if($item_match!=1){
      $new_items = array_merge($item, $previous_items);  
    }
    $items_json = json_encode($new_items);
    $cart_expire = date("Y-m-d H:i:s", strtotime("+30 days"));
    $db->query("UPDATE cart SET items = '{$items_json}', expire_date='{$cart_expire}' WHERE id = '{$cart_id}'");
    setcookie(CART_COOKIE, '', 1, '/', false, false);
    setcookie(CART_COOKIE, $cart_id, CART_COOKIE_EXPIRE, '/', false, false);   
}else{
 //add the cart to the database and set cookie
    $items_json = json_encode($item);
    $cart_expire = date("Y-m-d H:i:s", strtotime("+30 days"));
    $db->query("INSERT INTO cart (`items`, `expire_date`) VALUES ('{$items_json}', '{$cart_expire}')");
    $cart_id = $db->insert_id;
    setcookie(CART_COOKIE, $cart_id, CART_COOKIE_EXPIRE, '/', false, false); //$domain will be used instead of first 'false' when deployed
}
?>

