<?php
require 'config/init.php';

use Helpers\Auth;
use Db\Manufacturer;

if (!Auth::checkLogin()) {
    header('Location: login.php');
}

if (!empty($_POST['name'])) {
    $manufacturerDb = new Manufacturer();
    $manufacturerDb->create($_POST['name']);
    header('Location: manufacturers.php');
}

require_once 'views/head.php';
require_once 'views/menu.php';
?>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2">Adauga producator</h1>
        </div>


        <form method="post">
            <div class="form-group">
                <label>Nume producator</label>
                <input type="text" name="name" class="form-control"/>
            </div>
            <input type="submit" value="Salveaza" class="btn btn-primary"/>

        </form>

    </main>

<?php
require_once 'views/footer.php';
?>