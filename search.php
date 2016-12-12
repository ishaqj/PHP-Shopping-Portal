<?php
/**
 * Include files
 */
include_once 'config.php';
$cart = new Cart($db);
$q = isset($_GET['q']) ? htmlspecialchars(strip_tags($_GET['q'])) : "";
$page_title = $q;
include_once 'views/header.php';
$page = isset($_GET['page']) ? $_GET['page'] : 1;

/**
 * Instantiate Class
 */

$products = new Products($db);
$products->setName($q);
$products->searchProduct();
$searched_products = $products->getSearchedProducts();
?>
    <div class="row">
    <div class="page-header">
        <h1>Sökresultat för: <?= $q ?></h1>
    </div>
    <div class="message"></div>
<?php if (!empty($searched_products)): ?>
    <?php foreach ($searched_products as $product) : ?>
        <?php extract($product); ?>
        <?= $products->setId($id) ?>
        <div class="col-xs-6 col-sm-6 col-md-3">
            <div class="panel panel-primary">

                <div class="panel-heading"><?= $cat_name ?></div>
                <div class="panel-body"><a href="product.php?id=<?= $id ?>"><img
                            src=<?= $products->fetchImage()->image ?> class="img-responsive" style="width:100%"
                            alt="<?= $name ?>age"></a></div>
                <div class="panel-footer text-center">
                    <p class="title"><a href="product.php?id=<?= $id ?>"><?= $name ?></a></p>
                    <p class="price"><?= $price ?> kr</p>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php else : ?>
    <div class="col-md-12"><p>Din sökning efter <b><?= $q ?></b> gav tyvärr inga träffar.</p></div>
<?php endif; ?>

<?php
include_once 'views/footer.php';