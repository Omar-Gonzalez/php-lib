<?php
require '../lib/dbh.php';
require '../lib/User.php';

$user = new User($dbh);

include "../html-includes/head.php";
?>


<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <?php
                if ($user->is_auth()) {
                    echo "<li class=nav-item'><a class='nav-link active' aria-current='page' href='#'>Welcome back {$user->email()}</a></li>";
                    echo "<li class=nav-item'><a class='nav-link' href='/'>Home</a></li>";
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