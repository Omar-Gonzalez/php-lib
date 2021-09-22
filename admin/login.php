<?php
require "../lib/helpers.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    try {
        $user->login($_POST['email'], $_POST['password']);
        redirect("/lib/admin/");
    } catch (Exception $e) {
        echo  "<div class='alert alert-danger text-center' role='alert'>{$e->getMessage()}</div>";
    }
}

?>


<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 col-12">
            <form method="post">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1"
                           aria-describedby="emailHelp" placeholder="Enter email">
                    <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                        else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1"
                           placeholder="Password">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>