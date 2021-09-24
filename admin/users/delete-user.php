<?php
require '../../lib/dbh.php';
require '../../lib/helpers.php';
require '../../models/User.php';

$user = new User($dbh);

if (!$user->is_auth()) {
    redirect('/');
}
$result = $user->fetch($_GET['user'] ?? 0);
$usr = [];

if ($result['result']) {
    $usr = $result['user'];
} else {
    $usr['email'] = 'Usuario';
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $del_result = $user->delete($_POST['user']);
    if ($del_result['result']) {
        redirect('/admin/users');
    }
}
?>

<?php include '../../html-includes/head.php' ?>
<?php include '../../html-includes/navbar-top.php' ?>

    <li class=nav-item'><a class='nav-link active' aria-current='page' href='#'>Welcome
            back <?php echo $user->email(); ?></a></li>
    <li class=nav-item'><a class='nav-link' href='/'>Inicio</a></li>
    <li class=nav-item'><a class='nav-link' href='/admin'>Admin</a></li>
    <li class=nav-item'><a class='nav-link' href='/admin/users'>Usuarios</a></li>
    <li class=nav-item'><a class='nav-link disabled' href='#'><?php $usr['email'] ?></a></li>
    <li class=nav-item'><a class='nav-link' href='/admin/logout.php'>Logout</a></li>

<?php include '../../html-includes/navbar-bottom.php' ?>


<?php if (!$result['result']) { ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-6">
                <div class="alert alert-danger text-center">
                    <?php echo $result['msg'] ?>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-12 col-lg-6 col-md-8">
                <div class="alert alert-danger text-center">
                    <h3>¿Estas seguro que quieres borrar el usuario <b><?php echo $usr['email']; ?></b>?</h3>
                    <h4>Esta acción no se puede revertir</h4>
                </div>
                <form method="post">
                    <input type="hidden" name="user" value="<?php echo $usr['id'] ?>">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-danger btn-lg">Borra usuario</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<?php } ?>

<?php include '../../html-includes/footer.php' ?>