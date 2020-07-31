<?php
session_start();
if(isset($_SESSION['error'])) {
    $error = $_SESSION['error'];
    unset($_SESSION['error']);
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://kit.fontawesome.com/ad25b37544.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="flex col-2 row" id="form">
        <form action="validation.php" method = "POST">
            <div class="left col">
                <div class="col-spacer">
                    <div class="form-header"><i class="fas fa-lock icon txtglow"></i><span>Login Form</span></div>
                </div>
                <div class="input-wrap">
                    <div class="input-icon">
                        <div class="icon"><i class="fas fa-user"></i></div>
                        <input value="<?php if(isset($_COOKIE['usernamecookie'])) { echo $_COOKIE['usernamecookie']; } ?>" id="username" name="username" type="text" placeholder="Username or Email"/>
                    </div>
                </div>
                <div class="input-wrap">
                    <div class="input-icon">
                        <div class="icon"><i class="fas fa-key"></i></div>
                        <input value="<?php if(isset($_COOKIE['passwordcookie'])) { echo $_COOKIE['passwordcookie']; } ?>" id="password" name="password" type="password" placeholder="Password"/>
                    </div>
                </div>
                <div>
                    <p><?php if (isset($error)) echo $error; ?></p>
                </div>
                <div class="cb-wrap">
                    <input class="glow" id="remember" type="checkbox" name="rememberme"/>
                    <label for="remember">Remember me</label>
                </div>
                <div class="flex space mt-5">
                    <button id="signup_btn" class="primary big" >SIGN-UP NOW</button>
                    <button id="signin" type="submit" name="signin" class="primary big" >SIGN-IN NOW</button>
                </div>
            </div>
        </form>
    </div>

    <script src="js/login.js"></script>
</body>
</html>