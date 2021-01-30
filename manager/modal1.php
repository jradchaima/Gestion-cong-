<?php


error_reporting(0);
session_start();
include '../classes/manager.class.php';


if(isset($_SESSION['email']) =="") {
    header("Location:../managerlogin.php");
}
else{
    if(isset($_POST['repondre']))
{ 
    $did=intval($_GET['leaveid']);
$description=$_POST['description'];
$status=$_POST['status']; 
$user = new User;
$user->repondre($description,$status,$did);
$vu = 2; 
$user->vu2($vu,$did);
$usera = new User;
$query = $usera->demandedet($did);
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{
    $fromdate = $result->datedebut;
$todate = $result->datefin;
$solde = $result->solde;
$empd= $result->empid;
$type = $result->nomtypeconge;
}
if($status == 1 and ($type == "Congé Annuel")){
    $start_date = strtotime($fromdate); 
    $end_date = strtotime($todate); 
    $solde=$solde-($end_date - $start_date)/60/60/24;
    $solde=$solde-1; 
    $usera->insersolde($solde,$empd);
}
header("Location:lesdemandesc.php");
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
    <title>Traitement de demande</title>

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
    height:800px;
}
.card-heading h2{
    color:white;
    font-size:20px;
    font-family:"Lucida Console", Monaco, monospace;
    text-align:center;
    text-transform: uppercase;
    



} 
body,
    html {
        margin: 0;
        padding: 0;
        height: 100%;
        background: #60a3bc !important;
    }
     
     </style>

  
     
     <body class="bg-gra-01">
         
   
    
 
        <div class="wrapper wrapper--w790">
            <div class="card card-5">
                <div class="card-heading">
               
 
                    <h2>Traitement de demande </h2>
                </div>
               <?php
                                   if($error){?><div class="errorWrap"><strong>ERROR </strong>:<?php echo htmlentities($error); ?> </div><?php } 
                                   else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>



 
                <div class="card-body">
                    <form method="POST">
                    
          
                        <div class="form-row">
                            <div class="name">Choisir reponse de demande</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                    <select  name="status"  required="">
                                    <option value="">Choisir votre option</option>
                                            <option value="1">Accepté</option>
                                            <option value="2">Refusée</option>
                                            </select>
                                            <div class="select-dropdown"></div>
</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="name">Description</div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-5" type="textarea" name="description"autocomplete="off" required >
                                </div>
                            </div>
                        </div>
                        <button class="btn btn--radius-2 btn--blue" type="submit" name="repondre">Envoyer</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

</body>
    <!-- Jquery JS-->
    <script src="../vend/jquery/jquery.min.js"></script>
    <!-- Vendor JS-->
    <script src="../vend/select2/select2.min.js"></script>
    <script src="../vend/datepicker/moment.min.js"></script>
    <script src="../vend/datepicker/daterangepicker.js"></script>

    <!-- Main JS-->
    <script src="../j/global.js"></script>

<!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>
<!-- end document-->
