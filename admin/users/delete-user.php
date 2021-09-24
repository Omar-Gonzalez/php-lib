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

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $del_result = $user->delete($_POST['user']);
    if($del_result['result']){
        redirect('/admin/users');
    }
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