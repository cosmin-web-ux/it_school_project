<?php
require 'config/init.php';

use Helpers\Auth;
use Db\Manufacturer;

if (!Auth::checkLogin()) {
  header('Location: login.php');
}

try {
  $manufacturersDB = new Manufacturer();
  $manufacturers = $manufacturersDB->getAll('id', 'desc');
} catch (Exception $ex) {
  $errorMessage = 'A aparut o eroare';
  $errorMessage .= $ex->getMessage();
}

require 'views/head.php';
require 'views/menu.php';
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Lista producatori</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
        <a href="manufacturers_new.php" class="btn btn-sm btn-outline-success">Adauga producator nou</a>
      </div>
    </div>
  </div>

  <table class="table table-striped">

    <thead>
      <tr>
        <th>ID</th>
        <th>Producator</th>
        <th>Actiuni</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($manufacturers as $manufacturer) : ?>
        <tr>
          <td><?= $manufacturer['id'] ?></td>
          <td><?= $manufacturer['name'] ?></td>
          <td>
            <div class="btn-group">
              <a href="manufacturers_edit.php?id=<?= $manufacturer['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
              <a href="manufacturers_delete.php?id=<?= $manufacturer['id'] ?>" class="btn btn-danger btn-sm">Sterge</a>
            </div>
          </td>
        </tr>
      <?php endforeach; ?>
    </tbody>

  </table>

</main>

<?php
require_once 'views/footer.php';
?>