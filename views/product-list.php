<?php

// Display all products
if (!empty($showAllProducts)) : ?>
    <div class="row">
        <div class="message"></div>
        <?php foreach ($showAllProducts as $k => $product) : ?>
            <?= $category->setId($product->category_id) ?>
            <?= $category->getCategory(); ?>
            <?= $products->setId($product->id); ?>
            <div class="col-xs-6 col-sm-6 col-md-3">
                <?php if ($product->category_id == 1) : ?>
                    <div class="computer">
                        <?= $category->getName() ?>
                    </div>
                <?php else : ?>
                    <div class="tv">
                        <?= $category->getName() ?>
                    </div>
                <?php endif; ?>
                <div id="product">
                    <div class="photo"><img src="<?= $products->fetchImage()->image ?>" class="img-responsive"
                                            alt="<?= $product->name ?>"></div>
                    <div class="text-center">
                        <p class="title"><a href="product.php?id=<?= $product->id ?>"><?= $product->name ?></a></p>
                        <p class="price"><?= $product->price ?> kr</p>
                        <a class='buy btn btn-primary btn-lg' href='cart_add_product.php?id=<?= $product->id ?>'>Köp</a>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

        <!-- display paging-->
        <?php
        $total_pages = ceil($total_rows / $records_per_page);

        // range of links to show
        $range = 2;

        // display links to 'range of pages' around 'current page'
        $initial_num = $page - $range;
        $condition_limit_num = ($page + $range) + 1;
        ?>
        <div class="col-md-12">
            <ul class="pagination">
                <?php if ($page > 1) : ?>
                    <?php if (!empty($category_id)) : ?>
                        <li><a href='<?= $page_url ?>?id=<?= $category_id ?>?page=1' title='Gå till första sidan.'>
                                Första sidan
                            </a></li>
                    <?php else: ?>
                        <li><a href='<?= $page_url ?>' title='Gå till första sidan.'>
                                Förstan
                            </a></li>
                    <?php endif; ?>
                <?php endif; ?>
                <?php for ($x = $initial_num; $x < $condition_limit_num; $x++) : ?>
                    <?php if (($x > 0) && ($x <= $total_pages)) : ?>
                        <?php if ($x == $page) : ?>
                            <li class='active'><a href="#"><?= $x ?></a></li>
                        <?php else : ?>
                            <?php if (isset($category_id) && !empty($category_id)) : ?>
                                <li><a href='<?= $page_url ?>?id=<?= $category_id ?>&page=<?= $x ?>'><?= $x ?></a></li>
                            <?php else: ?>
                                <li><a href='<?= $page_url ?>?page=<?= $x ?>'><?= $x ?></a></li>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endif; ?>
                <?php endfor; ?>
                <?php if ($page < $total_pages) : ?>
                    <?php if (isset($category_id) && !empty($category_id)) : ?>
                        <li><a href='<?= $page_url ?>?id=<?= $category_id ?>&page=<?= $total_pages ?>'
                               title='Last page is <?= $total_pages ?>.'>Sista sidan</a></li>
                    <?php else: ?>
                        <li><a href='<?= $page_url ?>?page=<?= $total_pages ?>'
                               title='sista sidan är <?= $total_pages ?>.'>Sista sidan</a></li>
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
        </div>
    </div>

<?php else: ?>
    <h2>Databasen är tom och innehåller inga produkter.</h2>
<?php endif; ?>
