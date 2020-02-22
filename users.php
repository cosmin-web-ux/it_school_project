<?php
require 'config/init.php';

$ip = $_SERVER['REMOTE_ADDR'];

if (empty($_SESSION['auth']) || $_SESSION['ip'] != $ip) {
  header('Location: login.php');
}

$usersDb = new User();

$users = $usersDb->getAll('id', 'desc');

require_once 'views/head.php';
require_once 'views/menu.php';
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Lista utilizatori</h1>
    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group mr-2">
        <a href="users_new.php" class="btn btn-sm btn-outline-success">Adauga utilizator nou</a>
      </div>
    </div>
  </div>


  <table class="table table-striped">

    <thead>
      <tr>
        <th>ID</th>
        <th>Username</th>
        <th>Actiuni</th>
      </tr>
    </thead>

    <tbody>
      <?php foreach ($users as $user) : ?>
        <tr>
          <td><?= $user['id'] ?></td>
          <td><?= $user['username'] ?></td>
          <td>
            <div class="btn-group">
              <a href="users_edit.php?id=<?= $user['id'] ?>" class="btn btn-primary btn-sm">Edit</a>
              <a href="users_delete.php?id=<?= $user['id'] ?>" class="btn btn-danger btn-sm">Sterge</a>
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