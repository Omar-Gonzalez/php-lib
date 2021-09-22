<?php
require 'lib/dbh.php';
require 'lib/User.php';

$user = new User($dbh);
var_dump($user->is_auth());