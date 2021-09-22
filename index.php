<?php
require 'lib/dbh.php';
require 'lib/User.php';

$user = new User($dbh);

try {
    $user->login("user@email.com", "SomePassw0rd!");
} catch (Exception $e) {
    echo $e->getMessage();
}


var_dump($user->is_auth());