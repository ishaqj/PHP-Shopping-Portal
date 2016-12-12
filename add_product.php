<?php
include_once 'config.php';
$cart = new Cart($db);
include_once 'views/header.php';
/**
 * Created by PhpStorm.
 * User: Ishaq17
 * Date: 2016-10-13
 * Time: 01:36
 */
$category = new Category($db);
$nameErr = $imageErr = $category_IdErr = $descriptionErr = $priceErr = $stockErr = "";

if (isset($_POST["submit"])) {
    $product = new Products($db);

    if (empty($_POST['name'])) {
        $nameErr = "Required.";
    } else {
        $product->setName($_POST['name']);
    }

    if (empty($_POST['image'])) {
        $imageErr = "Required.";
    } else {
        $product->setImages($_POST['image']);
    }

    if (empty($_POST['description'])) {
        $descriptionErr = "Required.";
    } else {
        $product->setDescription($_POST['description']);
    }

    if (empty($_POST['price'])) {
        $priceErr = "Required.";
    } else {
        $product->setPrice($_POST['price']);
    }

    if (empty($_POST['stock'])) {
        $stockErr = "Required.";
    } else {
        $product->setStock($_POST['stock']);
    }

    $product->setCategoryId($_POST['category_id']);
    $product->getTimestamp();

    if (!empty($_POST['name']) && !empty($_POST['image']) && !empty($_POST['description']) && !empty($_POST['price']) && !empty($_POST['stock'])) {
        $product->create();
        header('Location: admin.php');
    }

}
?>
    <div class="page-header">
        <h1>Lägg till Produkt</h1>
    </div>
    <form action="" method='post'>

        <table class='table table-hover table-responsive table-bordered'>

            <tr>
                <td>Name</td>
                <td><input type='text' name='name' class='form-control'/>
                    <span class="text-danger">* <?= $nameErr ?></span>
                </td>
            </tr>

            <tr id="firstImg">
                <td>Image</td>
                <td><input type='text' name='image[]' class='form-control'/>
                    <span class="text-danger">* <?= $imageErr ?></span>
                </td>
                <td>
                    <button class="btn-primary btn-md" id="add"><i class="glyphicon glyphicon-plus-sign"></i></button>
                </td>
            </tr>

            <tr>
                <td>Price</td>
                <td><input type='text' name='price' class='form-control'/>
                    <span class="text-danger">* <?= $priceErr ?></span>
                </td>
            </tr>

            <tr>
                <td>Description</td>
                <td><textarea rows="15" cols="50" name='description' class='form-control'></textarea>
                    <span class="text-danger">* <?= $descriptionErr ?></span>
                </td>
            </tr>
            <tr>
                <td>Stock</td>
                <td><input type='number' name='stock' class='form-control'/>
                    <span class="text-danger">* <?= $stockErr ?></span>
                </td>
            </tr>
            <tr>
                <td>Category</td>
                <td>
                    <?php
                    $categories = $category->getAllCategories();
                    echo "<select class='form-control' name='category_id'>";
                    foreach ($categories as $category) {
                        echo "
                        <option value='{$category->id}'>$category->cat_name</option>";
                    }
                    echo "</select>";
                    ?>
                </td>
            </tr>

            <tr>
                <td></td>
                <td>
                    <button name="submit" type="submit" class="btn btn-primary">Create</button>
                </td>
            </tr>

        </table>
    </form>

<?php
include_once 'views/footer.php';