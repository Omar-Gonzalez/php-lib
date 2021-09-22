<?php
require 'lib/dbh.php';
require 'lib/User.php';

$user = new User($dbh);
?>

<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
    <title><?php echo APP_NAME ?></title>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php
                if ($user->is_auth()) {
                    echo "<li class=nav-item'><a class='nav-link active' aria-current='page' href='#'>Welcome back {$user->email()}</a></li>";
                    echo "<li class=nav-item'><a class='nav-link' href='admin'>Admin</a></li>";
                    echo "<li class=nav-item'><a class='nav-link' href='admin/logout.php'>Logout</a></li>";
                } else {
                    echo "<li class=nav-item'><a class='nav-link active' aria-current='page' href='#'>Welcome back</a></li>";
                    echo "<li class=nav-item'><a class='nav-link' href='admin'>Login</a></li>";
                }
                ?>
            </ul>
        </div>
    </div>
</nav>

<!-- Bootstrap 5 JS bunddle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
        crossorigin="anonymous"></script>
</body>
</html>
