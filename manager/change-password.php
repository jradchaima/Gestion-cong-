<?php




error_reporting(0);

if(isset($_SESSION['email']) =="") {
    header("Location:../managerlogin.php");
}
else{
    if(isset($_POST['changer']))
    {  

        $password=($_POST['password']);
        $pass=($_POST['newpassword']);
      
        $newpassword=password_hash($pass,PASSWORD_DEFAULT);
        $email=$_SESSION['email'];
        $usera = new User;
        $query=$usera->change_password($email,$password,$newpassword);
        $user= $query->fetch();
        if(strlen($pass) < 6) {        
    $password_error = "Mot de passe minimun de 6 caractéres";
        }
    else{
if (password_verify($password, $user['password'])) {
    $chngpwd1=$usera->change_password1($email,$newpassword);
    $msg="Votre mot de passe est changé avec succée";
} else {
    $error="Votre mot de passe actuel est incorrect"; 
}   
}      
   
}
    ?>
    
    <!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">

    <!-- Title Page-->
    <title>Au Register Forms by Colorlib</title>

    <!-- Icons font CSS-->
    <link href="../vend/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">
    <link href="../vend/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
    <!-- Font special for pages-->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">

    <!-- Vendor CSS-->
    <link href="../vend/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="../vend/datepicker/daterangepicker.css" rel="stylesheet" media="all">

    <!-- Main CSS-->
    <link href="../cs/main.css" rel="stylesheet" media="all">
</head>



<style>
        .errorWrap {
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #dd3d36;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
.succWrap{
    padding: 10px;
    margin: 0 0 20px 0;
    background: #fff;
    border-left: 4px solid #5cb85c;
    -webkit-box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
    box-shadow: 0 1px 1px 0 rgba(0,0,0,.1);
}
table{
    
    margin-left:30px;
}
body{
    width:1200px;
}
.card-heading h2{
    color:white;
    font-size:20px;
    font-family:"Lucida Console", Monaco, monospace;
    text-align:center;
    text-transform: uppercase;
    

}  
.btn--red {
  background: #0f89da;
}

.btn--red:hover {
  background: #b8e8fc;
}
     
     </style>

  
     
     <body class="bg-gra-01">
         
   
    
 
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
               
 
                    <h2>Changer mot de passes</h2>
                </div>
               <?php
                                   if($error){?><div class="errorWrap"><strong>Erreur </strong>:<?php echo htmlentities($error); ?> </div><?php } 
                                   else if($msg){?><div class="succWrap"><strong>Succée</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>



 
                <div class="card-body">
                    <form method="POST">
                    
                    <div class="form-row">
                            <div class="name">Mot de passe actuel</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="password" name="password"autocomplete="off" required >
                                </div>
                            </div>
                        </div>   <div class="form-row">
                            <div class="name">Nouveau mot de passe</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="password" name="newpassword"autocomplete="off" required >
                                    <span class="text-danger"><?php if (isset($password_error)) echo $password_error; ?></span>
                                </div>
                            </div>
                        </div>
                        <button class="btn btn--radius-2 btn--red" type="submit" name="changer">Changer</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>


    <!-- Jquery JS-->
    <script src="../vend/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="../vend/select2/select2.min.js"></script>
    <script src="../vend/datepicker/moment.min.js"></script>
    <script src="../vend/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="../j/global.js"></script>

</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->

