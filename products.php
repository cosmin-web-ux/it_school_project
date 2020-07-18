<?php
require 'config/init.php';

use Helpers\Auth;
use Db\Product;

if (!Auth::checkLogin()) {
    header('Location: login.php');
}

try {
    $productDb = new Product();

    if (!empty($_GET['search'])) {
        $products = $productDb->search($_GET['search']);
    } else {
        $products = $productDb->getAll('id', 'desc');
    }
} catch (Exception $ex) {
    $errorMessage = "A aparut o eroare: ";
    $errorMessage .= $ex->getMessage();

    $errorMessage .= " File: " . $ex->getFile();
    $errorMessage .= " Line: " . $ex->getLine();
}

require 'views/head.php';
require 'views/menu.php';
?>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Lista produse</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <a href="products_new.php" class="btn btn-sm btn-outline-success">Adauga produs nou</a>
                </div>
            </div>
        </div>

        <?php if (isset($errorMessage)) : ?>
            <div class="alert alert-danger"><?= $errorMessage ?></div>
        <?php else : ?>
            <table class="table table-striped">

                <thead>
                <tr>
                    <th>ID</th>
                    <th>Photo</th>
                    <th>Nume produs</th>
                    <th>Producator</th>
                    <th>Pret</th>
                    <th>Actiuni</th>
                </tr>
                </thead>

                <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><?= $product['id'] ?></td>
                        <td>
                            <?php if ($product['filename']) : ?>
                                <img style="max-height: 50px; max-width: 50px;" src="media/products/<?= $product['filename'] ?>">
                            <?php else : ?>
                                -
                            <?php endif; ?>
                        </td>
                        <td><?= $product['name'] ?></td>
                        <td><?= $product['manufacturer_name'] ?></td>
                        <td><?= $product['price'] ?> lei</td>
                        <td>
                            <div class="btn-group">
                                <a href="products_edit.php?id=<?= $product['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                                <a href="products_delete.php?id=<?= $product['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </main>

<?php
require 'views/footer.php';
?>