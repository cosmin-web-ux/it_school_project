<?php
require 'config/init.php';

$productDB = new Product();
$products = $productDB->getAll('id', 'desc');

require 'views/head.php';
require 'views/menu.php';
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Lista produse</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
        <a href="products_new.php">
          <button type="button" class="btn btn-sm btn-outline-success">Adauga produs nou</button></a>
      </div>
    </div>
  </div>
  <table class="table table-striped">
    <thead>
      <tr>
        <th>ID</th>
        <th>Nume produs</th>
        <th>Pret</th>
        <th>Actiuni</th>
      </tr>
    </thead>
    <tbody>

      <?php foreach ($products as $product) : ?>
        <tr>
          <td><?= $product['id'] ?></td>
          <td><?= $product['name'] ?></td>
          <td><?= $product['price'] ?> lei</td>
          <td>
            <div class="btn-group">
              <a href="products_edit.php?id=<?= $product['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
              <a href="products_delete.php?id=<?= $product['id'] ?>" class="btn btn-danger btn-sm">Sterge</a>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>

    </tbody>
  </table>
</main>

<?php
require 'views/footer.php';
?>