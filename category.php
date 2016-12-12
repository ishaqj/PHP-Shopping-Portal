<?php
/**
 * Created by PhpStorm.
 * User: Ishaq17
 * Date: 2016-10-12
 * Time: 19:30
 */
include_once 'config.php';
$cart = new Cart($db);
$page_title = "Produkter";
include_once 'views/header.php';
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$category_id = isset($_GET['id']) ? htmlspecialchars(strip_tags($_GET['id'])) : null;

/**
 * Instantiate Classes
 */
$products = new Products($db);

$category = new Category($db);
$category->setId($category_id);

$page_url = "category.php";

// set number of records per page
$records_per_page = 4;

// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;

// Total rows from db
$total_rows = $products->productRowCount($category->getId());

$showAllProducts = $products->showAllProducts($category->getId(), $from_record_num, $records_per_page);

include_once 'views/product-list.php';
include_once 'views/footer.php';