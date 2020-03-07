<?php
require 'config/init.php';

if (!empty($_POST['name'])) {
  $categoriesDb = new Category();
  $categoriesDb->create($_POST['name']);
  header("Location: categories.php");
}

require_once 'views/head.php';
require_once 'views/menu.php';
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Adauga categorie noua</h1>
  </div>


  <form method="post">
    <div class="form-group">
      <div class="form-group">
        <label>Nume categorie</label>
        <input type="text" name="name" class="form-control" />
      </div>
      <input type="submit" value="Salveaza" class="btn btn-primary" />
    </div>
  </form>

</main>

<?php
require_once 'views/footer.php';
?>