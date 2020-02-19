<?php
require 'config/init.php';

if (!empty($_POST['username']) && ($_POST['password'])) {

  $usersDb = new User();
  $usersDb->create($_POST['username'], $_POST['password']);
  header("location: users.php");
}


require_once 'views/head.php';
require_once 'views/menu.php';
?>

<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Adauga utilizator nou</h1>
  </div>


  <form method="post">
    <div class="form-group">
      <label>Username</label>
      <input type="text" name="username" class="form-control" />
    </div>
    <div class="form-group">
      <label>Password</label>
      <input type="text" name="password" class="form-control" />
    </div>

    <input type="submit" value="Salveaza" class="btn btn-primary" />
  </form>

</main>

<?php
require_once 'views/footer.php';
?>