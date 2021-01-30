<?php

error_reporting(0);





if(isset($_SESSION['email']) =="") {
    header("Location:../managerlogin.php");
}
else{
 $vu = 1;
 $did=intval($_GET['leaveid']); 
 $user = new User;
 $user->vu2($vu,$did);
 
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <!-- Title -->
        <title>Admin | Leave Details </title>
        
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
        <meta charset="UTF-8">
        <meta name="description" content="Responsive Admin Dashboard Template" />
        <meta name="keywords" content="admin,dashboard" />
        <meta name="author" content="Steelcoders" />
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <link href="cs/main.css" rel="stylesheet" media="all">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
  
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
    
    margin-left:10px;
    width:100px;
    background:white;
    border-radius:20px;
    
}body{
    width:1200px;
}
b{
    opacity:1;
    
}
.hover:hover{
font-size:20px;
}
        </style>
    </head>
    <body>
    <body class="bg-gra-01">


<div class="card-heading">
                    <h2 class="title">Details de demande</h2>
                </div>

          
                                <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                <table class="table table-light">
                               
                        <tbody>
<?php 
$lid=intval($_GET['leaveid']);
$usera = new User;
$query = $usera->demandedet($lid);
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{
foreach($results as $result)
{         
      ?>  

                                        <tr>
                                            <td style="font-size:16px;"> <b>Nom employé :</b></td>
                                              <td><a href="editemployee.php?empid=<?php echo htmlentities($result->empid);?>" target="_blank">
                                                <?php echo htmlentities($result->first_name." ".$result->last_name);?></a></td>
                                              <td style="font-size:16px;"><b>Employé Id :</b></td>
                                              <td><?php echo htmlentities($result->empid);?></td>
                                              <td style="font-size:16px;"><b>Sexe :</b></td>
                                              <td><?php echo htmlentities($result->sexe);?></td>
                                          </tr>

                                          <tr>
                                             <td style="font-size:16px;"><b>Email id :</b></td>
                                            <td><?php echo htmlentities($result->email);?></td>
                                             <td style="font-size:16px;"><b>Employé Contact No. :</b></td>
                                            <td><?php echo htmlentities($result->telephone);?></td>
                                            <td>&nbsp;</td>
                                             <td>&nbsp;</td>
                                        </tr>

  <tr>
                                             <td style="font-size:16px;"><b>Type de congé :</b></td>
                                            <td><?php echo htmlentities($result->nomtypeconge);?></td>
                                            <td style="font-size:16px;"><b>Solde de congé :</b></td>
                                            <td><?php echo htmlentities($result->solde);?></td>


                                             <td style="font-size:16px;"><b>Date de congé . :</b></td>
                                            <td>De <?php echo htmlentities($result->datedebut);?> à <?php echo htmlentities($result->datefin);?></td>
                                            <td style="font-size:16px;"><b>Date de demande</b></td>
                                           <td><?php echo htmlentities($result->datedemande);?></td>
                                        </tr>

<tr>
                                             <td style="font-size:16px;"><b>Employeé congé description : </b></td>
                                            <td colspan="5"><?php echo htmlentities($result->description);?></td>
                                          
                                        </tr>

<tr>
<td style="font-size:16px;"><b> Status :</b></td>
<td colspan="5"><?php $stats=$result->status;
if($stats==1){
?>
<span style="color: green">Acceptée</span>
<?php


   } if($stats==2)  { ?>
<span style="color: red">Refusée</span>
<?php } if($stats==0)  { ?>
 <span style="color: blue">demande en attente</span>
 <?php } ?>
</td>
</tr>

<tr>
<td style="font-size:16px;"><b>Directeur Remarque: </b></td>
<td colspan="5"><?php
if($result->adminremarque==""){
  echo "demande en attente";  
}
else{
echo htmlentities($result->adminremarque);
}
?></td>
 </tr>


<?php 
if($stats==0)
{


?>
<tr>
 <td colspan="5">
<button class="btn btn--radius-2 btn--green" >  <a class="hover" style ="color:white" href="modal1.php?leaveid=<?php echo htmlentities($result->lid);?>">Traitement</a> </button>
 

 </td>
</tr>
<?php  
}
?>

   </form>                                     </tr>
                                         <?php $cnt++;} }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
         
        </div>

        
    </body>
</html>
<?php } ?>