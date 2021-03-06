<?php

    session_start();

    include 'classes/manager.class.php';

    if(isset($_SESSION['email'])!="") {
        header("Location:manager/index.php");
    }

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $email_error = "Please Enter Valid Email";
            goto error;
        }

        if(strlen($password) < 6) {
            $password_error = "Password must be minimum of 6 characters";
            goto error;
        }
        
        $user = new User;
         //$hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $auth = $user->login($email, $password);
        if($auth === false)
        {
            $auth_error = 'Incorrect Email or Password!!!';
        } else {
            session_start();
   
            $_SESSION['email'] = $auth['email'];
            header("Location:sidebar-02/index.php");
        }
    }

    error:
    include 'managerlogin.phtml';