<?php
/**
 * Created by PhpStorm.
 * User: Ishaq17
 * Date: 2016-10-10
 * Time: 23:46
 */

if($product != null) : ?>
<div class="row">
    <div class="message"></div>
    <div class="page-header">
        <h1><?=$product->getName()?></h1>
    </div>
    <div class="col-md-6">

        <div id="slides">
        <?php foreach ($product->getImages() as $img) :?>
            <img src="<?= $img->image?>"  alt="<?=$product->getName()?>">

        <?php endforeach; ?>
            <a href="#" class="slidesjs-previous slidesjs-navigation"><i class="icon-chevron-left icon-large"></i></a>
            <a href="#" class="slidesjs-next slidesjs-navigation"><i class="icon-chevron-right icon-large"></i></a>
        </div>
    </div>
    <div class="col-md-6">
        <div class="description">
            <ul>
                <li>Kategori: <?= $category->getName()?></li>
                <li>Releasedatum: <?= date("Y-m-d",strtotime($product->getCreatedAt()))?></li>
            </ul>
            <p><span class="price"><?=$product->getPrice()?> :-</span></p>
            <p><a class="buy btn btn-primary btn-lg" href="add_product.php?id=<?=$product->getId()?>">Lägg i kundvagn</a></p>
            <hr>
            <p><?= htmlspecialchars_decode($product->getDescription()) ?></p>
        </div>
    </div>
</div>

<?php else: ?>
<?php endif; ?>