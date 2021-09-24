<?php
require "../../models/User.php";
require "../../lib/dbh.php";
require "../../lib/helpers.php";

$user = new User($dbh);

if (!$user->is_auth()) {
    redirect('/admin');
}

?>

<?php include "../../html-includes/head.php"; ?>
<?php include "../../html-includes/navbar-top.php"; ?>


    <li class=nav-item'><a class='nav-link active' aria-current='page' href='#'>Welcome
            back <?php echo $user->email() ?></a></li>
    <li class=nav-item'><a class='nav-link' href='/'>Inicio</a></li>
    <li class=nav-item'><a class='nav-link' href='/admin'>Admin</a></li>
    <li class=nav-item'><a class='nav-link disabled' href='#'>Usuarios</a></li>
    <li class=nav-item'><a class='nav-link' href='/admin/logout.php'>Logout</a></li>


<?php include "../../html-includes/navbar-bottom.php"; ?>

<?php $users = $user->fetch_all(100, 'ASC'); ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-6">
                <h2 class="text-dark">Usuarios</h2>
            </div>
            <div class="col-6 text-end">
                <a href="add-user.php" type="button" class="btn btn-primary">Agrega nuevo usuario</a>
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
                    <?php foreach ($users as $user) {
                        echo "<tr>
                                <th scope='row'>{$user['id']}</th>
                                <td><a href='user-detail.php/?user={$user['id']}'>{$user['email']}</a></td>
                                <td>{$user['role']}</td>
                                <td>{$user['created']}</td>
                            </tr>";
                    } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


<?php include "../../html-includes/footer.php"; ?>