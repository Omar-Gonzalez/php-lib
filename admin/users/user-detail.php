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

if($result['result']){
    $usr = $result['user'];
}else{
    $usr['email'] = 'Usuario';
}


include '../../html-includes/head.php';
?>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <?php
                    if ($user->is_auth()) {
                        echo "<li class=nav-item'><a class='nav-link active' aria-current='page' href='#'>Welcome back {$user->email()}</a></li>";
                        echo "<li class=nav-item'><a class='nav-link' href='/'>Inicio</a></li>";
                        echo "<li class=nav-item'><a class='nav-link' href='/admin'>Admin</a></li>";
                        echo "<li class=nav-item'><a class='nav-link' href='/admin/users'>Usuarios</a></li>";
                        echo "<li class=nav-item'><a class='nav-link disabled' href='#'>{$usr['email']}</a></li>";
                        echo "<li class=nav-item'><a class='nav-link' href='/admin/logout.php'>Logout</a></li>";
                    } else {
                        echo "<li class=nav-item'><a class='nav-link active' aria-current='page' href='#'>Welcome back</a></li>";
                        echo "<li class=nav-item'><a class='nav-link' href='/'>Home</a></li>";
                    }
                    ?>
                </ul>
            </div>
        </div>
    </nav>


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
                <a href="update-user.php" type="button" class="btn btn-primary">Actualiza usuario</a>
                <a href="/admin/users/delete-user.php/?user=<?php echo $usr['id'] ?>" type="button" class="btn btn-danger">Elimina usuario</a>
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