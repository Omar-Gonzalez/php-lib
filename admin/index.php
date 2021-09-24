<?php
require '../lib/dbh.php';
require '../models/User.php';
require '../lib/helpers.php';

$user = new User($dbh);

?>

<?php include "../html-includes/head.php"; ?>
<?php include "../html-includes/navbar-top.php"; ?>

<?php
if ($user->is_auth()) {
    echo "<li class=nav-item'><a class='nav-link active' aria-current='page' href='#'>Welcome back {$user->email()}</a></li>";
    echo "<li class=nav-item'><a class='nav-link' href='/'>Inicio</a></li>";
    echo "<li class=nav-item'><a class='nav-link disabled' href='#'>Admin</a></li>";
    echo "<li class=nav-item'><a class='nav-link' href='/admin/logout.php'>Logout</a></li>";
} else {
    echo "<li class=nav-item'><a class='nav-link active' aria-current='page' href='#'>Welcome back</a></li>";
    echo "<li class=nav-item'><a class='nav-link' href='/'>Home</a></li>";
}
?>
<?php include "../html-includes/navbar-bottom.php"; ?>


<?php if ($user->is_auth()) { ?>

    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="d-grid gap-2">
                            <a type="button" class="btn btn-primary btn-lg" type="button" href="users">Usuarios</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php } else { ?>
    <?php include 'login.php';
} ?>

<?php include "../html-includes/footer.php"; ?>