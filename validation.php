<?php
    session_start();
    //ob_start();

    $con = mysqli_connect('localhost','root','root');


    mysqli_select_db($con,'todolist');

    if(empty(($_SESSION['username']))){
            if(isset($_COOKIE['usernamecookie']) && $_COOKIE['passwordcookie']) {
                $usernameCo = $_COOKIE['usernamecookie'];
                $pwCo=$_COOKIE['passwordcookie'];
                $s = "select * from USERS where username = $usernameCo && password = $pwCo";
                $result = mysqli_query($con, $s);

                $num = mysqli_num_rows($result);

                if ($num == 1) {
                    header("location: home.php");
                    exit;             }
            }
    }
    else {
        header('location: home.php');
        exit;
    }

    if(isset($_POST['signin'])){

        $username = $_POST['username'];
        $password = $_POST['password'];

        function checkUserInput($usernameCheck) {
            $checkedUserName = filter_var($usernameCheck, FILTER_SANITIZE_STRING);
            return $checkedUserName;
        }

        function checkPasswordInput($passwordCheck) {
            $checkedPassword = filter_var($passwordCheck, FILTER_SANITIZE_STRING);
            return $checkedPassword;
        }

        $checkedUsername = checkUserInput($username);
        $checkedPassword = md5(checkPasswordInput($password));

        $s = "select * from USERS where username = '$checkedUsername' && password = '$checkedPassword' ";
        $result = mysqli_query($con,$s);

        $num = mysqli_num_rows($result);
        if($num == 1){
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $password;
            if(isset($_POST['rememberme'])){
                setcookie('usernamecookie',$username,time()+86400);
                setcookie('passwordcookie',$password,time()+86400);
            }
            header('location:home.php');
            exit;
        }
        else {
            header('location:login.php');
            $_SESSION['error'] = "Invalid username or password!!";
            exit;
        }


    }

?>