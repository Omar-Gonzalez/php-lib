<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $result = $user->login($_POST['email'], $_POST['password']);
    if($result['result']){
        redirect('/admin');
    }
}
?>

<div class="container mt-3">
    <div class="row justify-content-center">
        <div class="col-lg-4 col-md-6 col-12">
            <?php if (isset($result)) {
                if (!$result['result']) {
                    echo "<div class='alert alert-danger text-center' role='alert'>{$result['msg']}</div>";
                }
            } ?>
            <form method="post">
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input name="email" type="email" class="form-control" aria-describedby="emailHelp" minlength="6"
                           maxlength="35" required>
                    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" minlength="6" maxlength="35" required>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>