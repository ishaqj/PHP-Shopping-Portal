<?php
include_once 'config.php';

$cart = new Cart($db);
$items = $cart->initiateShoppingCart();

echo $items;