<?php

include_once 'config.php';
$cart = new Cart($db);
$page_title = "Admin panel";
include_once 'views/header.php';

$product = new Products($db);
$category = new Category($db);

//PAGING STUFF
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$page_url = "admin.php";

$category_id = null;
// set number of records per page
$records_per_page = 6;

// calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;

// Total rows from db
$total_rows = $product->productRowCount();

//Total pages
$total_pages = ceil($total_rows / $records_per_page);

// range of links to show
$range = 2;

// display links to 'range of pages' around 'current page'
$initial_num = $page - $range;
$condition_limit_num = ($page + $range) + 1;


$listProducts = $product->showAllProducts($category_id, $from_record_num, $records_per_page);

?>
<div class="row">
    <div class="page-header">
        <h1>Admin Panel</h1>
    </div>
    <a class="btn btn-primary pull-right" href="add_product.php"><i class="glyphicon glyphicon-plus"></i> Add
        Product</a>
</div>
<br>
<div class="row">
    <div class="table-responsive">
        <table class="table table-bordered">
            <tr>
                <th>Produkt</th>
                <th>Pris</th>
                <th>Kategori</th>
                <th>Antal (Stock)</th>
                <th>Skapad</th>
                <th>Ändra</th>
            </tr>
            <?php foreach ($listProducts as $products) : ?>
                <?php
                $category->setId($products->category_id);
                $category->getCategory();
                $product->setId($products->id);
                $product->stock();
                ?>
                <tr>
                    <td><?= $products->name ?></td>
                    <td><?= $products->price ?></td>
                    <td><?= $category->getName() ?></td>
                    <td><?= $product->getStock() ?></td>
                    <td><?= $products->created_at ?></td>
                    <td><a class="btn btn-primary" href="edit_product.php?id=<?= $products->id ?>"><i
                                class="glyphicon glyphicon-edit"></i> Ändra</a> <a class="btn btn-info"
                                                                                   href="product.php?id=<?= $products->id ?>"><i
                                class="glyphicon glyphicon-new-window"></i> Visa</a></td>

                </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="pagination">
            <?php if ($page > 1) : ?>
                <li>
                    <a href='<?= $page_url ?>' title='Go to the first page.'>
                        First Page
                    </a>
                </li>
            <?php endif; ?>
            <?php for ($i = $initial_num; $i < $condition_limit_num; $i++) : ?>
                <?php if (($i > 0) && ($i <= $total_pages)) : ?>
                    <?php if ($i == $page) : ?>
                        <li class='active'><a href="#"><?= $i ?></a></li>
                    <?php else : ?>
                        <li><a href='<?= $page_url ?>?page=<?= $i ?>'><?= $i ?></a></li>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endfor; ?>
            <?php if ($page < $total_pages) : ?>
                <li><a href='<?= $page_url ?>?page=<?= $total_pages ?>' title='Last page is <?= $total_pages ?>.'>Last
                        Page</a></li>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php include_once 'views/footer.php'; ?>
