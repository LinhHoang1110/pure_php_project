<?php

    session_start();
    $con = mysqli_connect('localhost','root','root');

    mysqli_select_db($con,'todolist');

    $username = $_POST['username'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];

    function checkUserInput($usernameCheck) {
        $checkedUserName = filter_var($usernameCheck, FILTER_SANITIZE_STRING);
        return $checkedUserName;
    }

    function checkPasswordInput($passwordCheck) {
        $checkedPassword = filter_var($passwordCheck, FILTER_SANITIZE_STRING);
        return $checkedPassword;
    }

    $s = "select * from USERS where username = '$username'";
    $result = mysqli_query($con,$s);

    $num = mysqli_num_rows($result);


    if($num == 1) {
        $_SESSION['error'] =  "User Already taken";
        header('location: signup.php');

    }
    else {
        $saveUsername = checkUserInput($username);
        $savePassword = checkPasswordInput($password);


        if ($saveUsername == $username && $savePassword == $password) {
            $decryptPassword = md5($password);
            $reg = "insert into USERS(username,password) values ('$username','$decryptPassword')";
            mysqli_query($con,$reg);
            header('location:login.php');
            echo "Registration Successful";
        }
        else {
            header('location:signup.php');
        }
    }

?>