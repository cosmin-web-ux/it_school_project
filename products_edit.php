<?php
require 'config/init.php';

$ip = $_SERVER['REMOTE_ADDR'];

if (empty($_SESSION['auth']) || $_SESSION['ip'] != $ip) {
  header('Location: login.php');
}

if (empty($_GET['id'])) {
  header('Location: products.php');
}

// selectam din baza de date produsul care dorim sa il afisam in formular 
$productDb = new Product();
$currentProduct = $productDb->getById($_GET['id']);

//selectam din baza de date producatorii pentru afisarea lor in <select>
$manufacturersDb = new Manufacturer();
$manufacturers = $manufacturersDb->getAll('name', 'asc');

if (!empty($_POST['name']) && !empty($_POST['description']) && !empty($_POST['price']) && !empty($_POST['price_special']) && !empty($_POST['manufacturer_id'])) {

  $productDb->update($_GET['id'], $_POST['manufacturer_id'], $_POST['name'], $_POST['description'], $_POST['price'], $_POST['price_special']);
  header("Location: products.php");
}

require_once 'views/head.php';
require_once 'views/menu.php';
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Modifica produs</h1>
  </div>


  <?php if ($currentProduct) : ?>

    <form method="post">
      <div class="form-group">
        <label>Producator</label>
        <select name="manufacturer_id" class="form-control">

          <option value="">Alege</option>

          <?php foreach ($manufacturers as $manufacturer) : ?>

            <?php $selectedText = ($manufacturer['id'] == $currentProduct['manufacturer_id']) ?  "selected='selected'" : "";  ?>

            <option value="<?= $manufacturer['id'] ?>" <?= $selectedText ?>> <?= $manufacturer['name'] ?></option>

          <?php endforeach; ?>
        </select>
      </div>
      <div class="form-group">
        <label>Nume produs</label>
        <input type="text" name="name" value="<?= $currentProduct['name'] ?>" class="form-control" />
      </div>
      <div class="form-group">
        <label>Pret</label>
        <input type="text" name="price" value="<?= $currentProduct['price'] ?>" class="form-control" />
      </div>
      <div class="form-group">
        <label>Pret redus</label>
        <input type="text" name="price_special" value="<?= $currentProduct['price_special'] ?>" class="form-control" />
      </div>
      <div class="form-group">
        <label>Descriere</label>
        <textarea class="form-control" name="description"><?= $currentProduct['description'] ?></textarea>
      </div>

      <input type="submit" value="Salveaza" class="btn btn-primary" />

    </form>

  <?php else : ?>

    <div class="alert alert-danger">Produsul nu mai exista</div>
    <script>
      setTimeout(function() {
        window.location.href = 'products.php';
      }, 3000);
    </script>

  <?php endif; ?>

</main>

<?php
require_once 'views/footer.php';
?>