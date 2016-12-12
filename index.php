<?php

/**
 * Include files
 */
include_once 'config.php';
$cart = new Cart($db);
$page_title = "Hem | Online Store";
include_once 'views/header.php';
$page = isset($_GET['page']) ? $_GET['page'] : 1;
/**
 * Instantiate Classes
 */
$products = new Products($db);

$category = new Category($db);

/**
 * Display all products and pagination
 */
$category_id = null;
$page_url = "index.php";

// set number of records per page
$records_per_page = 8;

// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;

// Total rows from db
$total_rows = $products->productRowCount($category_id);

$showAllProducts = $products->showAllProducts($category_id, $from_record_num, $records_per_page);
include_once 'views/product-list.php';

include_once 'views/footer.php';

