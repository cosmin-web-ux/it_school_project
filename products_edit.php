<?php
require 'config/init.php';

use Helpers\Auth;
use Helpers\File;
use Db\Product;
use Db\Manufacturer;
use Db\Category;

if (!Auth::checkLogin()) {
    header('Location: login.php');
}

if (empty($_GET['id'])) {
    header('Location: products.php');
}

// selectam din baza de date produsul pe care dorim sa il afisam in formular
$productDb = new Product();
$currentProduct = $productDb->getById($_GET['id']);

//extragem toate pozele
$photos = $productDb->getPhotos($currentProduct['id']);

//extragem toate categoriile de la produsul curent
$productCategories = $productDb->getCategoryIds($currentProduct['id']);


//selectam din baza de date producatorii pentru afisarea lor in <select>
$manufacturersDb = new Manufacturer();
$manufacturers = $manufacturersDb->getAll('name', 'asc');

//selectam categoriile din baza de date
$categoryDb = new Category();
$categories = $categoryDb->getAll('name', 'asc');


//trimitere de formular si salvare in baza de date
if (!empty($_POST['name']) && !empty($_POST['manufacturer_id']) && !empty($_POST['description']) && !empty($_POST['price']) && !empty($_POST['price_special'])) {

    if (!empty($_FILES['photo']['name'])) {

        $fileName = File::getNextFilename('media/products/', $_FILES['photo']['name']);

        if (move_uploaded_file($_FILES['photo']['tmp_name'], "media/products/" . $fileName)) {
            $productDb->addPhoto($currentProduct['id'], $fileName);
        }
    }

    $productDb->removeCategories($currentProduct['id']); // sterge toate categoriile
    if (!empty($_POST['category_id'])) {
        foreach ($_POST['category_id'] as $categoryId) {
            $productDb->addCategory($categoryId, $currentProduct['id']);
        }
    }

    $productDb->update($_GET['id'], $_POST['manufacturer_id'], $_POST['name'], $_POST['description'], $_POST['price'], $_POST['price_special']);

    header('Location: products_edit.php?id=' . $currentProduct['id']);
}

require 'views/head.php';
require 'views/menu.php';
?>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Adauga produs nou</h1>
        </div>

        <?php if ($currentProduct) : ?>

            <form method="post" enctype="multipart/form-data">

                <div class="form-group">
                    <label>Producator</label>
                    <select name="manufacturer_id" class="form-control">
                        <option value="">Alege</option>

                        <?php foreach ($manufacturers as $manufacturer) : ?>

                            <?php $selectedText = ($manufacturer['id'] == $currentProduct['manufacturer_id']) ? "selected='selected'" : ""; ?>

                            <option value="<?= $manufacturer['id'] ?>" <?= $selectedText ?>>
                                <?= $manufacturer['name'] ?>
                            </option>

                        <?php endforeach; ?>

                    </select>
                </div>

                <div class="form-group">
                    <label>Nume produs</label>
                    <input type="text" name="name" value="<?= $currentProduct['name'] ?>" class="form-control"/>
                </div>

                <div class="form-group">
                    <label>Pret</label>
                    <input type="text" name="price" value="<?= $currentProduct['price'] ?>" class="form-control"/>
                </div>

                <div class="form-group">
                    <label>Pret redus</label>
                    <input type="text" name="price_special" value="<?= $currentProduct['price_special'] ?>" class="form-control"/>
                </div>

                <div class="form-group">
                    <label>Descriere</label>
                    <textarea class="form-control" name="description"><?= $currentProduct['description'] ?></textarea>
                </div>

                <div class="form-group">
                    <label>Photo</label><br/>
                    <input type="file" name="photo"/>
                </div>

                <h4 class="mt-5">Categories</h4>
                <?php foreach ($categories as $category) : ?>
                    <div>
                        <label>
                            <input type="checkbox" <?= (in_array($category['id'], $productCategories)) ? "checked" : ""; ?> name="category_id[]" value="<?= $category['id'] ?>">
                            <?= $category['name'] ?>
                        </label>
                    </div>
                <?php endforeach; ?>

                <input type="submit" value="Salveaza" class="btn btn-primary"/>

            </form>

            <h4 class="mt-5">Poze</h4>

            <table class="table table-striped">
                <?php foreach ($photos as $photo) : ?>

                    <?php
                    // best practice
                    // $class = ($currentProduct['product_photo_id'] == $photo['id']) ? "table-info" : "";
                    ?>

                    <?php if ($currentProduct['product_photo_id'] == $photo['id']) : ?>
                        <tr class="table-info">
                    <?php else : ?>
                        <tr>
                    <?php endif; ?>
                    <td width="1%">
                        <img src="media/products/<?= $photo['filename'] ?>" style="width:100px;"/>
                    </td>
                    <td>
                        <div class="btn-group">
                            <a class="btn btn-danger btn-sm" href="products_delete_photo.php?id=<?= $photo['id'] ?>">sterge</a>

                            <?php if ($currentProduct['product_photo_id'] != $photo['id']) : ?>
                                <a class="btn btn-primary btn-sm" href="products_set_photo.php?id=<?= $photo['id'] ?>&product_id=<?= $currentProduct['id'] ?>">seteaza</a>
                            <?php endif; ?>
                        </div>
                    </td>
                    </tr>
                <?php endforeach; ?>
            </table>


        <?php else : ?>

            <div class="alert alert-danger">Produsul nu mai exista</div>
            <script>
                setTimeout(function () {
                    window.location.href = 'products.php';
                }, 3000);
            </script>

        <?php endif; ?>

    </main>

<?php
require 'views/footer.php';
?>