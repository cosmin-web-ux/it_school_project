<?php

include 'config/init.php';

use Helpers\Auth;

Auth::logout();

header('Location: login.php');
