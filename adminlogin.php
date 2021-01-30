<?php

    session_start();

    include 'classes/admin.class.php';

    if(isset($_SESSION['email'])!="") {
        header("Location:admin/index.php");
    }

    if (isset($_POST['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $email_error = "S'il vous plaît entrer une adresse email valide";
            goto error;
        }

        if(strlen($password) < 6) {
            $password_error = "mot de passe minimum  de 6 charactéres";
            goto error;
        }
        
        $user = new User;
         //$hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $auth = $user->login($email, $password);
        if($auth === false)
        {
            $auth_error = 'Incorrect Email ou mot de passe!!!';
        } else {
            session_start();
   
            $_SESSION['email'] = $auth['email'];
            header("Location:admin/index.php");
        }
    }

    error:
    include 'adminlogin.phtml';