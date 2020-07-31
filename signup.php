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
    <title>Document</title>
    <link rel="stylesheet" href="css/signup.css">
    <script src="https://kit.fontawesome.com/ad25b37544.js" crossorigin="anonymous"></script>
</head>
<body>
<div style="" class="flex col-2 row" id="form">
    <form action="registration.php" method="POST">
        <div class="left col">
            <div class="col-spacer">
                <div class="form-header"><i class="fas fa-lock icon txtglow"></i><span>signup Form</span></div>
            </div>

            <div class="input-wrap">
                <div class="input-icon">
                    <div class="icon"><i class="fas fa-user"></i></div>
                    <input id="username" name="username" type="text" placeholder="Username"/>
                </div>
            </div>

            <div class="input-wrap">
                <div class="input-icon">
                    <div class="icon"><i class="fas fa-key"></i></div>
                    <input id="password" name="password" type="password" placeholder="Password"/>
                </div>
            </div>

            <div class="input-wrap">
                <div class="input-icon">
                    <div class="icon"><i class="fas fa-key"></i></div>
                    <input id="re_password" name="re_password" type="password" placeholder="Re-type password"/>
                </div>
            </div>

            <div>
                <p><?php if (isset($error)) echo $error; ?></p>
            </div>

            <div style="display: flex;justify-content: space-between" class="flex center mt-5">
                <button id="signup" class="primary big" type="submit">SIGN-UP NOW</button>
                <button id="signin" class="primary big" type="submit">SIGN-IN NOW</button>
            </div>
        </div>

    </form>

</div>

<script src="js/signup.js"></script>
</body>
</html>