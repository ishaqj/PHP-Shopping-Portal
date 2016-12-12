<?php
include_once 'config.php';
$cart = new Cart($db);
$product = new Products($db);
/**
 * Created by PhpStorm.
 * User: Ishaq17
 * Date: 2016-10-13
 * Time: 01:36
 */
$category = new Category($db);
$nameErr = $imageErr = $category_IdErr = $descriptionErr = $priceErr = $stockErr = "";
$id = isset($_GET['id']) ? htmlspecialchars(strip_tags($_GET['id'])) : "";

// Get current Product
$product->setId($id);
$product->getProduct();
$page_title = $product->getName();
include_once 'views/header.php';

// Get category of the current product
$category->setId($product->getCategoryId());
$category->getCategory();

// Get stock of the current product
$product->stock();


if(isset($_POST["submit"])) {


    $product->setName($_POST['name']);

    $product->setImages($_POST['image']);
    $product->setImgId($_POST['id']);

    $product->setDescription($_POST['description']);

    $product->setPrice($_POST['price']);

    $product->setStock($_POST['stock']);

    $product->setCategoryId($_POST['category_id']);
    $product->getTimestamp();

    $product->update();
    header('Location: admin.php');
}
?>
<div class="page-header">
    <h1>Ändra - <?=$product->getName()?></h1>
</div>
    <form action="" method='post'>

        <table class='table table-hover table-responsive table-bordered'>

        <tr>
            <td>Name</td>
            <td><input type='text' value="<?=$product->getName()?>" name='name' class='form-control' />
            </td>
        </tr>
        <?php foreach ($product->getImages() as $i => $image) : ?>
        <tr>
            <td>Image <?=$i?></td>
            <td>
                <input type='text' value="<?=$image->image?>" name='image[]' class='form-control' />
                <input type='hidden' value="<?=$image->id?>" name='id[]'>
            </td>
        </tr>
    <?php endforeach; ?>
            
        <tr>
            <td>Price</td>
            <td>
                <input type='text' value="<?=$product->getPrice()?>" name='price' class='form-control' />
            </td>
        </tr>

        <tr>
            <td>Description</td>
            <td><textarea rows="15" cols="50" value="<?=$product->getDescription()?>" name='description' class='form-control'> <?=$product->getDescription()?></textarea>
            </td>
        </tr>
        <tr>
            <td>Stock</td>
            <td>
                <input type='number' name='stock' value="<?=$product->getStock()?>" class='form-control' />
            </td>
        </tr>
        <tr>
            <td>Category</td>
            <td>
                <?php
                $categories = $category->getAllCategories();

                echo "<select class='form-control' name='category_id'>";
                foreach($categories as $cat) {
                    if($category->getId() == $cat->id)
                    {
                        echo "<option value='{$cat->id}' selected>$cat->cat_name</option>";
                    }

                    else {
                        echo "<option value='{$cat->id}'>$cat->cat_name</option>";
                    }

                }
                echo "</select>";
                 ?>
            </td>
        </tr>

        <tr>
            <td></td>
            <td>
                <button name="submit" type="submit" class="btn btn-primary">Update</button>
            </td>
        </tr>

        </table>
    </form>

<?php
include_once 'views/footer.php';

