<?php
require 'config/init.php';

if (!Auth::checkLogin()) {
  header('Location: login.php');
}

$manufacturersDb = new Manufacturer();
$manufacturers = $manufacturersDb->getAll('name', 'asc');

if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['price']) && !empty($_POST['price_special']) && !empty($_POST['manufacturer_id'])) {
  $productDb = new Product();
  $productDb->create($_POST['manufacturer_id'], $_POST['name'], $_POST['description'], $_POST['price'], $_POST['price_special']);
  header("location: products.php");
}

require_once 'views/head.php';
require_once 'views/menu.php';
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Adauga produs nou</h1>
  </div>


  <form method="post">
    <div class="form-group">
      <label>Producator</label>
      <select name="manufacturer_id" class="form-control">
        <?php foreach ($manufacturers as $manufacturer) : ?>
          <option value="<?= $manufacturer['id'] ?>"> <?= $manufacturer['name'] ?></option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="form-group">
      <label>Nume produs</label>
      <input type="text" name="name" class="form-control" />
    </div>
    <div class="form-group">
      <label>Pret</label>
      <input type="text" name="price" class="form-control" />
    </div>
    <div class="form-group">
      <label>Pret redus</label>
      <input type="text" name="price_special" class="form-control" />
    </div>
    <div class="form-group">
      <label>Descriere</label>
      <textarea class="form-control" name="description"></textarea>
    </div>

    <input type="submit" value="Salveaza" class="btn btn-primary" />

  </form>

</main>

<?php
require_once 'views/footer.php';
?>