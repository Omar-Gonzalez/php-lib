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

?>

<?php include '../../html-includes/head.php' ?>
<?php include '../../html-includes/navbar-top.php' ?>


    <li class=nav-item'><a class='nav-link active' aria-current='page' href='#'>Welcome
            back <?php echo $user->email() ?></a></li>
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
        <div class="row">
            <div class="col-6">
                <h2 class="text-dark"><?php echo $usr['email'] ?></h2>
            </div>
            <div class="col-6 text-end">
                <a href="/admin/users/update-user.php?user=<?php echo $usr['id'] ?>" type="button"
                   class="btn btn-primary">Actualiza usuario</a>
                <a href="/admin/users/delete-user.php/?user=<?php echo $usr['id'] ?>" type="button"
                   class="btn btn-danger">Elimina usuario</a>
            </div>
        </div>
        <div class="row mt-1">
            <div class="col-12">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Email</th>
                        <th scope="col">Role</th>
                        <th scope="col">Creado</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <th scope='row'><?php echo $usr['id'] ?></th>
                        <td><?php echo $usr['email'] ?></td>
                        <td><?php echo $usr['role'] ?></td>
                        <td><?php echo $usr['created'] ?></td>
                    </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

<?php } ?>

<?php include '../../html-includes/footer.php' ?>