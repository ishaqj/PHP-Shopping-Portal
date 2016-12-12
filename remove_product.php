<?php 
include_once 'config.php';

$cart = new Cart($db);
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? strip_tags($_GET['id']) : "";
$destroy = isset($_GET['empty']) ? strip_tags($_GET['empty']) : "";

if(is_numeric($id) && !empty($id)) {
	$cart->removeItem($id);
	$cart->redirect('my_cart.php');
}

elseif (!empty($destroy) && $destroy == "all") {
	$cart->destroyShoppingCart();
	$cart->redirect('my_cart.php');
}

else {
	echo "<p>Nothing to show here, <a href='index.php'>Go Back</a></p>";
}