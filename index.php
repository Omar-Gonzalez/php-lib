<?php
require 'lib/dbh.php';
require 'models/User.php';

$user = new User($dbh);

?>

<?php include "html-includes/head.php"; ?>
<?php include "html-includes/navbar-top.php"; ?>

<?php
if ($user->is_auth()) {
    echo "<li class=nav-item'><a class='nav-link active' aria-current='page' href='#'>Welcome back {$user->email()}</a></li>";
    echo "<li class=nav-item'><a class='nav-link' href='admin'>Admin</a></li>";
    echo "<li class=nav-item'><a class='nav-link' href='/admin/logout.php'>Logout</a></li>";
} else {
    echo "<li class=nav-item'><a class='nav-link active' aria-current='page' href='#'>Welcome back</a></li>";
    echo "<li class=nav-item'><a class='nav-link' href='admin'>Login</a></li>";
}
?>
<?php include "html-includes/navbar-bottom.php"; ?>

<?php include "html-includes/footer.php"; ?>