<?php
require "../../models/User.php";
require "../../lib/dbh.php";
require "../../lib/helpers.php";

$user = new User($dbh);

if (!$user->is_auth()) {
    redirect('/admin');
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_result = ["class" => "", "msg" => ""];
    if ($_POST['password'] == $_POST['password-2']) {
        $result = $user->register($_POST['email'], $_POST['password'], $_POST['role']);
        if ($result['result']) {
            $post_result["msg"] = $result["msg"];
            $post_result["class"] = "alert-success";
        } else {
            $post_result["msg"] = $result["msg"];
            $post_result["class"] = "alert-danger";
        }
    } else {
        $post_result["msg"] = "Ambos passwords deben coincidir, por favor intenta de nuevo";
        $post_result["class"] = "alert-danger";
    }
}
?>

<?php include "../../html-includes/head.php"; ?>
<?php include "../../html-includes/navbar-top.php"; ?>

<li class=nav-item'><a class='nav-link active' aria-current='page' href='#'>Welcome back <?php $user->email() ?></a></li>
<li class=nav-item'><a class='nav-link' href='/'>Inicio</a></li>
<li class=nav-item'><a class='nav-link' href='/admin'>Admin</a></li>
<li class=nav-item'><a class='nav-link' href='/admin/users'>Usuarios</a></li>
<li class=nav-item'><a class='nav-link disabled' href='#'>Agrega usuario</a></li>
<li class=nav-item'><a class='nav-link' href='/admin/logout.php'>Logout</a></li>

<?php include "../../html-includes/navbar-bottom.php"; ?>

<?php if (isset($post_result)) { ?>
    <div class="container-fluid mt-3">
        <div class="row justify-content-center">
            <div class="col-10 col-md-6">
                <div class="alert <?php echo $post_result["class"] ?> text-center"><?php echo $post_result["msg"] ?></div>
            </div>
        </div>
    </div>
<?php } ?>

<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 col-12">
            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input name="email" type="email" class="form-control" aria-describedby="emailHelp" minlength="6"
                           maxlength="35" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Selecciona un rol para la cuenta</label>
                    <select name="role" class="form-select" aria-label="Default select example">
                        <option value="USUARIO" selected>Usuario</option>
                        <option value="ADMIN">Admin</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" minlength="6" maxlength="35" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Verifica Password</label>
                    <input name="password-2" type="password" class="form-control" minlength="6" maxlength="35" required>
                </div>
                <button type="submit" class="btn btn-primary">Agrega</button>
            </form>
        </div>
    </div>
</div>

<?php include "../../html-includes/footer.php"; ?>
