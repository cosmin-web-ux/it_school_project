<?php

include 'config/init.php';
include 'views/head.php';

use Helpers\Auth;

if (!empty($_POST['username']) && !empty($_POST['password'])) {

  $user = Auth::login($_POST['username'], $_POST['password']);

  if ($user) {
    header('Location: products.php');
  } else {
    $errorMessage = 'User sau parola incorecte!';
  }
}

?>

<div class="wrapper">
  <h1>Autentificare</h1>

  <?php if (isset($errorMessage)) : ?>

    <div class="alert alert-danger">
      <?= $errorMessage ?>
    </div>

  <?php endif; ?>

  <form method='post'>
    <div class="form-group">
      <label>Username</label>
      <input type="text" name="username" class="form-control">
    </div>
    <div class="form-group">
      <label>Parola</label>
      <input type="text" name="password" class="form-control">
    </div>
    <input type="submit" name="Trimite" class="btn btn-primary">
  </form>
</div>

<style>
  .wrapper {
    max-width: 400px;
    padding: 20px;
    margin: 20px auto;
    background: #fff;
    border-radius: 10px;
  }

  body {
    background: #ccc;
  }
</style>