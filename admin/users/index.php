<?php
require "../../lib/User.php";
require "../../lib/dbh.php";

$user = new User($dbh);

include "../../html-includes/head.php";
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
                        echo "<li class=nav-item'><a class='nav-link' href='/'>Home</a></li>";
                        echo "<li class=nav-item'><a class='nav-link' href='/admin'>Admin</a></li>";
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

<?php

$users = $user->fetchAll(100, 'DESC');



?>

<div class="container mt-5">
    <div class="row">
        <div class="col-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Email</th>
                    <th scope="col">Role</th>
                    <th scope="col">Created</th>
                </tr>
                </thead>
                <tbody>
                <?php foreach ($users as $user) {
                    echo"<tr>
                    <th scope='row'>{$user['id']}</th>
                    <td>{$user['email']}</td>
                    <td>Admin</td>
                    <td>{$user['created']}</td>
                </tr>";
                } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>


<?php include "../../html-includes/footer.php"; ?>