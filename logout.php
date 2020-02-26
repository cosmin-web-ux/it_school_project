<?php

include 'config/init.php';

Auth::logout();

header('Location: login.php');
