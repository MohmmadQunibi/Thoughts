<?php require APPROOT . "/views/inc/header.php"?>
<div class="row">
    <div class="col-md-6 mx-auto">
        <div class="card card-body bg-light mt-5">
            <?php flash("register_success"); ?>
            <h2>Login</h2>
            <p>Please fill the form</p>
            <form action="<?php echo URLROOT; ?>/users/login" method="post">
                <div class="form-group mt-15">
                    <label for="email">Email: <sup style="color: red;">*</sup></label>
                    <input type="text" name="email" class="form-control form-control-lg <?php echo (!empty($data["email_error"])) ? "is-invalid" : "" ; ?>" value="<?php echo $data["email"]; ?>">
                    <span class="invalid-feedback">
                        <?php echo $data["email_error"] ?>
                    </span>
                </div>
                <div class="form-group mt-15">
                    <label for="password">Password: <sup style="color: red;">*</sup></label>
                    <input type="password" name="password" class="form-control form-control-lg <?php echo (!empty($data["password_error"])) ? "is-invalid" : ""; ?>" value="<?php echo $data["password"]; ?>">
                    <span class="invalid-feedback">
                        <?php echo $data["password_error"] ?>
                    </span>
                </div>
                <br>
                <div class="row">
                    <div class="col">
                        <input type="submit" value="Login" class="btn btn-success btn-block" style="width: 100%;">
                    </div>
                    <div class="col">
                        <a href="<?php echo URLROOT; ?>/users/register" class="btn btn-light btn-block" style="width: 100%;">Don't have an account? Register</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<?php require APPROOT . "/views/inc/footer.php"?>