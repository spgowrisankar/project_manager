<?php
include_once 'class/user.php';

$database = new Database();
$db = $database->getConnection();
$user = new User($db);

$error = $user->register();

include './includes/header.php';
?>
<div class="error-wrapper">
    <?php if ($error) { ?>
        <div class="error-message"><?php echo $error; ?></div>
    <?php } ?>
</div>
<div class="form-wrapper">
    <div>
        <h1 class="login_heading">Sign Up</h1>
    </div>
    <form class="login_form" action="register.php" id="reg_form" method="post">
        <div>
            <label for="fullname" class="fullname"> Full Name:</label>
            <input id="fullname" name="fullname" type="text" />
            <span id="name_error" class="error"></span>
        </div>
        <div >
            <label for="email" class="email"> Email:</label>
            <input id="email" name="email" type="email" />
            <span id="email_error" class="error"></span>
        </div>
        <div >
            <label for="password" class="password">Password: </label>
            <input id="password" name="password" type="password"  />
            <span id="pwd_error" class="error"></span>
        </div>
        <div >
            <label for="con_password" class="con_password">Confirm Password: </label>
            <input id="con_password" name="con_password" type="password"  />
            <span id="conpwd_error" class="error"></span>
        </div>
        <div>
            <input type="submit" value="Sign Up" class="button" name="register" id="submit" />
        </div>
        <div class="register-link center">
            Already a member?
            <a href="index.php" class="to_register">
                Login
            </a>
        </div>
    </form>
</div>
<script src="./assets/js/libraries/jquery.validate.js"></script>
<script src="./assets/js/register.js"></script>
<?php include './includes/footer.php' ?>
