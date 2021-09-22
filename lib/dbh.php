<?php
require('config.php');

try {
    $dbh = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASSWORD);
    // set the PDO error mode to exception
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    if (DEBUG) {
        echo "<div class='alert alert-danger'><strong>Connection failed: " . $e->getMessage() . "</strong></div>";
    }
}

