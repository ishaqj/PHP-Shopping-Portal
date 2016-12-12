<?php 

/**
 * Include files
 */
include_once 'config.php';

/**
 * Instantiate Cart class
 */
$cart = new Cart($db);

/**
 * Display Shopping Cart with quantity and remove item option.
 */
$sum = 0;
$cartTable = "";

if(isset($_SESSION['products']) && !empty($_SESSION['products']))
{
	$items = $_SESSION['products'];

	$cartTable .= "<div class='row'><div class='col-md-10'>";
	$cartTable .= "<div class='page-header'><h1>Varukorg</h1></div>";
	$cartTable .= $cart->getFlashMessages();
	$cartTable .= "<a class='pull-right' href='remove_product.php?empty=all'>Töm Varukorg</a>";
	
	$ids = array();
	foreach ($items as $id => $item) {
		$ids[] = $id;
	}
	
	$place_holders = implode(',', array_fill(0, count($ids), '?'));
	$shopItems = $cart->getItems($place_holders,$ids);
	$cartTable .= "<table class='table table-bordered'><tr><th>Produkt</th><th>Lagerstatus</th><th>Pris</th><th>Ta bort</th>";
	$cartTable .= "</tr>";
	$cartTable .= "<div class ='row'><form action='' method='POST'>";
	foreach ($shopItems as $item) {
		if(array_key_exists($item->product_id,$_SESSION['products']))
		{
			$cartTable .= "<tr>";
			$cartTable .= "<td><div class='col-md-2'>";
			$cartTable .= "<input type='submit' name='submit{$item->product_id}' value='Spara' class='btn btn-primary'>";
			$cartTable .= "<input type='hidden' name='id{$item->product_id}' value='{$item->product_id}'></div>";
			$cartTable .= "<div class='col-md-2'>";
			$cartTable .= "<input class='form-control' type='text' name='qty{$item->product_id}' value='{$_SESSION['products'][$item->product_id]}'></div>";
			$cartTable .= "<span>st {$item->name}</span></td>";
			$cartTable .= "<td>{$item->stock} <span>st</span></td>";
			$cartTable .= "<td><span>{$item->price} kr</span></div></td>";
			$cartTable .= "<td><a class='btn btn-primary' href='remove_product.php?id={$item->product_id}'>Ta bort</a></td>";
			$cartTable .= "</tr>";
			$sum += $_SESSION['products'][$item->product_id] * $item->price;
		}
	}

	$cartTable .= "</form></div></table>";
	$cartTable .= "<span>Totalpris:</span> <b>{$sum} kr</b>";
	$cartTable .= "</div></div>";
	
	/**
	 * Update Item Quantity
	 */
	foreach ($shopItems as $item) {
		if(isset($_POST['submit'.$item->product_id]))
		{
			$id = isset($_POST['id'.$item->product_id]) && is_numeric($_POST['id'.$item->product_id])  ? strip_tags($_POST['id'.$item->product_id]) : "";
			$qty = isset($_POST['qty'.$item->product_id]) && is_numeric($_POST['qty'.$item->product_id]) ? strip_tags($_POST['qty'.$item->product_id]) : "";
			
			$cart->updateItem($id,$qty);
			$cart->redirect('my_cart.php');
		}

	}
}

else {

	$cartTable = "";
	$cartTable .= "<div class='row'><div class='col-md-10'>";
	$cartTable .= "<div class='page-header'><h1>Varukorg</h1></div>";
	$cartTable .= $cart->getFlashMessages();
	$cartTable .= "<p>Din varukorg är tom! <a href='index.php'>Gå Tillbaka</a></p>";
	$cartTable .= "</div></div>";
	
}

include_once 'views/header.php';
echo $cartTable;
include_once 'views/footer.php';