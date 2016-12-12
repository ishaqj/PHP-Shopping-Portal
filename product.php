<?php
/**
 * Created by PhpStorm.
 * User: Ishaq17
 * Date: 2016-10-10
 * Time: 21:47
 */
include_once 'config.php';
$id = isset($_GET['id']) && is_numeric($_GET['id']) ? htmlspecialchars(strip_tags($_GET['id'])) : "not numeric";

if(is_numeric($id) && !empty($id)) {

    // GET PRODUCT
    $product = new Products($db);
    $product->setId($id);
    $product->getProduct();

    // SET PAGE TITLE
    $page_title = $product->getName();
    $cart = new Cart($db);
    include_once 'views/header.php';

    // GET PRODUCT CATEGORY
    $category = new Category($db);
    $category->setId($product->getCategoryId());
    $category->getCategory();

    
    // INCLUDE PRODUCT TEMPLATE FILE AND FOOTER
    include 'views/product-detail.php';
    include_once 'views/footer.php';
}
else {
    echo "<p>Nothing to show here, <a href='index.php'>Go Back</a></p>";
}

