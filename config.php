<?php
define('BASEURL', $_SERVER['DOCUMENT_ROOT'].'site/');
define('CART_COOKIE','MGwi72UCklwiqzz2');
define('CART_COOKIE_EXPIRE', time() + (86400 * 30));
define('TAXRATE', 0.19); 

define('CURRENCY', 'usd');
define('CHECKOUTMODE', 'TEST'); //live instead of test when deployed
define('STRIPE_PRIVATE','sk_test_guW6iZQSnSqDJCm7C4ffD3az');
define('STRIPE_PUBLIC', 'pk_test_mxDMi4t9Ymfv9Jo1tnDMwF2e');
