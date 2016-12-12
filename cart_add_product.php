<?php
header('Content-Type: application/json');
include_once 'config.php';

$cart = new Cart($db);
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? htmlspecialchars(strip_tags($_GET['id'])) : "not numeric";

if (is_numeric($id) && !empty($id)) {
    $cart->addItem($id);
    $items = [
        "items" => $cart->cartItems(),
        "sum" => $cart->productsSum(),
        "message" => $cart->getFlashMessages()
    ];

    echo json_encode($items);
}