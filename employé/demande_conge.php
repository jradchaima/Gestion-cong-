<?php


error_reporting(0);

if(isset($_SESSION['email']) =="") {
    header("Location:../login.php");
}
else{

if(isset($_POST['demande']))
{

    $user = new User;
$query=$user->select($eid);
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)

{       
    $_SESSION['eid']=$result->empid; 
    $_SESSION['solde']=$result->solde;
 
}}
$empd= $_SESSION['eid'];
$solde=$_SESSION['solde'];

     $leavetype=$_POST['leavetype'];
    $fromdate=$_POST['fromdate'];  
    $todate=$_POST['todate'];
    
    

    $description=$_POST['description'];
    $datedemande=$_POST['datedemande'];  
    $status=0;
    $vu=0;
    $start_date = strtotime($fromdate); 
    $end_date = strtotime($todate);
    
    if( $start_date > $end_date){
                    $error=" Il faut que la datefin est plus grand que la datedebut ";
               }
               else{
            
               $userr = new User;
            
               $userr->demande($leavetype,$fromdate,$todate,$description,$status,$empd,$datedemande,$vu);
             
           
             
       

               $lastInsertId = $userr->lid();
               
               if($lastInsertId) 

               {
                   echo $lastInsertId;
                   header("Location:historiquedemandec.php");
               
             
           
               }
               else 
               {
               $error="Something went wrong. Please try again";
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
               
 
                    <h2>Demander un congé</h2>
                </div>
               <?php
                                   if($error){?><div class="errorWrap"><strong>ERROR </strong>:<?php echo htmlentities($error); ?> </div><?php } 
                                   else if($msg){?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php }?>



 
                <div class="card-body">
                    <form method="POST">
                    
          
                        <div class="form-row">
                            <div class="name">Choisir un type de congé</div>
                            <div class="value">
                                <div class="input-group">
                                    <div class="rs-select2 js-select-simple select--no-search">
                                    <select  name="leavetype" autocomplete="off" required="">
<option value="">Choisir un type de congé...</option>
<?php
$user = new User;
$query=$user->typeconge();
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{   ?>                                            
<option value="<?php echo htmlentities($result->nomtypeconge);?>"><?php echo htmlentities($result->nomtypeconge);?></option>
<?php }} ?>
</select>
<div class="select-dropdown"></div>
</div>
                                </div>
                            </div>
                        </div>

                     
                        <div class="form-row m-b-55">
                       
       <div class="name">Date

                            </div>
                            <div class="value">
                                <div class="row row-space">
                                
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="date" name="fromdate" autocomplete="off" required>
                                            <label class="label--desc">Date debut</labbel>
                                       
                                    </div>
                                    <br>
                                    <br>
                                    <br>
                                
                                        <div class="input-group-desc">
                                            <input class="input--style-5" type="date" name="todate"  autocomplete="off" required >
                                            <label class="label--desc">Date fin</label>
                                    
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
                        <div class="form-row">
                            <div class="name">Date de demande</div>
                            <div class="value">
                                <div class="input-group"><?php echo date("Y-m-d H:i");?>
                                    <input class="input--style-5" type="hidden"  value="<?php echo date("Y-m-d H:i");?> " name="datedemande"autocomplete="off" required >
                                </div>
                            </div>
                        </div>
                            <button class="btn btn--radius-2 btn--red" type="submit" name="demande">Demander</button>

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
