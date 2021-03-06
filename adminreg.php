<?php
session_start();
include 'classes/admin.class.php';

    if (isset($_POST['register'])) {
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $telephone = $_POST['mobileno'];
        $lastname = $_POST['lastName'];
        $firstname = $_POST['firstName'];
        $ville = $_POST['address'];
        $date = $_POST['dob'];
        $sexe = $_POST['gender'];
 
        $cpassword = $_POST['cpassword'];
    

        if (!preg_match("/^[a-zA-Z0-9 ]+$/",$username)) {
            $username_error = "Name must contain only letters, numbers and space";
            goto error;
        }
        
        if (!preg_match("/^[a-zA-Z0-9 ]+$/",$ville)) {
            $ville_error = "Name must contain only letters, numbers and space";
            goto error;
        }
       
        if ( !preg_match ("/^[a-zA-Z\s]+$/",$firstname)){
            $name_error = "first name and last name contain only letters";
            goto error;
        }
        if ( !preg_match ("/^[a-zA-Z\s]+$/",$lastname)){
            $name_error = "first name and last name contain only letters";
            goto error;
        }


        if(!filter_var($email,FILTER_VALIDATE_EMAIL)) {
            $email_error = "Please Enter Valid Email";
            goto error;
        }

        if(strlen($password) < 6) {
            $password_error = "Password must be minimum of 6 characters";
            goto error;
        }
        if(strlen($telephone) < 8) {
            $telephone_error = "Numero de telephone  must be minimum of 8 numbers";
            goto error;
        }

        if($password != $cpassword) {
            $cpassword_error = "Password and Confirm Password doesn't match";
            goto error;
        }

        $usera = new User;
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $usera->register($username,$email,$hashed_password,$firstname,$lastname,$ville,$sexe,$telephone,$date);
        header('Location:managerlogin.php');
        exit();
    }
    error:
    include 'adminreg.phtml';