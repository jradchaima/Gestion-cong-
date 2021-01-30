<?php





error_reporting(0);



if(isset($_SESSION['email']) =="") {
    header("Location:../login.php");
}
else{
    $vu = 3;
    $did=intval($_GET['leaveid']); 
    $user = new User;
    $user->vu2($vu,$did);
    ?>

    <!DOCTYPE html>
<html lang="en">
<head>
<title>Employee | Leave History</title>
        
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
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
    
    margin-left:30px;
}
body{
    width:1200px;
}
.title{
    color:white;
    font-size:20px;
    font-family:"Lucida Console", Monaco, monospace
    

}
        </style>
</head> 

<body class="bg-gra-01">


<div class="card-heading">
                    <h2 class="title">Historique des demandes</h2>

                </div>

                                <?php if($msg){?><div class="succWrap"><strong>SUCCESS</strong> : <?php echo htmlentities($msg); ?> </div><?php }?>
                                <table class="table table-light">
 
							<thead class="thead-dark">
								<tr>
                                <th>#</th>
									<th>Type de conge</th>
									<th>Date debut</th>
									<th>Date fin</th>
                                    <th>Description</th>
                                    <th>Datedemande</th>
                                    <th>Directeur Remarque</th>
                                    
                               
									<th>Status</th>
                                 </tr>
							</thead>
				
							<tbody>
<?php
$eid=$_SESSION['eid'];
$user = new User;
 $query=$user->history($eid);
$results=$query->fetchAll(PDO::FETCH_OBJ);
$cnt=1;
if($query->rowCount() > 0)
{

   
    

foreach($results as $result)

{      
         
     ?>               
                                      <tr>
 
                                  
                                            <td> <?php echo htmlentities($cnt);?> </td>
                                            <td><?php echo htmlentities($result->nomtypeconge);?></td>
                                            <td><?php echo htmlentities($result->datedebut);?></td>
                                            <td><?php echo htmlentities($result->datefin);?></td>
                                           <td><?php echo htmlentities($result->description);?></td>
                                            <td><?php echo htmlentities($result->datedemande);?></td>
                                            <td><?php if($result->adminremarque=="")
                                            {
echo htmlentities('demande en attente');
                                            } else
{

 echo htmlentities(($result->adminremarque));
}

                                            ?></td>
                                                                                 <td><?php $stats=$result->status;
if($stats==1){
                                             ?>
                                             
                                                 <span style="color: green">Acceptée</span>
                                                 <?php } if($stats==2)  { ?>
                                                <span style="color: red">Refusée</span>
                                                 <?php } if($stats==0)  { ?>
 <span style="color: blue">demande en attente</span>
 <?php } ?>

                                             </td>
                                             
          
                                        </tr>
                                         <?php $cnt++;} }?>
                                         </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
      
         
        </div>
     
        
        <!-- Javascripts -->
 

        
    </body>
</html>
<?php } ?>