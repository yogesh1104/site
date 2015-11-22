<?php
require_once 'core/init.php';

// Set your secret key: remember to change this to your live secret key in production
// See your keys here https://dashboard.stripe.com/account/apikeys
\Stripe\Stripe::setApiKey(STRIPE_PRIVATE);

// Get the credit card details submitted by the form
$token = $_POST['stripeToken'];
// Get the rest of the post data
$full_name = sanitize($_POST['full_name']);
$email = sanitize($_POST['email']);
$street = sanitize($_POST['street']);
$street2 = sanitize($_POST['street2']);
$city = sanitize($_POST['city']);
$state = sanitize($_POST['state']);
$zip_code = sanitize($_POST['zip_code']);
$country = sanitize($_POST['country']);
$tax = sanitize($_POST['tax']);
$sub_total = sanitize($_POST['sub_total']);
$grand_total = sanitize($_POST['grand_total']);
$cart_id = sanitize($_POST['cart_id']);
$description = sanitize($_POST['description']);
$charge_amount = number_format($grand_total,2) * 100;
$metadata = array(
    "cart_id" => $cart_id,
    "tax"     => $tax,
    "sub_total"=> $sub_total
);

// Create the charge on Stripe's servers - this will charge the user's card
try {
  $charge = \Stripe\Charge::create(array(
    "amount"    => $charge_amount, // amount in cents, again
    "currency" => CURRENCY,
    "source"    => $token,
    "description" => $description,
    "receipt_email"=>$email,
    "metadata" => $metadata        
    ));
    
//update inventory
$itemQ = $db->query("SELECT * FROM cart WHERE id = '{$cart_id}'");
$iresults = mysqli_fetch_assoc($itemQ);
$items = json_decode($iresults['items'], true);
foreach($items as $item){
    $item_id = $item['id'];
    $productQ = $db->query("SELECT quantity FROM products WHERE id = '{$item_id}'");
    $product = mysqli_fetch_assoc($productQ);
    $newQuantity = $product['quantity'] - $item['quantity'];
    $db->query("UPDATE products SET quantity = '$newQuantity' WHERE id = '{$item_id}'");
    
}
    
    
    
//update cart
$db->query("UPDATE cart SET paid = 1 WHERE id='{$cart_id}'");
$db->query("INSERT INTO transactions (`charge_id`, `cart_id`, `full_name`, `email`, `street`, `street2`, `city`, `state`, `zip_code`, `country`, `sub_total`, `tax`, `grand_total`, `description`, `txn_type`) VALUES ('$charge->id', '$cart_id', '$full_name', '$email', '$street', '$street2', '$city', '$state', '$zip_code', '$country', '$sub_total', '$tax', '$grand_total', '$description', '$charge->object') ");

//$domain = '.'.$_SERVER['HTTP_HOST'];
setcookie(CART_COOKIE, '',1,"/",false,false); //when deployed instead of first false is $_SERVER['HTTP_POST']
include 'includes/head.php'; 
include 'includes/navigation.php';
include 'includes/headerpartial.php';
?>
<div class="col-md-2"></div>
<div class="container-fluid col-md-8">
    <h1 class="text-center text-success">Checkout success!</h1><br>
    <p> Your card has been successfully charged <?=money($grand_total); ?>. Please check your email with the confirmation and keep your phone close because one of our operators will call you as soon as possible. Thank you!</p>
    <p>Your receipt number is: <strong><?=$cart_id; ?></strong></p>
    <p>Your order will be shipped to the address below</p>
    <address>
        <?=$full_name;?><br>
        <?=$street;?><br>
        <?=(($street2!='')?$street2.'<br>':''); ?>
        <?=$city.', '.$state.' '.$zip_code;?><br>
        <?=$country;?><br>
    </address>
</div>
<div class="col-md-2"></div>
<?php    
include 'includes/footer.php';

} catch(\Stripe\Error\Card $e) {
  // The card has been declined
}

?>