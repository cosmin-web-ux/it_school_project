<?php

require 'config/init.php';

if (!Auth::checkLogin()) {
  header('Location: login.php');
}

if (empty($_GET['id'])) {
  header('Location: categories.php');
}

$categoryDb = new Category();
$currentCategory = $categoryDb->getById($_GET['id']);

if (!empty($_POST['name'])) {
  $categoryDb->update($_GET['id'], $_POST['name']);
  header('Location: categories.php');
}

require_once 'views/head.php';
require_once 'views/menu.php';
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Modifica categoria</h1>
  </div>

  <?php if ($currentCategory) : ?>

    <form method="post">
      <div class="form-group">
        <label>Nume categorie</label>
        <input type="text" name="name" value="<?= $currentCategory['name'] ?>" class="form-control" />
      </div>

      <input type="submit" value="Salveaza" class="btn btn-primary" />
    </form>

  <?php else : ?>

    <div class="alert alert-danger">Categoria nu mai exista</div>
    <script>
      setTimeout(function() {
        window.location.href = 'categories.php';
      }, 3000);
    </script>

  <?php endif; ?>

</main>

<?php
require_once 'views/footer.php';
?>