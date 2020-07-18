<?php
require 'config/init.php';

use Db\Category;
use Helpers\Auth;

if (!Auth::checkLogin()) {
    header('Location: login.php');
}

try {
    $categoryDb = new Category();
    $categories = $categoryDb->getAll('id', 'desc');
} catch (Exception $ex) {
    $errorMessage = "A aparut o eroare: ";
    $errorMessage .= $ex->getMessage();
}

require 'views/head.php';
require 'views/menu.php';
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Lista Categorii</h1>
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="categories_new.php" class="btn btn-sm btn-outline-success">Adauga categorie noua</a>
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
                <th>Nume</th>
                <th>Actiuni</th>
            </tr>
            </thead>

            <tbody>

            <?php foreach ($categories as $category) : ?>
                <tr>
                    <td><?= $category['id'] ?></td>
                    <td><?= $category['name'] ?></td>
                    <td>
                        <div class="btn-group">
                            <a href="categories_edit.php?id=<?= $category['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
                            <a href="categories_delete.php?id=<?= $category['id'] ?>" class="btn btn-danger btn-sm">Delete</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>

            </tbody>

        </table>

    <?php endif; ?>

</main>