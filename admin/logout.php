<?php
require '../lib/User.php';
require '../lib/helpers.php';

User::logout();
redirect('/');