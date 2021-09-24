<?php
require '../../lib/dbh.php';
require '../../lib/helpers.php';
require '../../models/User.php';

$user = new User($dbh);

if (!$user->is_auth()) {
    redirect('/');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $values = ['email' => $_POST['email'], 'role' => $_POST['role'], 'password' => $_POST['password'], 'id' => $_POST['id']];
    $result = $user->update($_POST['id'], $values);
    if ($result['result']) {
        redirect('/admin/users');
    }
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
    <div class="container mt-3">
        <div class="row justify-content-center">
            <div class="col-lg-4 col-md-6 col-12">
                <form method="post">
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input name="email" type="email" class="form-control" aria-describedby="emailHelp" minlength="6"
                               maxlength="35" value="<?php echo $usr['email'] ?>" required>
                        <input type="hidden" name="id" value="<?php echo $usr['id'] ?>">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Selecciona un rol para la cuenta</label>
                        <select name="role" class="form-select" aria-label="Default select example">
                            <option value="USUARIO" selected>Usuario</option>
                            <option value="ADMIN">Admin</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Cambia password o deja en blanco</label>
                        <input name="password" type="password" class="form-control" minlength="6" maxlength="35">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Verifica Password</label>
                        <input name="password-2" type="password" class="form-control" minlength="6" maxlength="35">
                    </div>
                    <button type="submit" class="btn btn-primary">Actualiza</button>
                </form>
            </div>
        </div>
    </div>
<?php } ?>

<?php include '../../html-includes/footer.php' ?>