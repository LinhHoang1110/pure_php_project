<?php

    session_start();
    session_destroy();

    setcookie('usernamecookie','',time()-86400);
    setcookie('passwordcookie','',time()-86400);

    header('location:login.php')

?>