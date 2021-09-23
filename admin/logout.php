<?php
require '../models/User.php';
require '../lib/helpers.php';

User::logout();
redirect('/');