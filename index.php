<?php
include_once 'class/user.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$error_message = $user->login();

$message= '';
if(isset($_GET['status'])) {
    if($_GET['status'] == 1) {
        $message = "User was registered successfully!";
    }
}
if($user->loggedIn()) {
    if($_SESSION["user_role"] == 'admin' || $_SESSION["user_role"] == 'pm') {
        header("Location: project.php");
    }
    else if($_SESSION["user_role"] == 'dev') {
        header("Location: task.php");
    }
}
if($user->login()) {
    if(isset($_SESSION["user_role"]) && $_SESSION["user_role"] == 'admin' || isset($_SESSION["user_role"]) && $_SESSION["user_role"] == 'pm') {
        header("Location: project.php");
    }
    else if(isset($_SESSION["user_role"]) && $_SESSION["user_role"] == "dev") {
        header("Location: task.php");
    }
}
include './includes/header.php'
?>
<div class="error-wrapper">
    <?php if ($message != '') { ?>
        <div class="success-message"><?php echo $message; ?></div>
    <?php } ?>
    <?php if ($error_message != '') { ?>
        <div class="error-message"><?php echo $error_message; ?></div>
    <?php } ?>
</div>
<div class="form-wrapper">
    <div>
        <h1 class="login_heading">Log in</h1>
    </div>
    <form class="login_form" method="post" id="login_form" autocomplete="off">
        <div>
            <label for="email" class="email"> Email:</label>
            <input id="email" name="email" type="email" />
            <span id="name_error" class="error"></span>
        </div>
        <div>
            <label for="password" class="password">Password: </label>
            <input id="password" name="password" type="password"  />
            <span id="name_error" class="error"></span>
        </div>
        <div >
            <input type="submit" name="login" value="Login" class="button" name="login" id="submit"/>
        </div>
        <div class="register-link">
            Not a user yet ?
            <a href="register.php" class="to_register" id="register">
            Sign Up
            </a>
        </div>
    </form>
</div>
<script src="./assets/js/libraries/jquery.validate.js"></script>
<script src="./assets/js/login.js"></script>
<?php include './includes/footer.php' ?>
