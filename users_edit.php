<?php

require 'config/init.php';

$ip = $_SERVER['REMOTE_ADDR'];

if (empty($_SESSION['auth']) || $_SESSION['ip'] != $ip) {
  header('Location: login.php');
}

if (empty($_GET['id'])) {
  header('Location: categories.php');
}

$userDb = new User();
$currentUser = $userDb->getById($_GET['id']);

if (!empty($_POST['name'])) {
  $userDb->update($_GET['id'], $_POST['username'], $_POST['password']);
  header('Location: users.php');
}

require_once 'views/head.php';
require_once 'views/menu.php';
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Modifica utilizator</h1>
  </div>
  <form method="post">
    <div class="form-group">
      <label>Username</label>
      <input type="text" name="username" value="<?= $currentUser['username'] ?>" class="form-control" />
    </div>
    <div class="form-group">
      <label>Parola</label>
      <input type="text" name="password" value="<?= $currentUser['password'] ?>" class="form-control" />
    </div>
    <input type="submit" value="Salveaza" class="btn btn-primary" />
  </form>
</main>

<?php
require_once 'views/footer.php';
?>