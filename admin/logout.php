<?php
require '../lib/User.php';
require '../lib/dbh.php';
require '../lib/helpers.php';

$user = new User($dbh);
$user->logout();

redirect('/');