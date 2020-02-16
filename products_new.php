<?php
require 'config/init.php';

$manufacturersDB = new Manufacturer();
$manufacturers = $manufacturersDB->getAll('name', 'asc');

//de verificat toate campurile care sunt obligatorii
if (!empty($_POST['name']) && (!empty($_POST['description'])) && (!empty($_POST['price']))) {
  $productDb = new Product();
  $productDb->create($_POST['manufacturer_id'], $_POST['name'], $_POST['description'], $_POST['price'], $_POST['price_special']);
  header('Location: products.php');
}

require 'views/head.php';
require 'views/menu.php';
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Lista produse</h1>
  </div>
  <form method="POST">
    <div class="form-group">
      <label>Producator</label>
      <select type="text" name="manufacturer_id" class="form-control">

        <?php foreach ($manufacturers as $manufacturer) : ?>
          <option value="<?= $manufacturer['id'] ?>">
            <?= $manufacturer['name'] ?>
          </option>
        <?php endforeach; ?>

      </select>
    </div>
    <div class="form-group">
      <label>Nume produs</label>
      <input type="text" name="name" class="form-control">
    </div>
    <div class="form-group">
      <label>Pret</label>
      <input type="text" name="price" class="form-control">
    </div>
    <div class="form-group">
      <label>Pret redus</label>
      <input type="text" name="price_special" class="form-control">
    </div>
    <div class="form-group">
      <label>Descriere</label>
      <textarea class="form-control" name="description"></textarea>
    </div>
    <input type="submit" value="Salveaza" class="btn btn-primary">
  </form>
</main>